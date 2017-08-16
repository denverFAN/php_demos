<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tourTypes".
 *
 * @property integer $id
 * @property string $type
 *
 * @property Tour[] $tours
 */
class TourTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tourTypes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
        ];
    }

    /**
     *
     */
    public static function getTypesList($tourHasType = false)
    {
        if ($tourHasType) {
            $tourTypes = self::find()->joinWith('tours', false, 'RIGHT JOIN')->all();
        } else {
            $tourTypes = self::find()->all();
        }
        $typesList = ArrayHelper::map($tourTypes, 'id', 'type');

        return $typesList;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTours()
    {
        return $this->hasMany(Tour::className(), ['typeId' => 'id']);
    }
}
