<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tour".
 *
 * @property integer $id
 * @property string $name
 * @property integer $providerId
 * @property integer $typeId
 * @property double $priceAdult
 * @property double $priceChild
 * @property double $priceInfant
 * @property double $priceSenior
 * @property string $descShort
 * @property string $descLong
 * @property string $descExtra
 * @property string $inclusion
 * @property string $exclusion
 * @property string $addInfo
 * @property string $itinerary
 * @property string $duration
 * @property string $payMethod
 * @property integer $hotelPickup
 * @property integer $status
 * @property integer $showMain
 *
 * @property Favorites[] $favorites
 * @property Groups[] $groups
 * @property Messages[] $messages
 * @property Orders[] $orders
 * @property PickupPoints[] $pickupPoints
 * @property Ratings[] $ratings
 * @property Reviews[] $reviews
 * @property Providers $provider
 * @property TourTypes $type
 * @property TourLocation[] $tourLocations
 * @property TourPhotos[] $tourPhotos
 */
class Tour extends \yii\db\ActiveRecord
{
    /**
     * The additional attributes are needed to create wright itinerary
     */
    public $itineraryTime;
    public $itineraryDesc;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tour';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['providerId', 'typeId'], 'required'],
            [['name'], 'string', 'max' => 70],
            [['priceAdult', 'deposit', 'priceChild', 'priceInfant', 'priceSenior'], 'number'],
            [['descShort'], 'string', 'max' => 220],
            [['descLong'], 'string', 'max' => 450],
            [['itinerary'], 'string'],
            [['descExtra', 'inclusion', 'exclusion', 'payMethod'], 'string'],
            [['addInfo'], 'string', 'max' => 500],
            [['providerId', 'typeId', 'duration', 'hotelPickup', 'status', 'showMain'], 'integer'],
            [['providerId'], 'exist', 'skipOnError' => true, 'targetClass' => Providers::className(), 'targetAttribute' => ['providerId' => 'userId']],
            [['typeId'], 'exist', 'skipOnError' => true, 'targetClass' => TourTypes::className(), 'targetAttribute' => ['typeId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Tour name (max 70 characters)',
            'typeId' => 'Tour type',
            'priceAdult' => 'Adult',
            'priceChild' => 'Child',
            'priceInfant' => 'Infant',
            'priceSenior' => 'Senior',
            'descShort' => 'Short description (max 220 characters)',
            'descLong' => 'Full description (max 450 characters)',
            'descExtra' => 'Add some short extra information to your description (max 6 items)',
            'inclusion' => 'Inclusions',
            'exclusion' => 'Exclusions',
            'itinerary' => 'Time period and description',
            'addInfo' => 'Additional information (max 500 characters)',
            'duration' => 'Duration',
            'payMethod' => 'Choose your payment methods',
            'hotelPickup' => 'Hotel Pick-Up and Drop-Off',
        ];
    }

    public static function wordsToSeconds($array) {
        $words = "";

        /*** set the days ***/
        if(!empty($array[0])) {
            $words .= "$array[0] days";
        }

        /*** set the hours ***/
        if(!empty($array[1])) {
            $words .= ", $array[1] hours";
        }

        /*** set the minutes ***/
        if(!empty($array[2])) {
            $words .= ", $array[2] minutes";
        }
        
        $seconds = strtotime($words, 0);

        return $seconds;
    }

    public static function secondsToWords($seconds) {
        $words = "";

        /*** get the days ***/
        $days = intval(intval($seconds) / (3600*24));
        if($days > 0) {
            $words .= "$days days ";
        }

        /*** get the hours ***/
        $hours = (intval($seconds) / 3600) % 24;
        if($hours > 0) {
            $words .= "$hours hours ";
        }

        /*** get the minutes ***/
        $minutes = (intval($seconds) / 60) % 60;
        if($minutes > 0) {
            $words .= "$minutes minutes";
        }

        return $words;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFavorites()
    {
        return $this->hasMany(Favorites::className(), ['tourId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Groups::className(), ['tourId' => 'id']);
    }

    /**
     *
     */
    public function getGroupsList()
    {
        return ArrayHelper::map($this->groups, 'id', 'name');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Messages::className(), ['tourId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['tourId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPickupPoints()
    {
        return $this->hasMany(PickupPoints::className(), ['tourId' => 'id']);
    }

    /**
     *
     */
    public function getPickupPointsList()
    {
        return ArrayHelper::map($this->pickupPoints, 'id', 'name');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRatings()
    {
        return $this->hasMany(Ratings::className(), ['tourId' => 'id'])->average('value');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Reviews::className(), ['tourId' => 'id']);
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
    public function getType()
    {
        return $this->hasOne(TourTypes::className(), ['id' => 'typeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourLocations()
    {
        return $this->hasOne(TourLocation::className(), ['tourId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountries()
    {
        return $this->hasOne(Countries::className(), ['id' => 'countryId'])
            ->via('tourLocations');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasOne(Cities::className(), ['id' => 'cityId'])
            ->via('tourLocations');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourPhotos()
    {
        return $this->hasMany(TourPhotos::className(), ['tourId' => 'id']);
    }

    /**
     * 
     */
    public function getPromoPhoto()
    {
        $promoPhoto = $this->getTourPhotos()
            ->andWhere(['isPromo' => 1])
            ->one();
        
        return $promoPhoto;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourDates()
    {
        return $this->hasMany(TourDates::className(), ['tourId' => 'id']);
    }

    /**
     *
     */
    public function getGuideDates($languageId)
    {
        $guideDates = $this->getTourDates()
            ->andWhere(['languageId' => $languageId])
            ->one();
        
        return json_encode(explode('; ', $guideDates->dates));
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuides()
    {
        return $this->hasMany(GuideLanguages::className(), ['id' => 'languageId'])
            ->via('tourDates');
    }

    /**
     *
     */
    public function getGuidesList()
    {
        return ArrayHelper::map($this->guides, 'id', 'language');
    }
}
