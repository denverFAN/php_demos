<?php

use app\assets\CroppieAsset;
use app\assets\StepsAsset;

/* @var $this yii\web\View */
/* @var $model app\models\Tour */

$this->title = 'Add your listing!';
$this->params['breadcrumbs'][] = ['label' => 'Tours', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('/css/addTour.css');
$this->registerCssFile('/css/bootstrap-fileinput-standalone.css');
$this->registerCssFile('/css/bootstrap-datetimepicker-standalone.css');
$this->registerJsFile('/js/createTour.js');
$this->registerJsFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyB5sXmmhv29RSYXsyobgNq4gks1OT-zLr0&libraries=places&language=en&callback=initMap');
CroppieAsset::register($this);
StepsAsset::register($this);
?>

<div class="l-action l-action--textBlock">
    <div class="l-mainContent">
        <div class="l-action__content--textBlock">
            <div class="l-action__textBlock">
                <p class="l-action__text--white l-action__text--bold">
                    Add your listing!
                </p>
            </div>
        </div>
    </div>
</div>
<div class="l-mainContent">
    <?= $this->render('_formAddTour', [
        'tour' => $tour,
        'country' => $country,
        'city' => $city,
        'tourPhotos' => $tourPhotos,
        'tourDates' => $tourDates,
        'languagesList' => $languagesList,
        'typesList' => $typesList,
        'groups' => $groups,
        'pickupPoints' => $pickupPoints,
    ]) ?>
</div>
