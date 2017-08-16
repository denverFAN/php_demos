<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\web\JsExpression;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $orders app\models\Orders */

$this->title = 'Order';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('/css/order.css');
$this->registerCssFile('/css/bootstrap-datetimepicker-standalone.css');
$this->registerJs("var pickupPoints = $tourPickupPoints; var guideDates = [];", $this::POS_HEAD);
$this->registerJsFile('/js/order.js');
$this->registerJsFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyB5sXmmhv29RSYXsyobgNq4gks1OT-zLr0&libraries=places&language=en&callback=initMap');
?>

<div class="l-action l-action--textBlock">
    <div class="l-mainContent">
        <div class="l-action__content--textBlock">
            <div class="l-action__textBlock">
                <p class="l-action__text--white l-action__text--bold">
                    Order!
                </p>
            </div>
        </div>
    </div>
</div>
<!--<div class="l-tools">
    <div class="l-tools__content l-mainContent cf">
        <div class="l-tools__leftPart">
            <div class="c-breadCrumbs">
                <a class="c-breadCrumbs__link" href="#">
                    Main
                </a>
                <div class="c-breadCrumbs__arrow">
                    <svg class="c-breadCrumbs__icon" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 46.02 46.02">
                        <path d="M14.757 46.02c-1.412 0-2.825-.521-3.929-1.569-2.282-2.17-2.373-5.78-.204-8.063L23.382 22.97 10.637 9.645C8.46 7.37 8.54 3.76 10.816 1.582c2.277-2.178 5.886-2.097 8.063.179l16.505 17.253c2.104 2.2 2.108 5.665.013 7.872L18.893 44.247c-1.123 1.177-2.626 1.773-4.136 1.773z"/>
                    </svg>
                </div>
            </div>
            <div class="c-breadCrumbs">
                <a class="c-breadCrumbs__link" href="#">
                    Order
                </a>
                <div class="c-breadCrumbs__arrow">
                    <svg class="c-breadCrumbs__icon" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 46.02 46.02">
                        <path d="M14.757 46.02c-1.412 0-2.825-.521-3.929-1.569-2.282-2.17-2.373-5.78-.204-8.063L23.382 22.97 10.637 9.645C8.46 7.37 8.54 3.76 10.816 1.582c2.277-2.178 5.886-2.097 8.063.179l16.505 17.253c2.104 2.2 2.108 5.665.013 7.872L18.893 44.247c-1.123 1.177-2.626 1.773-4.136 1.773z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>-->
<div class="l-mainContent cf">
    <div class="c-fakeSteps">
        <ul class="c-fakeSteps__list">
            <li class="c-fakeSteps__item">
                <span class="c-fakeSteps__text active">
                    Step 1
                </span>
            </li>
            <li class="c-fakeSteps__item">
                <span class="c-fakeSteps__text">
                    Step 2
                </span>
            </li>
            <li class="c-fakeSteps__item">
                <svg class="c-fakeSteps__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 426.667 426.667">
                    <path d="M213.333,0C95.518,0,0,95.514,0,213.333s95.518,213.333,213.333,213.333
	c117.828,0,213.333-95.514,213.333-213.333S331.157,0,213.333,0z M174.199,322.918l-93.935-93.931l31.309-31.309l62.626,62.622
	l140.894-140.898l31.309,31.309L174.199,322.918z"/>
                </svg>
            </li>
        </ul>
    </div>
    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'l-order'],
    ]) ?>
        <? foreach ($orders as $index => $order) { ?>
        <? $this->registerJs("guideDates[$order->tourId] = {$order->tour->getGuideDates($order->languageId)};", $this::POS_HEAD) ?>
        <div class="c-orderItem">
            <div class="c-orderItem__wrapper">
                <div class="c-orderItem__title">
                    <?= $order->tour->name ?>
                </div>
                <div class="c-orderItem__body">
                    <div class="c-orderItem__errorBlock">
                        <div class="c-orderItem__errorTitle">
                            Important information
                        </div>
                        <div class="c-orderItem__errorText">
                            <?= $order->tour->addInfo ?>
                        </div>
                    </div>
                    <div class="c-orderItem__label--black">
                        1. Travellers
                    </div>
                    <div class="c-orderItem__radioGroup">
                        <div class="c-orderItem__radioItem">
                            <label class="c-orderItem__radioLabel">
                                <span class="c-orderItem__radioText">Choose travellers</span>
                                <input class="c-orderItem__radioButton" name="radioTravellers-<?= $order->tourId ?>" type="radio" value="0" checked>
                                <span class="c-orderItem__radioRect"></span>
                            </label>
                        </div>
                        <? if (!empty($order->tour->groups)) { ?>
                        <div class="c-orderItem__radioItem">
                            <label class="c-orderItem__radioLabel">
                                <span class="c-orderItem__radioText">Choose groups</span>
                                <input class="c-orderItem__radioButton" name="radioTravellers-<?= $order->tourId ?>" type="radio" value="1">
                                <span class="c-orderItem__radioRect"></span>
                            </label>
                        </div>
                        <? } ?>
                    </div>
                    <div class="c-orderItem__inputBlock">
                        <div class="c-orderItem__chooseGroup" id="chooseGroup-<?= $order->tourId ?>" style="display:none">
                            <div class="c-orderItem__label--normal">
                                Choose group:
                            </div>
                            <?= $form->field($order, "[$index]groupId")->widget(Select2::classname(), [
                                'data' => $order->tour->groupsList,
                                'disabled' => true,
                                'options' => [
                                    'placeholder' => 'Choose group',
                                    'class' => 'c-orderItem__select',
                                ],
                            ])->label(false) ?>
                        </div>
                        <div class="c-orderItem__chooseTravellers" id="chooseTravellers-<?= $order->tourId ?>">
                            <? if (!empty($order->tour->priceAdult)) { ?>
                            <div class="c-orderItem__inputColumn">
                                <div class="c-orderItem__inputLabel">
                                    Adults
                                </div>
                                <?= $form->field($order, "[$index]totalAdult")->textInput(['class' => 'c-orderItem__input--small', 'placeholder' => '- Adult -'])->label(false) ?>
                            </div>
                            <? } ?>
                            <? if (!empty($order->tour->priceChild)) { ?>
                            <div class="c-orderItem__inputColumn">
                                <div class="c-orderItem__inputLabel">
                                    Children
                                </div>
                                <?= $form->field($order, "[$index]totalChild")->textInput(['class' => 'c-orderItem__input--small', 'placeholder' => '- Child -'])->label(false) ?>
                            </div>
                            <? } ?>
                            <? if (!empty($order->tour->priceInfant)) { ?>
                            <div class="c-orderItem__inputColumn">
                                <div class="c-orderItem__inputLabel">
                                    Infants
                                </div>
                                <?= $form->field($order, "[$index]totalInfant")->textInput(['class' => 'c-orderItem__input--small', 'placeholder' => '- Infant -'])->label(false) ?>
                            </div>
                            <? } ?>
                            <? if (!empty($order->tour->priceSenior)) { ?>
                            <div class="c-orderItem__inputColumn">
                                <div class="c-orderItem__inputLabel">
                                    Seniors
                                </div>
                                <?= $form->field($order, "[$index]totalSenior")->textInput(['class' => 'c-orderItem__input--small', 'placeholder' => '- Senior -'])->label(false) ?>
                            </div>
                            <? } ?>
                        </div>
                    </div>
                    <div class="c-orderItem__columnBlock cf">
                        <div class="c-orderItem__column--left">
                            <div class="c-orderItem__label--black">
                                2. Choose guide
                            </div>
                            <?= $form->field($order, "[$index]languageId")->widget(Select2::classname(), [
                                'data' => $order->tour->guidesList,
                                'options' => [
                                    'class' => 'c-orderItem__select',
                                    'id' => "chosenGuide-$order->tourId",
                                    'placeholder' => 'Guide',
                                ],
                            ])->label(false) ?>
                        </div>
                        <div class="c-orderItem__column--right">
                            <div class="c-orderItem__label--black">
                                3. Pick date
                            </div>
                            <?= $form->field($order, "[$index]dateStartTour")->widget(DatePicker::classname(), [
                                'type' => DatePicker::TYPE_INPUT,
                                'options' => [
                                    'id' => "guideDatepicker-$order->tourId",
                                    'class' => 'c-orderItem__input',
                                ],
                                'pluginOptions' => [
                                    'format' => 'd/m/yyyy',
                                    'beforeShowDay' => new JsExpression("
                                        function(date) {
                                            if ($.inArray(date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear(), guideDates[$order->tourId]) !== -1) {
                                                return;
                                            } else {
                                                return false;
                                            }
                                        }
                                    ")
                                ],
                            ])->label(false) ?>
                        </div>
                    </div>
                    <div class="c-orderItem__label--black">
                        4. Contact info
                    </div>
                    <div class="c-orderItem__columnBlock cf">
                        <div class="c-orderItem__column--left">
                            <div class="c-orderItem__label--normal">
                                Lead traveller’s first name
                            </div>
                            <?= $form->field($order, "[$index]leadFirstname")->textInput(['class' => 'c-orderItem__input', 'placeholder' => 'First name', 'value' => ''])->label(false) ?>
                        </div>
                        <div class="c-orderItem__column--right">
                            <div class="c-orderItem__label--normal">
                                Lead traveller’s last name
                            </div>
                            <?= $form->field($order, "[$index]leadLastname")->textInput(['class' => 'c-orderItem__input', 'placeholder' => 'Last name', 'value' => ''])->label(false) ?>
                        </div>
                        <div class="c-orderItem__separator"></div>
                        <div class="c-orderItem__column--left">
                            <div class="c-orderItem__label--normal">
                                Lead traveller’s phone number
                            </div>
                            <?= $form->field($order, "[$index]leadPhone")->textInput(['class' => 'c-orderItem__input', 'placeholder' => 'Phone number', 'value' => ''])->label(false) ?>
                        </div>
                        <div class="c-orderItem__column--right">
                            <div class="c-orderItem__label--normal">
                                Lead traveller’s e-mail
                            </div>
                            <?= $form->field($order, "[$index]leadEmail")->textInput(['class' => 'c-orderItem__input', 'placeholder' => 'E-mail', 'value' => ''])->label(false) ?>
                        </div>
                    </div>
                    <div class="c-orderItem__label--black">
                        5. Pickup points
                    </div>
                    <div class="c-orderItem__radioGroup">
                        <div class="c-orderItem__radioItem">
                            <img class="c-orderItem__radioImg" src="/img/map/map_marker.png">
                            <label class="c-orderItem__radioLabel">
                                <span class="c-orderItem__radioText">Pickup points</span>
                                <input class="c-orderItem__radioButton" name="choosePickup-<?= $order->tourId ?>" type="radio" value="0">
                                <span class="c-orderItem__radioRect"></span>
                            </label>
                        </div>
                        <div class="c-orderItem__radioItem">
                            <svg class="c-orderItem__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 46.087 46.087">
                                <path d="M44.6,7.162h-3.379v11.625h1.351v5.338h-2.568V6.487C40.005,2.904,37.1,0,33.517,0H12.162   C8.58,0,5.675,2.904,5.675,6.487v17.3h-2.23v-5.678h1.419V6.487H1.486v11.622h1.419v6.22h2.77v12.705   c0,2.454,1.366,4.593,3.379,5.694v3.358h5.676V43.52h16.083v2.567h5.678v-3.294c2.086-1.076,3.513-3.251,3.513-5.76V24.664h3.109   v-5.878h1.487L44.6,7.162L44.6,7.162z M15.407,1.35h15.136v3.516H15.407V1.35z M17.028,36.762H8.649V32.98h8.379V36.762z    M37.301,36.762h-8.379V32.98h8.379V36.762z M37.301,24.598c0,0-1.622,5.137-14.596,5.137c-12.976,0-14.328-5.137-14.328-5.137   V6.756h28.924V24.598z"></path>
                            </svg>
                            <label class="c-orderItem__radioLabel">
                                <span class="c-orderItem__radioText">Hotel Pick-Up and Drop-Off</span>
                                <input class="c-orderItem__radioButton" name="choosePickup-<?= $order->tourId ?>" type="radio" value="1">
                                <span class="c-orderItem__radioRect"></span>
                            </label>
                        </div>
                    </div>
                    <div class="c-orderItem__pickupBlock">
                        <div id="selectPickup-<?= $order->tourId ?>" style="display:none">
                            <div class="c-orderItem__label--normal">
                                Select your Pick-Up and Drop-Off address
                            </div>
                            <?= $form->field($order, "[$index]pickInfo")->widget(Select2::classname(), [
                                'data' => $order->tour->pickupPointsList,
                                'disabled' => true,
                                'options' => [
                                    'class' => 'c-orderItem__select',
                                    'placeholder' => '- Pickup Points -',
                                ],
                            ])->label(false) ?>
                        </div>
                        <div id="typePickup-<?= $order->tourId ?>" style="display:none">
                            <div class="c-orderItem__label--normal">
                                Enter your Pick-Up and Drop-Off address
                            </div>
                            <?= $form->field($order, "[$index]pickInfo")->textInput([
                                'class' => 'c-orderItem__input',
                                'placeholder' => 'Enter your Pick-Up and Drop-Off address',
                                'disabled' => true,
                            ])->label(false) ?>
                        </div>
                    </div>
                    <div class="c-orderItem__map" id="map-<?=$order->tourId?>"></div>
                </div>
            </div>
            <div class="c-orderItem__bottom">
                <div class="c-orderItem__bottomColumn">
                    <? if ($order->totalAdult) { ?>
                    <div class="c-orderItem__bottomBlock">
                        <span class="c-orderItem__bottomText--gray">
                            <?= "$".$order->tour->priceAdult." x $order->totalAdult Adults:" ?>
                        </span>
                        <span class="c-orderItem__bottomText--lightblue">
                            <?= "$".$order->tour->priceAdult * $order->totalAdult."" ?>
                        </span>
                    </div>
                    <? } ?>
                    <? if ($order->totalChild) { ?>
                    <div class="c-orderItem__bottomBlock">
                        <span class="c-orderItem__bottomText--gray">
                            <?= "$".$order->tour->priceChild." x $order->totalChild Children:" ?>
                        </span>
                        <span class="c-orderItem__bottomText--lightblue">
                            <?= "$".$order->tour->priceChild * $order->totalChild."" ?>
                        </span>
                    </div>
                    <? } ?>
                </div>
                <div class="c-orderItem__bottomColumn">
                    <? if ($order->totalInfant) { ?>
                    <div class="c-orderItem__bottomBlock">
                        <span class="c-orderItem__bottomText--gray">
                            <?= "$".$order->tour->priceInfant." x $order->totalInfant Infants:" ?>
                        </span>
                        <span class="c-orderItem__bottomText--gray">
                            <?= "$".$order->tour->priceInfant * $order->totalInfant."" ?>
                        </span>
                    </div>
                    <? } ?>
                    <? if ($order->totalSenior) { ?>
                    <div class="c-orderItem__bottomBlock">
                        <span class="c-orderItem__bottomText--gray">
                            <?= "$".$order->tour->priceSenior." x $order->totalSenior Senior:" ?>
                        </span>
                        <span class="c-orderItem__bottomText--gray">
                            <?= "$".$order->tour->priceSenior * $order->totalSenior."" ?>
                        </span>
                    </div>
                    <? } ?>
                </div>
                <div class="c-orderItem__line"></div>
                <div class="c-orderItem__bottomColumn">
                    <div class="c-orderItem__bottomBlock">
                        <span class="c-orderItem__bottomText--black">
                             Booking deposit:
                        </span>
                        <span class="c-orderItem__bottomText--lightblue">
                            $<?= $order->payPrice ?>
                        </span>
                    </div>
                    <div class="c-orderItem__bottomBlock">
                        <span class="c-orderItem__bottomText--black">
                            Remaining balance:
                        </span>
                        <span class="c-orderItem__bottomText--lightblue">
                            $<?= $order->totalPrice - $order->payPrice ?>
                        </span>
                    </div>
                </div>
                <div class="c-orderItem__bottomColumn">
                    <div class="c-orderItem__bottomBlock">
                        <span class="c-orderItem__total">
                            Per tour:
                        </span>
                        <span class="c-orderItem__totalPrice">
                            $<?= $order->totalPrice ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="c-orderItem__toggle">
            <svg class="c-orderItem__toggleIcon c-orderItem__toggleIcon--rotate" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129">
                <path d="m121.3,34.6c-1.6-1.6-4.2-1.6-5.8,0l-51,51.1-51.1-51.1c-1.6-1.6-4.2-1.6-5.8,0-1.6,1.6-1.6,4.2 0,5.8l53.9,53.9c0.8,0.8 1.8,1.2 2.9,1.2 1,0 2.1-0.4 2.9-1.2l53.9-53.9c1.7-1.6 1.7-4.2 0.1-5.8z"/>
            </svg>
        </div>
        <? } ?>
        <div class="l-order__priceBlock">
            <div class="l-order__priceText">
                <span class="l-order__priceTitle">
                    Total:
                </span>
                <span class="l-order__priceSum">
                    $<?= $totalPriceSum ?>
                </span>
            </div>
            <div class="l-order__priceText">
                <span class="l-order__priceTitle">
                    Pay now:
                </span>
                <span class="l-order__priceSum">
                    $<?= $payPriceSum ?>
                </span>
            </div>
            <?= Html::submitButton('Payment', ['class' => 'c-button']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
