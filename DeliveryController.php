<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Exception\AMQPProtocolChannelException;
use PhpAmqpLib\Message\AMQPMessage;

class DeliveryController extends Controller
{
    // обработка оповещения о том, что заказ собран
    public function actionCreate()
    {
        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        $channel->queue_declare('delivery_queue', false, true, false, false);

        $data = 'Некие данные о заказе и клиенте, полученные из БД';
        $msg = new AMQPMessage($data, array('delivery_mode' => 2));

        $channel->basic_publish($msg, '', 'delivery_queue');

        $channel->close();
        $connection->close();
    }
}