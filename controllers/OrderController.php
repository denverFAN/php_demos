<?php

namespace app\controllers;

use app\models\PickupPoints;
use Yii;
use app\models\Orders;
use app\models\OrdersSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Model;
use kartik\grid\EditableColumnAction;

/**
 * OrderController implements the CRUD actions for Orders model.
 */
class OrderController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'setstatus' => [
                'class' => EditableColumnAction::className(),
                'modelClass' => Orders::className(),
                'outputValue' => function ($model, $attribute, $key, $index) {
                    return $value = $model->$attribute;
                },
            ]
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'Cart' page.
     * @return mixed
     * @throws NotFoundHttpException if creation was failed
     */
    public function actionCreate()
    {
        $newOrder = new Orders(['scenario' => 'scenario_formBookNow']);
        if ($newOrder->load(Yii::$app->request->post())) {
            $userId = Yii::$app->user->identity->getId();

            $paidOrder = Orders::find()->where(['userId' => $userId, 'payStatus' => '1'])->one();
            if (!empty($paidOrder)) {
                $cartId = $paidOrder->cartId + 1;
            } else {
                $unpaidOrder = Orders::find()->where(['userId' => $userId, 'payStatus' => '0'])->one();
                if (!empty($unpaidOrder)) {
                    $cartId = $unpaidOrder->cartId;
                } else {
                    $cartId = 1;
                }
            }

            $newOrder->userId = $userId;
            $newOrder->cartId = $cartId;
            $newOrder->setTotalPrice();
            $newOrder->setPayPrice();
            $newOrder->save();

            return $this->redirect(['/cart/index', 'userId' => $newOrder->userId]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'Payment' page.
     * @param array $ids
     * @return mixed
     */
    public function actionUpdate(array $ids)
    {
        $orders = Orders::find()
            ->with('tour')
            ->where(['orderId' => $ids])
            ->orderBy('tourId')
            ->all();
        
        $payPriceSum = array_sum(ArrayHelper::getColumn($orders, 'payPrice'));
        $totalPriceSum = array_sum(ArrayHelper::getColumn($orders, 'totalPrice'));

        $tourIds = ArrayHelper::getColumn($orders, 'tourId');
        $pickupPoints = PickupPoints::find()
            ->where(['tourId' => $tourIds])
            ->orderBy('tourId')
            ->asArray()
            ->all();
        $tourPickupPoints = json_encode(ArrayHelper::index($pickupPoints, null, 'tourId'));

        if (Model::loadMultiple($orders, Yii::$app->request->post()) && Model::validateMultiple($orders)) {
            foreach ($orders as $order) {
                $order->save(false);
            }
            return $this->redirect(['success', 'cartId' => $orders[0]->cartId]);
        } else {
            return $this->render('update', [
                'orders' => $orders,
                'payPriceSum' => $payPriceSum,
                'totalPriceSum' => $totalPriceSum,
                'tourPickupPoints' => $tourPickupPoints,
            ]);
        }
    }

    /**
     *
     */
    public function actionPayment($cartId)
    {
        return $this->render('payment', [
            'cartId' => $cartId,
        ]);
    }

    /**
     *
     */
    public function actionSuccess($cartId)
    {
        return $this->render('success', [
            'cartId' => $cartId,
        ]);
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $order = $this->findModel($id);
        $order->delete();

        return $this->redirect(['/cart/index']);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
