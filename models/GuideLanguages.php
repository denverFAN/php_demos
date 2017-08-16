<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "guideLanguages".
 *
 * @property integer $id
 * @property string $language
 *
 * @property PickupPoints[] $pickupPoints
 * @property TourDates[] $tourDates
 */
class GuideLanguages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'guideLanguages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'language' => 'Language',
        ];
    }

    /**
     *
     */
    public static function getLanguagesList()
    {
        $guideLanguages = self::find()->all();
        $languagesList = ArrayHelper::map($guideLanguages, 'id', 'language');

        return $languagesList;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPickupPoints()
    {
        return $this->hasMany(PickupPoints::className(), ['languageId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourDates()
    {
        return $this->hasMany(TourDates::className(), ['languageId' => 'id']);
    }
}
