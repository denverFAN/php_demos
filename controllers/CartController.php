<?php

namespace app\controllers;

use yii\helpers\ArrayHelper;
use yii\web\Controller;
use app\models\Orders;
use yii\web\NotFoundHttpException;
use Yii;

class CartController extends Controller
{
    public function actionIndex()
    {
        if (!empty(Yii::$app->user->identity)) {
            $userId = Yii::$app->user->identity->getId();
            $orders = Orders::find()
                ->with('tour')
                ->where(['userId' => $userId, 'payStatus' => '0'])
                ->orderBy('orderId')
                ->all();

            $ordersIds = ArrayHelper::getColumn($orders, 'orderId');

            $totalSum = array_sum(ArrayHelper::getColumn($orders, 'totalPrice'));

            return $this->render('index', [
                'orders' => $orders,
                'ordersIds' => $ordersIds,
                'totalSum' => $totalSum,
            ]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
