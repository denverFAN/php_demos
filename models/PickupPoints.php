<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pickupPoints".
 *
 * @property integer $id
 * @property string $name
 * @property integer $tourId
 * @property integer $languageId
 * @property string $time
 * @property double $lat
 * @property double $lng
 * @property string $addInfo
 *
 * @property GuideLanguages $language
 * @property Tour $tour
 */
class PickupPoints extends \yii\db\ActiveRecord
{
    /**
     * The additional attribute is needed to grab all data from the map
     */
    public $allPoints;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pickupPoints';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['tourId', 'languageId'], 'required'],
            [['tourId', 'languageId'], 'integer'],
            [['lat', 'lng'], 'number'],
            [['name', 'time', 'addInfo'], 'string', 'max' => 255],
            [['allPoints'], 'string'],
            [['languageId'], 'exist', 'skipOnError' => true, 'targetClass' => GuideLanguages::className(), 'targetAttribute' => ['languageId' => 'id']],
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
            'name' => 'Name',
            'tourId' => 'Tour ID',
            'languageId' => 'Language ID',
            'time' => 'Time',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'addInfo' => 'Add Info',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(GuideLanguages::className(), ['id' => 'languageId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTour()
    {
        return $this->hasOne(Tour::className(), ['id' => 'tourId']);
    }
}
