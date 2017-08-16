<?php

namespace app\controllers;

use app\models\Cities;
use app\models\Countries;
use app\models\Groups;
use app\models\Orders;
use app\models\PickupPoints;
use app\models\TourLocation;
use app\models\TourPhotos;
use app\models\TourDates;
use app\models\GuideLanguages;
use app\models\Tour;
use app\models\TourSearch;
use app\models\TourTypes;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * TourController implements the CRUD actions for Tour model.
 */
class TourController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tour models.
     * @return mixed
     */
    public function actionIndex()
    {
        $tourSearch = new TourSearch();
        $dataProvider = $tourSearch->search(Yii::$app->request->queryParams);

        $typesList = TourTypes::getTypesList(true);

        $continentsList = Countries::getContinentsList();

        return $this->render('index', [
            'tourSearch' => $tourSearch,
            'dataProvider' => $dataProvider,
            'typesList' => $typesList,
            'continentsList' => $continentsList,
        ]);
    }

    /**
     * Get locations list based on the parent location value (for dependent dropdown) for filtering tours
     */
    public function actionChildLocation()
    {
        $parentLocation = Yii::$app->request->post('depdrop_all_params');
        $childLocation = [];
        $outputData = [];
        if (!empty($parentLocation)) {
            if (!empty($parentLocation['toursearch-continent'])) {
                $childLocation = Countries::find()
                    ->joinWith('tourLocations', false, 'RIGHT JOIN')
                    ->where(['countries.continent' => $parentLocation['toursearch-continent']])
                    ->all();
            } elseif (!empty($parentLocation['toursearch-country'])) {
                $childLocation = Cities::find()
                    ->joinWith('tourLocations', false, 'RIGHT JOIN')
                    ->where(['cities.countryId' => $parentLocation['toursearch-country']])
                    ->all();
            }
            if (!empty($childLocation)) {
                foreach ($childLocation as $key => $location) {
                    $outputData[] = ['id' => $location->id, 'name' => $location->name];
                }
                echo json_encode(['output' => $outputData]);
            }
        } else {
            echo json_encode(['output' => '']);
        }
    }

    /**
     * Get dates for the exact guide (for datepicker)
     */
    public function actionGetGuideDates()
    {
        $postData = Yii::$app->request->post();
        if (!empty($postData['tourId']) && !empty($postData['languageId'])) {
            $tour = $this->findModel($postData['tourId']);
            $guideDates = $tour->getGuideDates($postData['languageId']);
            echo $guideDates;
        } else {
            echo json_encode('');
        }
    }

    /**
     * Displays a single Tour model and form for Order creation
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $tour = $this->findModel($id);

        $guidesArray = [];
        foreach ($tour->guides as $guide) {
            array_push($guidesArray, $guide->language);
        }
        $tourGuides = implode(', ', $guidesArray);

        $order = new Orders(['scenario' => 'scenario_formBookNow']);

        $pickupPoints = PickupPoints::find()
            ->where(['tourId' => $id])
            ->asArray()
            ->all();

        return $this->render('view', [
            'tour' => $tour,
            'tourGuides' => $tourGuides,
            'order' => $order,
            'tourPickupPoints' => json_encode($pickupPoints),
        ]);
    }

    /**
     * Creates a new Tour model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $tour = new Tour();
        $newCountry = new Countries();
        $newCity = new Cities();
        $tourLocation = new TourLocation();
        $tourPhotos = new TourPhotos();
        $tourDates = new TourDates();
        $groups = new Groups();
        $pickupPoints = new PickupPoints();

        $languagesList = GuideLanguages::getLanguagesList();

        $typesList = TourTypes::getTypesList();

        if ($tour->load(Yii::$app->request->post()) &&
            $newCountry->load(Yii::$app->request->post()) &&
            $newCity->load(Yii::$app->request->post()) &&
            $tourDates->load(Yii::$app->request->post()) &&
            $tourPhotos->load(Yii::$app->request->post()) &&
            $pickupPoints->load(Yii::$app->request->post()) &&
            $groups->load(Yii::$app->request->post())) {

            $country = Countries::findOne(['name' => $newCountry->name]);
            if (!$country) {
                $newCountry->setContinent();
                $newCountry->save();
                $country = $newCountry;
            }
            $city = Cities::findOne(['name' => $newCity->name, 'countryId' => $newCountry->id]);
            if (!$city) {
                $newCity->countryId = $newCountry->id;
                $newCity->save();
                $city = $newCity;
            }

            $tour->providerId = Yii::$app->user->identity->getId();
            $tour->deposit = (Yii::$app->params['depositPercentage'] / 100) * $tour->priceAdult;
            $tour->descExtra = json_encode($tour->descExtra);
            $tour->inclusion = json_encode($tour->inclusion);
            $tour->exclusion = json_encode($tour->exclusion);
            $itinerary = [];
            foreach ($tour->itinerary as $key => $values) {
                $itinerary[$values['itineraryTime']] = $values['itineraryDesc'];
            }
            $tour->itinerary = json_encode($itinerary);
            $tour->duration = Tour::wordsToSeconds($tour->duration);
            $tour->payMethod = json_encode($tour->payMethod);

            if ($tour->save()) {
                $tourLocation->tourId = $tour->id;
                $tourLocation->countryId = $country->id;
                $tourLocation->cityId = $city->id;
                $tourLocation->save();

                foreach ($tourDates->allDates as $key => $values) {
                    $tourDates = new TourDates();
                    $tourDates->tourId = $tour->id;
                    $tourDates->attributes = $values;
                    $tourDates->save();
                }
                
                $tourPhotos->tourId = $tour->id;
                $tourPhotos->userId = Yii::$app->user->identity->getId();
                $promoImage = $tourPhotos->uploadPromoImage($tourPhotos->promoImage);
                if ($tourPhotos->save()) {
                    $path = $tourPhotos->getImageFile($tour->id);
                    file_put_contents($path, $promoImage);
                }

                $images = UploadedFile::getInstances($tourPhotos, 'images');
                foreach ($images as $image) {
                    $tourPhoto = new TourPhotos();
                    $tourPhoto->tourId = $tour->id;
                    $tourPhoto->userId = Yii::$app->user->identity->getId();
                    $imageResource = $tourPhoto->uploadImage($image);
                    if ($tourPhoto->save()) {
                        $path = $tourPhoto->getImageFile($tour->id);
                        imagejpeg($imageResource, $path);
                    }
                }

                $allPoints = json_decode($pickupPoints->allPoints, true);
                foreach ($allPoints as $point) {
                    $pickupPoint = new PickupPoints();
                    $pickupPoint->tourId = $tour->id;
                    $pickupPoint->attributes = $point;
                    $pickupPoint->save();
                }

                foreach ($groups->newGroups as $key => $values) {
                    $group = new Groups();
                    $group->tourId = $tour->id;
                    $group->attributes = $values;
                    $group->save();
                }

                return $this->redirect(['view', 'id' => $tour->id]);
            }
        } else {
            return $this->render('create', [
                'tour' => $tour,
                'country' => $newCountry,
                'city' => $newCity,
                'tourPhotos' => $tourPhotos,
                'tourDates' => $tourDates,
                'languagesList' => $languagesList,
                'typesList' => $typesList,
                'groups' => $groups,
                'pickupPoints' => $pickupPoints,
            ]);
        }
    }
    
    /**
     * Deletes an existing Tour model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tour model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tour the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tour::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
