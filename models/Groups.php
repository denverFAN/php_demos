<?php

namespace app\models;

use Yii;
use yii\validators\RequiredValidator;

/**
 * This is the model class for table "groups".
 *
 * @property integer $id
 * @property string $name
 * @property integer $peopleFrom
 * @property integer $peopleTo
 * @property double $price
 * @property integer $tourId
 *
 * @property Tour $tour
 * @property Orders[] $orders
 */
class Groups extends \yii\db\ActiveRecord
{
    /**
     * The additional attribute is needed to aggregate all groups data
     */
    public $newGroups;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'groups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['tourId'], 'required'],
            [['tourId'], 'integer'],
            [['peopleFrom', 'peopleTo'], 'integer'],
            [['price'], 'number'],
            [['name'], 'string'],
            [['tourId'], 'exist', 'skipOnError' => true, 'targetClass' => Tour::className(), 'targetAttribute' => ['tourId' => 'id']],
            [['newGroups'], 'validateGroups'],
        ];
    }

    public function validateGroups($attribute)
    {
        $requiredValidator = new RequiredValidator();
        foreach($this->$attribute as $index => $row) {
            $error = null;
            foreach (['name', 'peopleFrom', 'peopleTo', 'price'] as $name) {
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
            'name' => 'Name',
            'peopleFrom' => 'People From',
            'peopleTo' => 'People To',
            'price' => 'Price for group',
            'tourId' => 'Tour ID',
        ];
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
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['groupId' => 'id']);
    }
}
