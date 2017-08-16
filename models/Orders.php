<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "orders".
 *
 * @property integer $orderId
 * @property integer $cartId
 * @property integer $tourId
 * @property integer $userId
 * @property integer $providerId
 * @property double $payPrice
 * @property double $totalPrice
 * @property integer $totalAdult
 * @property integer $totalInfant
 * @property integer $totalSenior
 * @property integer $totalChild
 * @property integer $groupId
 * @property string $dateBuy
 * @property string $languageId
 * @property string $dateStartTour
 * @property string $leadFirstname
 * @property string $leadLastname
 * @property string $leadPhone
 * @property string $leadEmail
 * @property string $code
 * @property string $pickInfo
 * @property integer $orderStatus
 * @property integer $payStatus
 * @property integer $isReview
 *
 * @property Groups $group
 * @property Profile $user
 * @property Providers $provider
 * @property Tour $tour
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['orderId', 'tourId', 'userId', 'providerId', 'groupId'], 'required'],
            [['orderId', 'tourId', 'userId', 'providerId', 'totalAdult', 'totalInfant', 'totalSenior', 'totalChild', 'groupId', 'languageId', 'orderStatus', 'payStatus', 'isReview'], 'integer'],
            [['payPrice', 'totalPrice'], 'number'],
            [['dateBuy', 'dateStartTour'], 'safe'],
            [['code', 'pickInfo'], 'string', 'max' => 255],
            [['languageId'], 'exist', 'skipOnError' => true, 'targetClass' => GuideLanguages::className(), 'targetAttribute' => ['languageId' => 'id']],
            [['groupId'], 'exist', 'skipOnError' => true, 'targetClass' => Groups::className(), 'targetAttribute' => ['groupId' => 'id']],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['userId' => 'user_id']],
            [['providerId'], 'exist', 'skipOnError' => true, 'targetClass' => Providers::className(), 'targetAttribute' => ['providerId' => 'userId']],
            [['tourId'], 'exist', 'skipOnError' => true, 'targetClass' => Tour::className(), 'targetAttribute' => ['tourId' => 'id']],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['scenario_formBookNow'] = ['cartId', 'tourId', 'userId', 'providerId', 'totalAdult', 'totalInfant', 'totalSenior', 'totalChild', 'dateStartTour'];

        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cartId' => 'Cart ID',
            'orderId' => 'Order ID',
            'tourId' => 'Tour ID',
            'userId' => 'User ID',
            'providerId' => 'Provider ID',
            'payPrice' => 'Pay Price',
            'totalPrice' => 'Total Price',
            'totalAdult' => 'Adults',
            'totalInfant' => 'Infants',
            'totalSenior' => 'Seniors',
            'totalChild' => 'Children',
            'groupId' => 'Group ID',
            'dateBuy' => 'Date Buy',
            'dateStartTour' => 'Date Start Tour',
            'code' => 'Code',
            'pickInfo' => 'Pick Info',
            'orderStatus' => 'Order Status',
            'payStatus' => 'Pay Status',
            'isReview' => 'Is Review',
        ];
    }

    /**
     *
     */
    public function setTotalPrice()
    {
        $travellersPrices = [
            $this->totalAdult => $this->tour->priceAdult,
            $this->totalChild => $this->tour->priceChild,
            $this->totalInfant => $this->tour->priceInfant,
            $this->totalSenior => $this->tour->priceSenior,
        ];
        $this->totalPrice = 0;
        foreach ($travellersPrices as $travellers => $price) {
            if (!empty($travellers)) {
                $this->totalPrice += $travellers * $price;
            }
        }

        return $this->totalPrice;
    }

    /**
     *
     */
    public function setPayPrice()
    {
        return $this->payPrice = (Yii::$app->params['depositPercentage'] / 100) * $this->totalPrice;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Groups::className(), ['id' => 'groupId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'userId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvider()
    {
        return $this->hasOne(Providers::className(), ['userId' => 'providerId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTour()
    {
        return $this->hasOne(Tour::className(), ['id' => 'tourId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuide()
    {
        return $this->hasOne(GuideLanguages::className(), ['id' => 'languageId']);
    }

    /**
     *
     */
    public function getTravellers()
    {
        if (!empty($this->groupId)) {
            $travellers = $this->group->name;
        } else {
            $travellers = $this->totalAdult + $this->totalInfant + $this->totalSenior + $this->totalChild;
        }

        return $travellers;
    }

    /**
     *
     */
    public function getTypeId()
    {
        return $this->tour->typeId;
    }
}
