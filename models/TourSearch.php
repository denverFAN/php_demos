<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tour;

/**
 * TourSearch represents the model behind the search form about `app\models\Tour`.
 */
class TourSearch extends Tour
{
    // default value for the range slider init
    public $ratings = 1;
    public $continent;
    public $country;
    public $city;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'providerId', 'typeId', 'priceAdult', 'priceChild', 'priceInfant', 'priceSenior',
                'descShort', 'descLong', 'descExtra', 'inclusion', 'exclusion', 'addInfo', 'itinerary', 'duration',
                'payMethod', 'hotelPickup', 'status', 'showMain', 'ratings', 'continent', 'country', 'city'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Tour::find()->joinWith('countries')->joinWith('cities');
        $subQuery = Ratings::find()
            ->select('tourId, AVG(value) as rating')
            ->groupBy('tourId');
        $query->leftJoin(['ratings' => $subQuery], 'ratings.tourId = tour.id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'ratings' => [
                        'asc' => ['ratings.rating' => SORT_ASC],
                        'desc' => ['ratings.rating' => SORT_DESC],
                        'label' => 'RATING',
                    ],
                    'priceAdult' => [
                        'label' => 'PRICE',
                    ],
                    'name' => [
                        'label' => 'NAME',
                    ],
                    'deposit' => [
                        'label' => 'REQUIRED BOOKING DEPOSIT',
                    ],
                ],
            ],
            'pagination' => [
                'pageSize' => 5
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'typeId' => $this->typeId,
        ]);

        // split ratings by values "from-to"
        $ratings = explode(',', $this->ratings);

        $query->andFilterWhere(['like', 'tour.name', $this->name])
            ->andFilterWhere(['like', 'countries.continent', $this->continent])
            ->andFilterWhere(['like', 'countries.id', $this->country])
            ->andFilterWhere(['like', 'cities.id', $this->city])
            ->andFilterWhere(['between', 'ratings.rating', $ratings[0], $ratings[1]]);

        return $dataProvider;
    }
}
