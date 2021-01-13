<?php

namespace app\models;

use Yii;
use Redis;

class RedisCacheProvider {
    private $connection = null;
    private function getConnection(){
        if($this->connection===null){
            $this->connection = new Redis();
            $redisParams = Yii::$app->params['redis'];
            $this->connection->connect($redisParams['server'], $redisParams['port']);
        }
        return $this->connection;
    }

    public function get($key){
        $result = false;
        if($c = $this->getConnection()){ 
            $result = unserialize($c->get($key));
        }
        return $result;
    }
    public function set($key, $value, $time=0){
        if($c=$this->getConnection()){
            $c->set($key, serialize($value));
        }
    }

    public function del($key){
        if($c=$this->getConnection()){
            $c->delete($key);
        }
    }

    public function clear(){
        if($c=$this->getConnection()){
            $c->flushDB();
        }
    }

    public function keyFromQueryParams()
    {
        return md5(serialize(Yii::$app->request->queryParams));
    }
}
