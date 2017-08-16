<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "countries".
 *
 * @property string $id
 * @property string $name
 * @property string $continent
 *
 * @property Cities[] $cities
 * @property ProviderLocation[] $providerLocations
 * @property SupportMsg[] $supportMsgs
 * @property TourLocation[] $tourLocations
 */
class Countries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'countries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'name', 'continent'], 'string', 'max' => 255],
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
        ];
    }

    /**
     *
     */
    public function setContinent()
    {
        $continent = Continents::findOne($this->id);
        $this->continent = $continent->continent;
    }

    /**
     * get continents (that have tours) for filtering
     */
    public static function getContinentsList()
    {
        $continents = self::find()
            ->joinWith('tourLocations', false, 'RIGHT JOIN')
            ->all();
        $continentsList = ArrayHelper::map($continents, 'continent', 'continent');
        
        return $continentsList;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(Cities::className(), ['countryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderLocations()
    {
        return $this->hasMany(ProviderLocation::className(), ['countryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupportMsgs()
    {
        return $this->hasMany(SupportMsg::className(), ['countryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourLocations()
    {
        return $this->hasMany(TourLocation::className(), ['countryId' => 'id']);
    }
}
