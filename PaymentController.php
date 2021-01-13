<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Exception\AMQPProtocolChannelException;
use PhpAmqpLib\Message\AMQPMessage;

class PaymentController extends Controller
{
    public function actionCreate()
    {
        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        $channel->queue_declare('payment_queue', false, true, false, false);

        $request = Yii::$app->request;
        $msg = new AMQPMessage(implode(";", $request->get()), array('delivery_mode' => 2));

        $channel->basic_publish($msg, '', 'payment_queue');

        $channel->close();
        $connection->close();
    }
}