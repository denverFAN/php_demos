<?php

use yii\helpers\Html;
use app\assets\StickyKitAsset;

/* @var $this yii\web\View */
/* @var $tour app\models\Tour */

$this->title = $tour->name;
$this->params['breadcrumbs'][] = ['label' => 'Tours', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('/css/viewTour.css');
$this->registerCssFile('/css/bootstrap-datetimepicker-standalone.css');
$this->registerJs("var pickupPoints = $tourPickupPoints; var guideDates;", $this::POS_HEAD);
$this->registerJsFile('/js/viewTour.js');
$this->registerJsFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyB5sXmmhv29RSYXsyobgNq4gks1OT-zLr0&libraries=places&language=en&callback=initMap');
StickyKitAsset::register($this);
?>
<!--<p>
    <?/*= Html::a('Update', ['update', 'id' => $tour->id], ['class' => 'btn btn-primary']) */?>
    <?/*= Html::a('Delete', ['delete', 'id' => $tour->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Are you sure you want to delete this item?',
            'method' => 'post',
        ],
    ]) */?>
</p>-->

<div class="l-action l-action--newLocation" style="background-image: url(<?= Yii::$app->request->baseUrl.'/uploads/photos/'.$tour->id .'/'.$tour->promoPhoto->src ?>);">
    <div class="l-mainContent">
        <div class="c-photosHover">
            <button class="c-button c-button--noneTransform">
                View photos
            </button>
            <div class="c-photosHover__thumbnails">
                <? foreach ($tour->tourPhotos as $photo) { ?>
                <a href="#" class="c-photosHover__thumbnail">
                    <img class="c-photosHover__photo" src="<?= Yii::$app->request->baseUrl.'/uploads/photos/'.$photo->tourId .'/'.$photo->src ?>">
                </a>
                <? } ?>
            </div>
        </div>
    </div>
</div>
<div class="l-newLocation">
    <div class="l-newLocation__navWrapper">
        <div class="l-mainContent cf">
            <div class="l-newLocation__leftPart">
                <div class="l-newLocation__nav cf">
                    <ul class="c-tabNav">
                        <li class="c-tabNav__list">
                            <a href="#js-tabBlock1" class="c-tabNav__point">Overview </a>
                        </li>
                        <li class="c-tabNav__list">
                            <a href="#" class="c-tabNav__point">Photos</a>
                        </li>
                        <li class="c-tabNav__list">
                            <a href="#js-tabBlock2" class="c-tabNav__point">What's included</a>
                        </li>
                        <li class="c-tabNav__list">
                            <a href="#js-tabBlock3" class="c-tabNav__point">Itinerary</a>
                        </li>
                        <li class="c-tabNav__list">
                            <a href="#js-tabBlock4" class="c-tabNav__point">Important info</a>
                        </li>
                        <li class="c-tabNav__list">
                            <a href="#js-tabBlock5" class="c-tabNav__point">Reviews</a>
                        </li>
                        <li class="c-tabNav__list">
                            <a href="#js-tabBlock6" class="c-tabNav__point">Pick-up points</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="l-newLocation__body l-mainContent cf">
        <div class="l-newLocation__leftPart article1">
            <div class="l-newLocation__header l-mainContent">
                <div class="l-newLocation__head"><?= $tour->name ?></div>
                <div class="l-newLocation__rating">
                    <div class="c-rating">
                        <div class="c-rating__stars">
                            <? $ratingInStars = floor($tour->ratings);
                            for ($i = 0; $i < 5; $i++) {
                                if ($ratingInStars > 0) {
                                    echo "<div class='c-rating__star'><img class='c-rating__icon' src='/img/icon/starLightBlue.svg'></div>";
                                } else {
                                    echo "<div class='c-rating__star'><img class='c-rating__icon' src='/img/icon/starGrey.svg'></div>";
                                }
                                $ratingInStars--;
                            } ?>
                        </div>
                        <div class="c-rating__value"><?= round($tour->ratings, 2) ?></div>
                        <div class="c-rating__reviews">
                            <div class="c-rating__reviews__number">0</div>
                            <div class="c-rating__reviews__text">Reviews</div>
                        </div>
                        <div class="c-rating__country">
                            <?= Html::a($tour->countries->continent.',', ['index', 'TourSearch' => ['continent' => $tour->countries->continent]], ['class' => 'c-rating__country__link']) ?>
                            <?= Html::a($tour->countries->name.',', ['index', 'TourSearch' => ['country' => $tour->countries->id]], ['class' => 'c-rating__country__link']) ?>
                            <?= Html::a($tour->cities->name, ['index', 'TourSearch' => ['city' => $tour->cities->id]], ['class' => 'c-rating__country__link']) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="l-newLocation__tabs">
                <div class="c-locationTabs">
                    <div class="c-locationTabs__body">
                        <div class="c-locationTabs__content">
                            <div id="js-tabBlock1" class="c-locationTabs__headArticle">
                                Overview
                            </div>
                            <div class="c-locationTabs__block">
                                <div class="c-locationTabs__listColumns--wrapper">
                                    <ol class="c-locationTabs__listColumns">
                                        <li class="c-locationTabs__item">
                                            <svg class="c-locationTabs__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 472.617 472.617">
                                                <path d="M453.652,157.878c-3.656-9.651-14.438-14.515-24.093-10.859c-9.648,3.647-14.511,14.436-10.857,24.088     c17.961,47.441,16.837,99.245-3.163,145.879c-20.531,47.865-58.47,84.874-106.837,104.206     c-48.364,19.33-101.361,18.674-149.227-1.854c-13.88-5.952-26.834-13.366-38.719-22.068     c-29.116-21.332-51.765-50.429-65.491-84.771c-19.333-48.363-18.679-101.358,1.85-149.231     c20.53-47.866,58.477-84.876,106.842-104.212c46.279-18.496,96.796-18.641,143.004-0.635l-13.242,22.365     c-3.638,6.144-0.842,10.244,6.202,9.104l62.911-10.156c7.048-1.139,10.868-7.582,8.474-14.307l-21.34-60.051     c-2.39-6.726-7.324-7.209-10.957-1.062l-12.77,21.561c-56.603-23.77-119.088-24.33-176.159-1.518     C92.45,47.396,47.238,91.495,22.769,148.538c-24.465,57.041-25.25,120.202-2.21,177.836     c16.361,40.929,43.344,75.597,78.048,101.015c14.158,10.371,29.605,19.205,46.137,26.292     c57.044,24.461,120.195,25.25,177.827,2.218c57.64-23.034,102.849-67.142,127.312-124.188     C473.716,276.148,475.055,214.406,453.652,157.878z"/>
                                                <path d="M228.112,90.917c-8.352,0-15.128,6.771-15.128,15.13v150.745l137.872,71.272c2.219,1.148,4.593,1.693,6.931,1.688     c5.478,0,10.765-2.979,13.455-8.183c3.833-7.424,0.931-16.549-6.499-20.389l-121.496-62.81V106.047     C243.246,97.688,236.475,90.917,228.112,90.917z"/>
                                            </svg>
                                            Duration - <?= $tour->secondsToWords($tour->duration) ?>
                                        </li>
                                        <li class="c-locationTabs__item">
                                            <svg class="c-locationTabs__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 492.5 492.5">
                                                <path class="st0" d="M82.8,0C48.3,0,20.3,28,20.3,62.4s28,62.4,62.4,62.4s62.4-28,62.4-62.4S117.2,0,82.8,0z M82.8,105.1
            c-23.5,0-42.6-19.1-42.6-42.6s19.1-42.6,42.6-42.6s42.6,19.1,42.6,42.6S106.3,105.1,82.8,105.1z"/>
                                                <path class="st1" d="M82.8,183.9c-34.4,0-62.4,28-62.4,62.4s28,62.4,62.4,62.4s62.4-28,62.4-62.4S117.2,183.9,82.8,183.9z
             M82.8,288.9c-23.5,0-42.6-19.1-42.6-42.6s19.1-42.6,42.6-42.6s42.6,19.1,42.6,42.6S106.3,288.9,82.8,288.9z"/>
                                                <path class="st0" d="M82.8,367.7c-34.4,0-62.4,28-62.4,62.4s28,62.4,62.4,62.4s62.4-28,62.4-62.4S117.2,367.7,82.8,367.7z
             M82.8,472.8c-23.5,0-42.6-19.1-42.6-42.6s19.1-42.6,42.6-42.6s42.6,19.1,42.6,42.6C125.3,453.6,106.3,472.8,82.8,472.8z"/>
                                                <path class="st0" d="M472.1,59.1c0-5.5-4.4-9.9-9.9-9.9h-250c-5.5,0-9.9,4.4-9.9,9.9s4.4,9.9,9.9,9.9h250
            C467.8,69,472.1,64.6,472.1,59.1z"/>
                                                <path class="st1" d="M208.9,236.4c-5.5,0-9.9,4.4-9.9,9.9s4.4,9.9,9.9,9.9h250c5.5,0,9.9-4.4,9.9-9.9s-4.4-9.9-9.9-9.9H208.9z"/>
                                                <path class="st0" d="M468.8,430.1c0-5.5-4.4-9.9-9.9-9.9h-250c-5.5,0-9.9,4.4-9.9,9.9s4.4,9.9,9.9,9.9h250
            C464.4,440,468.8,435.6,468.8,430.1z"/>
                                            </svg>
                                            <?= $tour->type->type ?>
                                        </li>
                                    </ol>
                                    <ol class="c-locationTabs__listColumns">
                                        <li class="c-locationTabs__item">
                                            <svg class="c-locationTabs__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64.8 64.8">
                                                <path class="st0" d="M57.4,17l-0.7,0.7c-1.3,1.3-2.3,1.7-4.3,1.7c-4.1,0-7-2.9-7-7c0-2,0.4-3,1.7-4.3l0.7-0.7L40.4,0L0,40.4
        l7.4,7.4l0.7-0.7c1.3-1.3,2.3-1.7,4.3-1.7c4.1,0,7,2.9,7,7c0,2-0.4,3-1.7,4.3L17,57.4l7.4,7.4l40.4-40.4L57.4,17z M19.8,57.4
        c1.2-1.4,1.6-2.8,1.6-5c0-5.1-3.9-9-9-9c-2.2,0-3.6,0.4-5,1.6l-4.6-4.6l23.6-23.6l3.3,3.3l1.4-1.4l-3.3-3.3L40.4,2.8L45,7.4
        c-1.2,1.4-1.6,2.8-1.6,5c0,5.1,3.9,9,9,9c2.2,0,3.5-0.4,5-1.6l4.6,4.6L49.4,37l-3.3-3.3l-1.4,1.4l3.3,3.3L24.4,62L19.8,57.4z"/>
                                                <path class="st0" d="M35.7,26.1l-4-4l1.4-1.4l4,4L35.7,26.1z"/>
                                                <path class="st0" d="M42.7,33.1l-4-4l1.4-1.4l4,4L42.7,33.1z"/>
                                            </svg>
                                            e-Voucher
                                            <div class="c-locationTabs__tooltip">
                                                What’s this?
                                                <span class="c-locationTabs__tooltipText">
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                    In aliquet eget risus ut tristique. Sed vitae blandit augue.
                                                    Cras aliquam risus dictum maximus lobortis. In nec tellus dignissim,
                                                    eleifend erat ac, dictum leo. Donec et pellentesque dolor.
                                                    In nec tellus dignissim, eleifend erat ac, dictum leo. Donec et pellentesque dolor.
                                                    Donec et pellentesque dolor.
                                                </span>
                                            </div>
                                        </li>
                                        <? if ($tour->hotelPickup) { ?>
                                        <li class="c-locationTabs__item">
                                            <svg class="c-locationTabs__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 46.087 46.087">
                                                <path d="M44.6,7.162h-3.379v11.625h1.351v5.338h-2.568V6.487C40.005,2.904,37.1,0,33.517,0H12.162   C8.58,0,5.675,2.904,5.675,6.487v17.3h-2.23v-5.678h1.419V6.487H1.486v11.622h1.419v6.22h2.77v12.705   c0,2.454,1.366,4.593,3.379,5.694v3.358h5.676V43.52h16.083v2.567h5.678v-3.294c2.086-1.076,3.513-3.251,3.513-5.76V24.664h3.109   v-5.878h1.487L44.6,7.162L44.6,7.162z M15.407,1.35h15.136v3.516H15.407V1.35z M17.028,36.762H8.649V32.98h8.379V36.762z    M37.301,36.762h-8.379V32.98h8.379V36.762z M37.301,24.598c0,0-1.622,5.137-14.596,5.137c-12.976,0-14.328-5.137-14.328-5.137   V6.756h28.924V24.598z"/>
                                            </svg>
                                            Hotel Pick-Up and Drop-Off
                                        </li>
                                        <? } ?>
                                    </ol>
                                </div>
                                <ol class="c-locationTabs__listBlock--noMarkers">
<!--                                    <li class="c-locationTabs__item">
                                        <div class="c-locationTabs__listText--pin">
                                            Hotel Pick-Up and Drop-Off Zone: meeting points located long the coast from Los Cristianos to Los Gigantes, including Las Americas and Costa Adeje.
                                        </div>
                                    </li>-->
                                    <li class="c-locationTabs__item">
                                        <div class="c-locationTabs__listText--guide">
                                            Guide: <?= $tourGuides ?>
                                            <div class="c-locationTabs__tooltip">
                                                Guide options
                                                <span class="c-locationTabs__tooltipText">
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                    In aliquet eget risus ut tristique. Sed vitae blandit augue.
                                                    Cras aliquam
                                                </span>
                                            </div>
                                        </div>
                                    </li>
                                </ol>
                                <div class="c-locationTabs__textBlock">
                                    <div class="c-locationTabs__text">
                                        <?= substr($tour->descLong, 0, 203) ?>
                                    </div>
                                    <input class="c-locationTabs__textMore" id="toggle" type="checkbox">
                                    <div id="textMore__expand">
                                        <div class="c-locationTabs__text">
                                            <?= substr($tour->descLong, 203, strlen($tour->descLong)) ?>
                                        </div>
                                    </div>
                                    <label class="c-locationTabs__textMore--label" for="toggle"></label>
                                </div>
                            </div>
                            <div class="c-locationTabs__block cf">
                                <ul class="c-locationTabs__listBlock">
                                    <?php foreach (json_decode($tour->descExtra) as $descExtra) { ?>
                                        <li class="c-locationTabs__item">
                                            <?= $descExtra ?>
                                        </li>
                                    <?php } ?>
                                </ul>
<!--                                <div class="c-locationTabs__listBlock--right">
                                    <img src="/img/tour/photoNewLoc.jpg" class="c-locationTabs__img">
                                </div>-->
                            </div>
                            <div id="js-tabBlock2" class="c-locationTabs__headArticle">What's included</div>
                            <div class="c-locationTabs__block cf">
                                <div class="c-locationTabs__listBlock">
                                    <div class="c-locationTabs__listName">Inclusions:</div>
                                    <ul class="c-locationTabs__list">
                                        <?php foreach (json_decode($tour->inclusion) as $inclusion) { ?>
                                            <li class="c-locationTabs__item">
                                                <?= $inclusion ?>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <div class="c-locationTabs__listBlock--right">
                                    <div class="c-locationTabs__listName">
                                        Exclusions:
                                    </div>
                                    <ul class="c-locationTabs__list">
                                        <?php foreach (json_decode($tour->exclusion) as $exclusion) { ?>
                                            <li class="c-locationTabs__item">
                                                <?= $exclusion ?>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                            <div id="js-tabBlock3" class="c-locationTabs__headArticle">
                                Itinerary
                            </div>
                            <div class="c-locationTabs__block">
                                <?php foreach (json_decode($tour->itinerary, true) as $time => $desc) { ?>
                                    <div class="c-locationTabs__textBlock">
                                        <div class="c-locationTabs__time"><?= $time ?></div>
                                        <div class="c-locationTabs__text"><?= $desc ?></div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div id="js-tabBlock4" class="c-locationTabs__headArticle">
                                Important information
                            </div>
                            <div class="c-locationTabs__listName">
                                Additional Information:
                            </div>
                            <ul class="c-locationTabs__list">
                                <li class="c-locationTabs__item">
                                    <?= $tour->addInfo ?>
                                </li>
                            </ul>
                            <div class="c-locationTabs__block--wrapper">
                                <div class="c-locationTabs__listName">
                                    Pricing & Availability:
                                </div>
                                <ul class="c-locationTabs__list">
                                    <li class="c-locationTabs__item">
                                        Simulate booking to check pricing & availability on your preferred travel date. Our pricing is constantly updated. Your currency is set to EUR. Click here to change your currency.
                                    </li>
                                </ul>
                                <div class="c-locationTabs__listName">
                                    Booking Deposit & Balance:
                                </div>
                                <ul class="c-locationTabs__list">
                                    <li class="c-locationTabs__item">
                                        You pay the Booking Deposit at the time of booking with credit or debit card, or PayPal
                                    </li>
                                    <li class="c-locationTabs__item">
                                        Remaining Balance you pay on the day of Tour/Activity directly to the Tour/Activity provider. Following payment methods are accepted by the Tour/Activity provider:
                                    </li>
                                </ul>
                                <div class="c-locationTabs__inlineItems">
                                    <? foreach (json_decode($tour->payMethod) as $payMethod) { ?>
                                        <? if($payMethod == 1) { ?>
                                            <div class="c-locationTabs__inlinelistName--credit">
                                                Credit or debit card
                                            </div>
                                        <? } elseif($payMethod == 2) { ?>
                                            <div class="c-locationTabs__inlinelistName--cashGreen">
                                                Cash in USD
                                            </div>
                                        <? } elseif($payMethod == 3) { ?>
                                            <div class="c-locationTabs__inlinelistName--cashLocal">
                                                Cash in Local currency
                                            </div>
                                        <? } ?>
                                    <? } ?>
                                </div>
                                <div class="c-locationTabs__listName">
                                    Departure Time
                                </div>
                                <ul class="c-locationTabs__list">
                                    <li class="c-locationTabs__item">
                                        We always use local time at the destination.
                                    </li>
                                    <li class="c-locationTabs__item">
                                        Pickups start at 7:30 AM and depend on the <a class="c-locationTabs__link" href="#"> Meeting Point </a>. You can also contact the local activity provider to confirm your exact pickup time and Meeting Point, to be sure you understand it correctly.
                                    </li>
                                </ul>
                                <div class="c-locationTabs__listName">
                                    Return details
                                </div>
                                <ul class="c-locationTabs__list">
                                    <li class="c-locationTabs__item">
                                        Returns to original departure point
                                    </li>
                                </ul>
                                <div class="c-locationTabs__listName">
                                    Cancellation Policy
                                </div>
                                <ul class="c-locationTabs__list">
                                    <li class="c-locationTabs__item">
                                        If you cancel at least 7 day(s) in advance of the scheduled departure, there is no cancellation fee.
                                    </li>
                                    <li class="c-locationTabs__item">
                                        If you cancel between 3 and 6 day(s) in advance of the scheduled departure, there is a 50 percent cancellation fee.
                                    </li>
                                    <li class="c-locationTabs__item">
                                        If you cancel within 2 day(s) of the scheduled departure, there is a 100 percent cancellation fee.
                                    </li>
                                    <li class="c-locationTabs__item">
                                        In the case of Activity/Tour cancellation or no availability your Booking Deposit is 100% refunded.
                                    </li>
                                </ul>
                                <div class="c-locationTabs__listName">
                                    Activity ID
                                </div>
                                <ul class="c-locationTabs__list">
                                    <li class="c-locationTabs__item">
                                        <?= $tour->id ?>
                                    </li>
                                </ul>
                            </div>
<!--                            <div class="c-locationTabs__footer">
                                <div id="js-tabBlock5" class="c-locationTabs__headArticle">
                                    Our travellers reviews
                                    <a href="#" class="c-locationTabs__link--reviews">
                                        40 Reviews
                                    </a>
                                </div>
                                <div class="c-locationTabs__rating">
                                    <div class="c-rating">
                                        <div class="c-rating__reviews c-rating__reviews--null">
                                            <div class="c-rating__reviews__text">
                                                Overal rating:
                                            </div>
                                        </div>
                                        <div class="c-rating__stars">
                                            <div class="c-rating__star">
                                                <img src="img/icon/starLightBlue.svg" class="c-rating__icon">
                                            </div>
                                            <div class="c-rating__star">
                                                <img src="img/icon/starLightBlue.svg" class="c-rating__icon">
                                            </div>
                                            <div class="c-rating__star">
                                                <img src="img/icon/starLightBlue.svg" class="c-rating__icon">
                                            </div>
                                            <div class="c-rating__star">
                                                <img src="img/icon/starGrey.svg" class="c-rating__icon">
                                            </div>
                                            <div class="c-rating__star">
                                                <img src="img/icon/starGrey.svg" class="c-rating__icon">
                                            </div>
                                        </div>
                                        <div class="c-rating__value">(3.3)</div>
                                    </div>
                                </div>
                                <div class="c-locationTabs__comments">
                                    <div class="c-locationTabs__comment">
                                        <div class="c-comment">
                                            <div class="c-comment__wrapper cf">
                                                <div class="c-comment__likeWrapper">
                                                    <a class="c-comment__like" href="#">
                                                        <svg class="c-comment__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 489.543 489.543">
                                                            <path d="M270.024,0c-22.6,0-15,48.3-15,48.3s-48.3,133.2-94.5,168.7c-9.9,10.4-16.1,21.9-20,31.3l0,0l0,0    c-0.9,2.3-1.7,4.5-2.4,6.5c-3.1,6.3-9.7,16-23.8,24.5l46.2,200.9c0,0,71.5,9.3,143.2,7.8c28.7,2.3,59.1,2.5,83.3-2.7    c82.2-17.5,61.6-74.8,61.6-74.8c44.3-33.3,19.1-74.9,19.1-74.9c39.4-41.1,0.7-75.6,0.7-75.6s21.3-33.2-6.2-58.3    c-34.3-31.4-127.4-10.5-127.4-10.5l0,0c-6.5,1.1-13.4,2.5-20.8,4.3c0,0-32.2,15,0-82.7C346.324,15.1,292.624,0,270.024,0z" />
                                                            <path d="M127.324,465.7l-35-166.3c-2-9.5-11.6-17.3-21.3-17.3h-66.8l-0.1,200.8h109.1C123.024,483,129.324,475.2,127.324,465.7z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                                <div class="c-person">
                                                    <div class="c-person__content">
                                                        <div class="c-person__photo">
                                                            <img src="img/comment/userImg1.png"
                                                                 class="c-person__img c-person__img--big">
                                                        </div>
                                                        <div class="c-person__info">
                                                            <a href="#" class="c-person__button">
                                                                My Tripspoint page
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="c-comment__rightWrapper">
                                                    <a href="#" class="c-comment__name">
                                                        Erica Nameston
                                                    </a>
                                                    <div class="c-comment__info">
                                                        <div class="c-comment__rating">
                                                            <div class="c-rating">
                                                                <div class="c-rating__stars">
                                                                    <div class="c-rating__star">
                                                                        <img src="img/icon/starLightBlue.svg"
                                                                             class="c-rating__icon">
                                                                    </div>
                                                                    <div class="c-rating__star">
                                                                        <img src="img/icon/starLightBlue.svg"
                                                                             class="c-rating__icon">
                                                                    </div>
                                                                    <div class="c-rating__star">
                                                                        <img src="img/icon/starLightBlue.svg"
                                                                             class="c-rating__icon">
                                                                    </div>
                                                                    <div class="c-rating__star">
                                                                        <img src="img/icon/starGrey.svg"
                                                                             class="c-rating__icon">
                                                                    </div>
                                                                    <div class="c-rating__star">
                                                                        <img src="img/icon/starGrey.svg"
                                                                             class="c-rating__icon">
                                                                    </div>
                                                                </div>
                                                                <div class="c-rating__value">(3.3)</div>
                                                            </div>
                                                        </div>
                                                        <div class="c-comment__date">
                                                            12 Sep 2016
                                                        </div>
                                                    </div>
                                                    <a href="#" class="c-comment__head">
                                                        The most interesting museum I ever
                                                        saw visiting Europe
                                                    </a>
                                                    <div class="c-comment__text">
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sollicitudin rhoncus nisi, nec volutpat arcu consectetur et. Aliquam varius placerat enim id blandit. Maecenas hendrerit interdum arcu vitae sagittis. Aliquam varius placerat enim id blandit Maecenas hendrerit interdum arcu vitae sagittis. Aliquam varius placerat enim id bland. Aliquam varius placerat enim id blandit Maecenas hendrerit interdum arcu vitae sagittis. Aliquam varius placerat enim id blandAliquam varius placerat enim id bland. Aliquam varius placerat enim id blandit Maecenas hendrerit interdum arcu vitae sagittis. Aliquam varius placerat enim id bland
                                                    </div>
                                                    <input class="c-locationTabs__textMore" id="toggleCommentlast" type="checkbox">
                                                    <div id="textMoreComment__expand">
                                                        <div class="c-locationTabs__text">Stand in awe beneath the looming Mt Teide volcano and explore the lavasculpted landscapes of the UNESCO-listed Mt Teide National Park on this 8hour tour. Choose from two different itineraries depending on your pickup point: those arriving from south Tenerife will stop off at the unique rock formations of Cañadas del Teide and Los Roques de García; while the northern route passes through the serene
                                                        </div>
                                                    </div>
                                                    <label class="c-locationTabs__textMore--labelComment" for="toggleCommentlast"></label>
                                                    <div class="c-comment__photos list">
                                                        <div class="c-comment__photo item">
                                                            <img src="img/tour/c-tour__img2.jpg" class="c-comment__img">
                                                        </div>
                                                        <div class="c-comment__photo item">
                                                            <img src="img/tour/c-tour__img2.jpg" class="c-comment__img">
                                                        </div>
                                                        <div class="c-comment__photo item">
                                                            <img src="img/tour/c-tour__img2.jpg" class="c-comment__img">
                                                        </div>
                                                        <div class="c-comment__photo item">
                                                            <img src="img/tour/c-tour__img2.jpg" class="c-comment__img">
                                                        </div>
                                                        <div class="c-comment__photo item">
                                                            <img src="img/tour/c-tour__img2.jpg" class="c-comment__img">
                                                        </div>
                                                        <div class="c-comment__photo item">
                                                            <img src="img/tour/c-tour__img2.jpg" class="c-comment__img">
                                                        </div>
                                                    </div>
                                                    <a href="#" class="c-comment__link">
                                                        See all photos ›
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="c-locationTabs__comment">
                                        <div class="c-comment">
                                            <div class="c-comment__wrapper cf">
                                                <div class="c-comment__likeWrapper">
                                                    <a class="c-comment__like" href="#">
                                                        <svg class="c-comment__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 489.543 489.543">
                                                            <path d="M270.024,0c-22.6,0-15,48.3-15,48.3s-48.3,133.2-94.5,168.7c-9.9,10.4-16.1,21.9-20,31.3l0,0l0,0    c-0.9,2.3-1.7,4.5-2.4,6.5c-3.1,6.3-9.7,16-23.8,24.5l46.2,200.9c0,0,71.5,9.3,143.2,7.8c28.7,2.3,59.1,2.5,83.3-2.7    c82.2-17.5,61.6-74.8,61.6-74.8c44.3-33.3,19.1-74.9,19.1-74.9c39.4-41.1,0.7-75.6,0.7-75.6s21.3-33.2-6.2-58.3    c-34.3-31.4-127.4-10.5-127.4-10.5l0,0c-6.5,1.1-13.4,2.5-20.8,4.3c0,0-32.2,15,0-82.7C346.324,15.1,292.624,0,270.024,0z" />
                                                            <path d="M127.324,465.7l-35-166.3c-2-9.5-11.6-17.3-21.3-17.3h-66.8l-0.1,200.8h109.1C123.024,483,129.324,475.2,127.324,465.7z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                                <div class="c-person">
                                                    <div class="c-person__content">
                                                        <div class="c-person__photo">
                                                            <img src="img/comment/userImg1.png"
                                                                 class="c-person__img c-person__img--big">
                                                        </div>
                                                        <div class="c-person__info">
                                                            <a href="#" class="c-person__button">
                                                                My Tripspoint page
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="c-comment__rightWrapper">
                                                    <a href="#" class="c-comment__name">
                                                        Erica Nameston
                                                    </a>
                                                    <div class="c-comment__info">
                                                        <div class="c-comment__rating">
                                                            <div class="c-rating">
                                                                <div class="c-rating__stars">
                                                                    <div class="c-rating__star">
                                                                        <img src="img/icon/starLightBlue.svg"
                                                                             class="c-rating__icon">
                                                                    </div>
                                                                    <div class="c-rating__star">
                                                                        <img src="img/icon/starLightBlue.svg"
                                                                             class="c-rating__icon">
                                                                    </div>
                                                                    <div class="c-rating__star">
                                                                        <img src="img/icon/starLightBlue.svg"
                                                                             class="c-rating__icon">
                                                                    </div>
                                                                    <div class="c-rating__star">
                                                                        <img src="img/icon/starGrey.svg"
                                                                             class="c-rating__icon">
                                                                    </div>
                                                                    <div class="c-rating__star">
                                                                        <img src="img/icon/starGrey.svg"
                                                                             class="c-rating__icon">
                                                                    </div>
                                                                </div>
                                                                <div class="c-rating__value">(3.3)</div>
                                                            </div>
                                                        </div>
                                                        <div class="c-comment__date">
                                                            12 Sep 2016
                                                        </div>
                                                    </div>
                                                    <a href="#" class="c-comment__head">
                                                        The most interesting museum I ever
                                                        saw visiting Europe
                                                    </a>
                                                    <div class="c-comment__text">
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sollicitudin rhoncus nisi, nec volutpat arcu consectetur et. Aliquam varius placerat enim id blandit. Maecenas hendrerit interdum arcu vitae sagittis. Aliquam varius placerat enim id blandit Maecenas hendrerit interdum arcu vitae sagittis. Aliquam varius placerat enim id bland. Aliquam varius placerat enim id blandit Maecenas hendrerit interdum arcu vitae sagittis. Aliquam varius placerat enim id blandAliquam varius placerat enim id bland. Aliquam varius placerat enim id blandit Maecenas hendrerit interdum arcu vitae sagittis. Aliquam varius placerat enim id bland
                                                    </div>
                                                    <input class="c-locationTabs__textMore" id="toggleCommentfirst" type="checkbox">
                                                    <div id="textMoreComment__expand">
                                                        <div class="c-locationTabs__text">Stand in awe beneath the looming Mt Teide volcano and explore the lavasculpted landscapes of the UNESCO-listed Mt Teide National Park on this 8hour tour. Choose from two different itineraries depending on your pickup point: those arriving from south Tenerife will stop off at the unique rock formations of Cañadas del Teide and Los Roques de García; while the northern route passes through the serene
                                                        </div>
                                                    </div>
                                                    <label class="c-locationTabs__textMore--labelComment" for="toggleCommentfirst"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="c-button__buttonWrap">
                                        <button class="c-button">
                                            More
                                        </button>
                                        <div class="c-button__buttonTooltip">
                                            View all Travelers Reviews
                                        </div>
                                    </div>
                                </div>
                            </div>-->
                            <div id="js-tabBlock6" class="c-locationTabs__headArticle">
                                What’s included
                            </div>
                            <ul class="c-locationTabs__list">
                                <li class="c-locationTabs__item">
                                    PickUp & DropOff Zone: our pickup points located long the coast from Los Cristianos to Los Gigantes, including Las Americas and Costa Adeje
                                </li>
                                <li class="c-locationTabs__item">
                                    <a class="c-locationTabs__link" href="#"> Hover a PickUp point on the map to see departure details.
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="l-newLocation__rightPart aside1">
            <div class="l-newLocation__booking">
                <?= $this->render('_formBookNow', [
                    'order' => $order,
                    'tour' => $tour,
                ]) ?>
            </div>
            <div class="c-booking">
                <div class="c-booking__content">
                    <ol class="c-booking__list">
                        <li class="c-booking__links">
                            <a class="c-booking__link" href="#">
                                <svg class="c-booking__icon"
                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 51.997 51.997">
                                    <path d="M51.911 16.242c-.759-8.354-6.672-14.415-14.072-14.415-4.93 0-9.444 2.653-11.984 6.905-2.517-4.307-6.846-6.906-11.697-6.906C6.759 1.826.845 7.887.087 16.241c-.06.369-.306 2.311.442 5.478 1.078 4.568 3.568 8.723 7.199 12.013l18.115 16.439 18.426-16.438c3.631-3.291 6.121-7.445 7.199-12.014.748-3.166.502-5.108.443-5.477z"/>
                                </svg>
                                Add to wishlist
                            </a>
                        </li>
                        <li class="c-booking__links">
                            <a class="c-booking__link" href="#">
                                <svg class="c-booking__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14">
                                    <path d="M7,9L5.268,7.484l-4.952,4.245C0.496,11.896,0.739,12,1.007,12h11.986    c0.267,0,0.509-0.104,0.688-0.271L8.732,7.484L7,9z" />
                                    <path d="M13.684,2.271C13.504,2.103,13.262,2,12.993,2H1.007C0.74,2,0.498,2.104,0.318,2.273L7,8    L13.684,2.271z"/>
                                    <polygon points="0,2.878 0,11.186 4.833,7.079   "/>
                                    <polygon points="9.167,7.079 14,11.186 14,2.875   "/>
                                </svg>
                                Email
                            </a>
                        </li>
                        <li class="c-booking__links">
                            <a class="c-booking__link" href="#">
                                <svg class="c-booking__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 58 58">
                                    <path d="M53,3.293H5c-2.722,0-5,2.278-5,5v33c0,2.722,2.278,5,5,5h27.681l-4.439-5.161
        c-0.36-0.418-0.313-1.05,0.106-1.41c0.419-0.36,1.051-0.312,1.411,0.106l4.998,5.811L43,54.707v-8.414h2h6h2c2.722,0,5-2.278,5-5
        v-33C58,5.571,55.722,3.293,53,3.293z"/>
                                </svg>
                                Contact support
                            </a>
                        </li>
                        <li class="c-booking__links">
                            <a class="c-booking__link" href="#">
                                <svg class="c-booking__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 59 59">
                                    <path d="M47,39c-2.671,0-5.182,1.04-7.071,2.929c-0.524,0.524-0.975,1.1-1.365,1.709l-17.28-10.489  C21.741,32.005,22,30.761,22,29.456c0-1.305-0.259-2.549-0.715-3.693l17.284-10.409C40.345,18.142,43.456,20,47,20  c5.514,0,10-4.486,10-10S52.514,0,47,0S37,4.486,37,10c0,1.256,0.243,2.454,0.667,3.562L20.361,23.985  c-1.788-2.724-4.866-4.529-8.361-4.529c-5.514,0-10,4.486-10,10s4.486,10,10,10c3.495,0,6.572-1.805,8.36-4.529L37.664,45.43  C37.234,46.556,37,47.759,37,49c0,2.671,1.04,5.183,2.929,7.071C41.818,57.96,44.329,59,47,59s5.182-1.04,7.071-2.929  C55.96,54.183,57,51.671,57,49s-1.04-5.183-2.929-7.071C52.182,40.04,49.671,39,47,39z"/>
                                </svg>
                                Share
                            </a>
                        </li>
                        <li class="c-booking__links">
                            <a class="c-booking__link" href="#">
                                <svg class="c-booking__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 457.03 457.03">
                                    <path d="M421.512,207.074l-85.795,85.767c-47.352,47.38-124.169,47.38-171.529,0c-7.46-7.439-13.296-15.821-18.421-24.465   l39.864-39.861c1.895-1.911,4.235-3.006,6.471-4.296c2.756,9.416,7.567,18.33,14.972,25.736c23.648,23.667,62.128,23.634,85.762,0   l85.768-85.765c23.666-23.664,23.666-62.135,0-85.781c-23.635-23.646-62.105-23.646-85.768,0l-30.499,30.532   c-24.75-9.637-51.415-12.228-77.373-8.424l64.991-64.989c47.38-47.371,124.177-47.371,171.557,0   C468.869,82.897,468.869,159.706,421.512,207.074z M194.708,348.104l-30.521,30.532c-23.646,23.634-62.128,23.634-85.778,0   c-23.648-23.667-23.648-62.138,0-85.795l85.778-85.767c23.665-23.662,62.121-23.662,85.767,0   c7.388,7.39,12.204,16.302,14.986,25.706c2.249-1.307,4.56-2.369,6.454-4.266l39.861-39.845   c-5.092-8.678-10.958-17.03-18.421-24.477c-47.348-47.371-124.172-47.371-171.543,0L35.526,249.96   c-47.366,47.385-47.366,124.172,0,171.553c47.371,47.356,124.177,47.356,171.547,0l65.008-65.003   C246.109,360.336,219.437,357.723,194.708,348.104z"/>
                                </svg>
                                Get Link
                            </a>
                        </li>
                        <li class="c-booking__links">
                            <a class="c-booking__link" href="#">
                                <svg class="c-booking__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 58 58">
                                    <polygon points="48,37 39.564,37 29.177,52 18.79,37 10,37 0,58 58,58 "/>
                                    <path d="M42.03,5.324L42.03,5.324c-7.098-7.098-18.607-7.098-25.706,0h0C9.928,11.72,9.208,23.763,14.636,31
    l14.541,21l14.541-21C49.146,23.763,48.426,11.72,42.03,5.324z M29.354,24c-3.314,0-6-2.686-6-6s2.686-6,6-6s6,2.686,6,6
    S32.667,24,29.354,24z"/>
                                </svg>
                                Pin it
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="c-locationTabs__mapWrap js-locationTabs__mapWrap">
            <div class="c-locationTabs__map js-locationTabs__map" id="map">
<!--                <div class="c-pickupPoints__form">
                    <div class="c-pickupPoints__title">
                        Millenium Bank
                    </div>
                    <div class="c-pickupPoints__guide">
                        Guide:
                        <span class="c-pickupPoints__guide--name">
                                    English
                                </span>
                    </div>
                    <div class="c-pickupPoints__time">
                        Departure at:
                        <span class="c-pickupPoints__time--clock">
                                    8:25 AM
                                </span>
                    </div>
                    <div class="c-pickupPoints__desc">
                        Public Bus Stop in front of the Millenium Bank in Minneapolis (by the glass
                        wall), SouthWest Street.
                    </div>
                </div>-->
            </div>
        </div>
    </div>

<!--    <div class="l-newLocation__body l-mainContent cf">
        <div class="c-locationTabs__headArticle">You may also like</div>
        <div class="l-newLocation__leftPart">
            <div class="l-newLocation__tour">
                <div class="l-newLocation__tours">
                    <div class="l-newLocation__tour">
                        <div class="c-tour">
                            <div class="c-tour__content cf">
                                <div class="c-tour__header">
                                    <img src="img/tour/c-tour__img2.jpg" class="c-tour__img">
                                    <div class="c-tour__bg"></div>
                                </div>
                                <div class="c-tour__body">
                                    <a href="#" class="c-tour__head">Acropolis Museum Bus Tour from the city of Tessaloniki by coach with guide
                                    </a>
                                    <div class="c-tour__text">Tour description 160 characters longTour description 160 characters long Tour description 160 characters longTour description 160 characters longTour description 160 character...
                                        <a href="#" class="c-tour__readMore">
                                            Read more ›
                                        </a>
                                    </div>
                                    <div class="c-tour__info cf">
                                        <div class="c-tour__leftPart">
                                            <div class="c-time">
                                                <div class="c-time__img">
                                                    <svg class="c-time__icon"
                                                         xmlns="http://www.w3.org/2000/svg"
                                                         viewBox="0 0 100 100">
                                                        <path d="M49.9 11C28.4 11 11 28.4 11 49.9c0 21.4 17.4 38.9 38.9 38.9 21.4 0 38.9-17.4 38.9-38.9C88.7 28.4 71.3 11 49.9 11zm0 69.5c-16.9 0-30.6-13.7-30.6-30.6C19.3 33 33 19.3 49.9 19.3c16.9 0 30.6 13.7 30.6 30.6 0 16.8-13.8 30.6-30.6 30.6zm0 0"></path>
                                                        <path d="M70.1 48.7H52.7v-21c0-1.8-1.4-3.2-3.2-3.2-1.8 0-3.2 1.4-3.2 3.2v24.2c0 1.8 1.4 3.2 3.2 3.2h20.7c1.8 0 3.2-1.4 3.2-3.2-.1-1.8-1.5-3.2-3.3-3.2zm0 0"></path>
                                                    </svg>
                                                </div>
                                                <div class="c-time__text">Duration:</div>
                                                <div class="c-time__clock">10 h 45 m</div>
                                            </div>
                                        </div>
                                        <div class="c-tour__rightPart">
                                            <div class="c-rating">
                                                <div class="c-rating__stars">
                                                    <div class="c-rating__star">
                                                        <img src="img/icon/starLightBlue.svg"  class="c-rating__icon">
                                                    </div>
                                                    <div class="c-rating__star">
                                                        <img src="img/icon/starLightBlue.svg"  class="c-rating__icon">
                                                    </div>
                                                    <div class="c-rating__star">
                                                        <img src="img/icon/starLightBlue.svg"  class="c-rating__icon">
                                                    </div>
                                                    <div class="c-rating__star">
                                                        <img src="img/icon/starGrey.svg"  class="c-rating__icon">
                                                    </div>
                                                    <img src="img/icon/starGrey.svg"  class="c-rating__icon">
                                                </div>
                                                <div class="c-rating__value">(3.3)</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="c-tour__footer">
                                    <div class="c-tour__priceBlock">
                                        <div class="c-tour__textRight">Price from</div>
                                        <div class="c-tour__price">$106</div>
                                    </div>
                                    <div class="c-tour__bookBlock">
                                        <div class="c-tour__text c-tour__text--lightColor">Book with
                                        </div>
                                        <div class="c-tour__book">$19.35</div>
                                    </div>
                                    <div class="c-tour__buttonWrap">
                                        <div class="c-button c-button--tourDetails">Details</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="l-newLocation__tour">
                        <div class="c-tour">
                            <div class="c-tour__content cf">
                                <div class="c-tour__header">
                                    <img src="img/tour/c-tour__img3.jpg" class="c-tour__img">
                                    <div class="c-tour__bg"></div>
                                </div>
                                <div class="c-tour__body">
                                    <a href="#" class="c-tour__head">Acropolis Museum Bus Tour from the city of Tessaloniki by coach with guide
                                    </a>
                                    <div class="c-tour__text">Tour description 160 characters longTour description 160 characters long Tour description 160 characters longTour description 160 characters longTour description 160 character...
                                        <a href="#" class="c-tour__readMore">
                                            Read more ›
                                        </a>
                                    </div>
                                    <div class="c-tour__info cf">
                                        <div class="c-tour__leftPart">
                                            <div class="c-time">
                                                <div class="c-time__img">
                                                    <svg class="c-time__icon"
                                                         xmlns="http://www.w3.org/2000/svg"
                                                         viewBox="0 0 100 100">
                                                        <path d="M49.9 11C28.4 11 11 28.4 11 49.9c0 21.4 17.4 38.9 38.9 38.9 21.4 0 38.9-17.4 38.9-38.9C88.7 28.4 71.3 11 49.9 11zm0 69.5c-16.9 0-30.6-13.7-30.6-30.6C19.3 33 33 19.3 49.9 19.3c16.9 0 30.6 13.7 30.6 30.6 0 16.8-13.8 30.6-30.6 30.6zm0 0"></path>
                                                        <path d="M70.1 48.7H52.7v-21c0-1.8-1.4-3.2-3.2-3.2-1.8 0-3.2 1.4-3.2 3.2v24.2c0 1.8 1.4 3.2 3.2 3.2h20.7c1.8 0 3.2-1.4 3.2-3.2-.1-1.8-1.5-3.2-3.3-3.2zm0 0"></path>
                                                    </svg>
                                                </div>
                                                <div class="c-time__text">Duration:</div>
                                                <div class="c-time__clock">10 h 45 m</div>
                                            </div>
                                        </div>
                                        <div class="c-tour__rightPart">
                                            <div class="c-rating">
                                                <div class="c-rating__stars">
                                                    <div class="c-rating__star">
                                                        <img src="img/icon/starLightBlue.svg"  class="c-rating__icon">
                                                    </div>
                                                    <div class="c-rating__star">
                                                        <img src="img/icon/starLightBlue.svg"  class="c-rating__icon">
                                                    </div>
                                                    <div class="c-rating__star">
                                                        <img src="img/icon/starLightBlue.svg"  class="c-rating__icon">
                                                    </div>
                                                    <div class="c-rating__star">
                                                        <img src="img/icon/starGrey.svg"  class="c-rating__icon">
                                                    </div>
                                                    <img src="img/icon/starGrey.svg"  class="c-rating__icon">
                                                </div>
                                                <div class="c-rating__value">(3.3)</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="c-tour__footer">
                                    <div class="c-tour__priceBlock">
                                        <div class="c-tour__textRight">Price from</div>
                                        <div class="c-tour__price">$106</div>
                                    </div>
                                    <div class="c-tour__bookBlock">
                                        <div class="c-tour__text c-tour__text--lightColor">Book with
                                        </div>
                                        <div class="c-tour__book">$19.35</div>
                                    </div>
                                    <div class="c-tour__buttonWrap">
                                        <div class="c-button c-button--tourDetails">Details</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="l-newLocation__tour">
                        <div class="c-tour">
                            <div class="c-tour__content cf">
                                <div class="c-tour__header">
                                    <img src="img/tour/c-tour__img4.jpg" class="c-tour__img">
                                    <div class="c-tour__bg"></div>
                                </div>
                                <div class="c-tour__body">
                                    <a href="#" class="c-tour__head">Acropolis Museum Bus Tour from the city of Tessaloniki by coach with guide
                                    </a>
                                    <div class="c-tour__text">Tour description 160 characters longTour description 160 characters long Tour description 160 characters longTour description 160 characters longTour description 160 character...
                                        <a href="#" class="c-tour__readMore">
                                            Read more ›
                                        </a>
                                    </div>
                                    <div class="c-tour__info cf">
                                        <div class="c-tour__leftPart">
                                            <div class="c-time">
                                                <div class="c-time__img">
                                                    <svg class="c-time__icon"
                                                         xmlns="http://www.w3.org/2000/svg"
                                                         viewBox="0 0 100 100">
                                                        <path d="M49.9 11C28.4 11 11 28.4 11 49.9c0 21.4 17.4 38.9 38.9 38.9 21.4 0 38.9-17.4 38.9-38.9C88.7 28.4 71.3 11 49.9 11zm0 69.5c-16.9 0-30.6-13.7-30.6-30.6C19.3 33 33 19.3 49.9 19.3c16.9 0 30.6 13.7 30.6 30.6 0 16.8-13.8 30.6-30.6 30.6zm0 0"></path>
                                                        <path d="M70.1 48.7H52.7v-21c0-1.8-1.4-3.2-3.2-3.2-1.8 0-3.2 1.4-3.2 3.2v24.2c0 1.8 1.4 3.2 3.2 3.2h20.7c1.8 0 3.2-1.4 3.2-3.2-.1-1.8-1.5-3.2-3.3-3.2zm0 0"></path>
                                                    </svg>
                                                </div>
                                                <div class="c-time__text">Duration:</div>
                                                <div class="c-time__clock">10 h 45 m</div>
                                            </div>
                                        </div>
                                        <div class="c-tour__rightPart">
                                            <div class="c-rating">
                                                <div class="c-rating__stars">
                                                    <div class="c-rating__star">
                                                        <img src="img/icon/starLightBlue.svg"  class="c-rating__icon">
                                                    </div>
                                                    <div class="c-rating__star">
                                                        <img src="img/icon/starLightBlue.svg"  class="c-rating__icon">
                                                    </div>
                                                    <div class="c-rating__star">
                                                        <img src="img/icon/starLightBlue.svg"  class="c-rating__icon">
                                                    </div>
                                                    <div class="c-rating__star">
                                                        <img src="img/icon/starGrey.svg"  class="c-rating__icon">
                                                    </div>
                                                    <img src="img/icon/starGrey.svg"  class="c-rating__icon">
                                                </div>
                                                <div class="c-rating__value">(3.3)</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="c-tour__footer">
                                    <div class="c-tour__priceBlock">
                                        <div class="c-tour__textRight">Price from</div>
                                        <div class="c-tour__price">$106</div>
                                    </div>
                                    <div class="c-tour__bookBlock">
                                        <div class="c-tour__text c-tour__text--lightColor">Book with
                                        </div>
                                        <div class="c-tour__book">$19.35</div>
                                    </div>
                                    <div class="c-tour__buttonWrap">
                                        <div class="c-button c-button--tourDetails">Details</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="c-button__buttonWrap">
                    <button class="c-button">
                        More
                    </button>
                    <div class="c-button__buttonTooltip">
                        View all Rentals and Services
                    </div>
                </div>
            </div>
        </div>
        <div class="l-newLocation__rightPartBlocks">
            <div class="c-booking__block">
                <div class="c-locationTabs__headArticle">
                    Local Accomodations
                </div>
                <ul class="c-booking__holidays">
                    <li class="c-booking__holiday">
                        <div class="c-listing c-listing--lowHeight">
                            <a href="#" class="c-listing__link">
                                <img class="c-listing__img" src="img/listing/listingImg1.jpg">
                                <div class="c-listing__bg"></div>
                                <div class="c-listing__body">
                                    <div class="c-listing__content">
                                        <div class="c-listing__head">Caribbean Islands
                                            Cruise - days from Miami
                                        </div>
                                    </div>
                                </div>
                                <div class="c-blockBottom--listings">
                                    <div class="c-blockBottom__leftSide">
                                        from
                                        <span class="c-blockBottom__price">
                                                            $799
                                                        </span>
                                    </div>
                                    <div class="c-blockBottom__rightSide">
                                        <button class="c-button c-button--smallButton">More</button>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </li>
                    <li class="c-booking__holiday">
                        <div class="c-listing c-listing--lowHeight">
                            <a href="#" class="c-listing__link">
                                <img class="c-listing__img" src="img/listing/listingImg1.jpg">
                                <div class="c-listing__bg"></div>
                                <div class="c-listing__body">
                                    <div class="c-listing__content">
                                        <div class="c-listing__head">Caribbean Islands
                                            Cruise - days from Miami
                                        </div>
                                    </div>
                                </div>
                                <div class="c-blockBottom--listings">
                                    <div class="c-blockBottom__leftSide">
                                        from
                                        <span class="c-blockBottom__price">
                                                            $799
                                                        </span>
                                    </div>
                                    <div class="c-blockBottom__rightSide">
                                        <button class="c-button c-button--smallButton">More</button>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </li>
                    <li class="c-booking__holiday">
                        <div class="c-listing c-listing--lowHeight">
                            <a href="#" class="c-listing__link">
                                <img class="c-listing__img" src="img/listing/listingImg1.jpg">
                                <div class="c-listing__bg"></div>
                                <div class="c-listing__body">
                                    <div class="c-listing__content">
                                        <div class="c-listing__head">Caribbean Islands
                                            Cruise - days from Miami
                                        </div>
                                    </div>
                                </div>
                                <div class="c-blockBottom--listings">
                                    <div class="c-blockBottom__leftSide">
                                        from
                                        <span class="c-blockBottom__price">
                                                            $799
                                                        </span>
                                    </div>
                                    <div class="c-blockBottom__rightSide">
                                        <button class="c-button c-button--smallButton">More</button>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </li>
                </ul>
                <button class="c-button">
                    More
                </button>
                <div class="c-button__buttonTooltip--small">
                    View all Accomodations
                </div>
            </div>
        </div>
    </div>-->
</div>
