<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tourLocation".
 *
 * @property integer $id
 * @property integer $tourId
 * @property string $countryId
 * @property integer $cityId
 *
 * @property Cities $city
 * @property Countries $country
 * @property Tour $tour
 */
class TourLocation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tourLocation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['tourId', 'countryId', 'cityId'], 'required'],
            [['tourId', 'cityId'], 'integer'],
            [['countryId'], 'string', 'max' => 255],
            [['cityId'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['cityId' => 'id']],
            [['countryId'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['countryId' => 'id']],
            [['tourId'], 'exist', 'skipOnError' => true, 'targetClass' => Tour::className(), 'targetAttribute' => ['tourId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tourId' => 'Tour ID',
            'countryId' => 'Country ID',
            'cityId' => 'City ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'cityId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['id' => 'countryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTour()
    {
        return $this->hasOne(Tour::className(), ['id' => 'tourId']);
    }
}
