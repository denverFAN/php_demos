<?php

namespace app\models;

use Yii;
use yii\validators\RequiredValidator;

/**
 * This is the model class for table "tourDates".
 *
 * @property integer $id
 * @property integer $tourId
 * @property integer $languageId
 * @property string $dates
 *
 * @property GuideLanguages $language
 */
class TourDates extends \yii\db\ActiveRecord
{
    /**
     * The additional attribute is needed to aggregate all guides dates
     */
    public $allDates;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tourDates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['tourId', 'languageId'], 'required'],
            [['tourId', 'languageId'], 'integer'],
            [['dates'], 'string'],
            [['languageId'], 'exist', 'skipOnError' => true, 'targetClass' => GuideLanguages::className(), 'targetAttribute' => ['languageId' => 'id']],
            [['tourId'], 'exist', 'skipOnError' => true, 'targetClass' => Tour::className(), 'targetAttribute' => ['tourId' => 'id']],
            [['allDates'], 'validateTourDates'],
        ];
    }

    public function validateTourDates($attribute)
    {
        $requiredValidator = new RequiredValidator();
        foreach($this->$attribute as $index => $row) {
            $error = null;
            foreach (['languageId', 'dates'] as $name) {
                $error = null;
                $value = isset($row[$name]) ? $row[$name] : null;
                $requiredValidator->validate($value, $error);
                if (!empty($error)) {
                    $key = $attribute . '[' . $index . '][' . $name . ']';
                    $this->addError($key, $error);
                }
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tourId' => 'Tour ID',
            'languageId' => 'Choose guide',
            'dates' => 'Pick available dates for this guide:',
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
