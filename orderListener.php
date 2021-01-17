<?php

require_once(__DIR__ . '/../vendor/autoload.php');

use yii\web\NotFoundHttpException;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Exception\AMQPProtocolChannelException;
use PhpAmqpLib\Message\AMQPMessage;

$callback = function($data)
{
     echo $data->body;
     // Обработка заказа
     // оповещение пользователя о совершенном платеже
};

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('order_queue', false, true, false, false);

$channel->basic_consume('order_queue', '', false, true, false, false, $callback);
while(count($channel->callbacks)) {
     $channel->wait();
}

$channel->close();
$connection->close();