<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\web\JsExpression;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $order app\models\Orders */
/* @var $form ActiveForm */
?>
<?php $form = ActiveForm::begin([
    'action' => '/order/create',
    'options' => ['class' => 'c-bookingForm'],
]) ?>
<?= $form->field($order, 'tourId')->hiddenInput(['value' => $tour->id])->label(false) ?>
<?= $form->field($order, 'providerId')->hiddenInput(['value' => $tour->providerId])->label(false) ?>

    <div class="c-bookingForm__content">
        <div class="c-bookingForm__header">
            <div class="c-bookingForm__wrapper">
                <div class="c-bookingForm__text">Book now just with Booking Deposit</div>
            </div>
            <div class="c-bookingForm__number">$<?= $tour->deposit ?></div>
            <div class="c-bookingForm__text--span">per adult</div>
        </div>
        <div class="c-bookingForm__info">The balance of $<?= $tour->priceAdult - $tour->deposit ?> you will pay on the day of the activity</div>
        <div class="c-bookingForm__body">
            <div class="c-bookingForm__tabs" id="c-bookingForm__tabs">
                <ul class="c-bookingForm__tabList">
                    <li class="c-bookingForm__tab">
                        <a class="c-bookingForm__tabLink" href="#tabs-travellers">Travellers</a>
                    </li>
                    <? if (!empty($tour->groups)) { ?>
                    <li class="c-bookingForm__tab">
                        <a class="c-bookingForm__tabLink" href="#tabs-groups">Groups</a>
                    </li>
                    <? } ?>
                </ul>
                <div class="c-bookingForm__tool c-bookingForm__modal cf" id="tabs-travellers">
                    <div class="c-bookingForm__head">Travellers</div>
                    <button type="button" class="c-bookingForm__select js-bookingForm__selection">
                        <div class="c-bookingForm__selectedText">
                            Choose travellers
                        </div>
                        <div class="c-bookingForm__selectedIcon c-bookingForm__selectedIcon--rotated">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 455 455">
                                <path d="M0,0v455h455V0H0z M334.411,296.683L227.5,190.12L120.589,296.683l-21.179-21.248L227.5,147.763l128.089,127.672 L334.411,296.683z" fill="#00bcd4"/>
                            </svg>
                        </div>
                    </button>
                    <div class="c-bookingForm__modalWindow hide">
                        <? if (!empty($tour->priceAdult)) { ?>
                        <div class="c-bookingForm__row">
                            <div class="c-bookingForm__modalHead">Adults (16-50)</div>
                            <div class="c-bookingForm__numberBlock">
                                <input type='button' value='–' class='c-bookingForm__quantity--minus' field='Orders[totalAdult]'/>
                                <?= $form->field($order, 'totalAdult')->textInput(['value' => '1', 'class' => 'c-bookingForm__quantity', 'readonly' => true])->label(false) ?>
                                <input type='button' value='+' class='c-bookingForm__quantity--plus' field='Orders[totalAdult]'/>
                            </div>
                        </div>
                        <? } ?>
                        <? if (!empty($tour->priceChild)) { ?>
                        <div class="c-bookingForm__row">
                            <div class="c-bookingForm__modalHead">Children (1-15)</div>
                            <div class="c-bookingForm__numberBlock">
                                <input type='button' value='–' class='c-bookingForm__quantity--minus' field='Orders[totalChild]'/>
                                <?= $form->field($order, 'totalChild')->textInput(['value' => '0', 'class' => 'c-bookingForm__quantity', 'readonly' => true])->label(false) ?>
                                <input type='button' value='+' class='c-bookingForm__quantity--plus' field='Orders[totalChild]'/>
                            </div>
                        </div>
                        <? } ?>
                        <? if (!empty($tour->priceInfant)) { ?>
                        <div class="c-bookingForm__row">
                            <div class="c-bookingForm__modalHead">Infants (0-12m.)</div>
                            <div class="c-bookingForm__numberBlock">
                                <input type='button' value='–' class='c-bookingForm__quantity--minus' field='Orders[totalInfant]'/>
                                <?= $form->field($order, 'totalInfant')->textInput(['value' => '0', 'class' => 'c-bookingForm__quantity', 'readonly' => true])->label(false) ?>
                                <input type='button' value='+' class='c-bookingForm__quantity--plus' field='Orders[totalInfant]'/>
                            </div>
                        </div>
                        <? } ?>
                        <? if (!empty($tour->priceSenior)) { ?>
                        <div class="c-bookingForm__row">
                            <div class="c-bookingForm__modalHead">Seniors (51-65)</div>
                            <div class="c-bookingForm__numberBlock">
                                <input type='button' value='–' class='c-bookingForm__quantity--minus' field='Orders[totalSenior]'/>
                                <?= $form->field($order, 'totalSenior')->textInput(['value' => '0', 'class' => 'c-bookingForm__quantity', 'readonly' => true])->label(false) ?>
                                <input type='button' value='+' class='c-bookingForm__quantity--plus' field='Orders[totalSenior]'/>
                            </div>
                        </div>
                        <? } ?>
                    </div>
                </div>
                <? if (!empty($tour->groups)) { ?>
                <div class="c-bookingForm__tool cf" id="tabs-groups">
                    <div class="c-bookingForm__head">Group</div>
                    <?= $form->field($order, 'groupId')->widget(Select2::classname(), [
                        'data' => $tour->groupsList,
                        'options' => [
                            'placeholder' => 'Choose group',
                            'class' => 'c-bookingForm__select js-bookingForm__select--group',
                        ],
                    ])->label(false) ?>
                </div>
                <? } ?>
            </div>
            <div class="c-bookingForm__tool cf">
                <div class="c-bookingForm__head">Language options</div>
            </div>
            <div class="c-bookingForm__tool">
                <?= $form->field($order, 'languageId')->widget(Select2::classname(), [
                    'data' => $tour->guidesList,
                    'options' => [
                        'placeholder' => 'Choose guide',
                        'class' => 'c-bookingForm__select',
                        'id' => 'chosenGuide',
                    ],
                ])->label(false) ?>
            </div>
            <div class="c-bookingForm__tool c-bookingForm__tool--disabled cf">
                <div class="c-bookingForm__head">Select available date</div>
            </div>
            <div class="c-bookingForm__tool c-bookingForm__tool--disabled">
                <?= $form->field($order, "dateStartTour")->widget(DatePicker::classname(), [
                    'type' => DatePicker::TYPE_INPUT,
                    'options' => [
                        'class' => 'c-bookingForm__select c-bookingForm__select--date',
                        'id' => 'guideDatepicker',
                    ],
                    'pluginOptions' => [
                        'format' => 'd/m/yyyy',
                        'beforeShowDay' => new JsExpression("
                        function(date) {
                            if ($.inArray(date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear(), guideDates) !== -1) {
                                return;
                            } else {
                                return false;
                            }
                        }")
                    ],
                ])->label(false) ?>
            </div>
            <div class="c-bookingForm__tool cf">
                <div class="c-bookingForm__tool--wrapperBlue cf">
                    <div class="c-bookingForm__tool--leftPart">
                        <div class="c-bookingForm__head--blue">
                            Required Booking Deposit
                        </div>
                        <span class="c-bookingForm__tooltip">
                            ?
                            <div class="c-bookingForm__tooltipText">
                                <div class="c-bookingForm__tool--leftPart">
                                    <div class="c-bookingForm__head">
                                        Remaining Balance
                                    </div>
                                    <div class="c-bookingForm__head--small">
                                        is that what you pay on the day of the Activity
                                    </div>
                                </div>
                                <div class="c-bookingForm__tool--rightPart">
                                    <div class="c-bookingForm__number--right">
                                        <?= $tour->priceAdult - $tour->deposit ?>$
                                    </div>
                                </div>
                            </div>
                        </span>
                        <div class="c-bookingForm__head--smallBlue">
                            is that what you pay now
                        </div>
                    </div>
                    <div class="c-bookingForm__tool--rightPart">
                        <div class="c-bookingForm__number--rightBlue">
                            <?= $tour->deposit ?>$
                        </div>
                    </div>
                </div>
            </div>
            <div class="c-bookingForm__tool cf">
                <div class="c-bookingForm__tool--leftPart">
                    <div class="c-bookingForm__head">
                        TOTAL per 1 traveller
                    </div>
                </div>
                <div class="c-bookingForm__tool--rightPart">
                    <div class="c-bookingForm__number--right">
                        <?= $tour->priceAdult ?>$
                    </div>
                </div>
            </div>
            <div class="c-bookingForm__buttonWrap">
                <?= Html::submitButton('BOOK NOW', ['class' => 'c-button']) ?>
            </div>
        </div>
    </div>

<?php ActiveForm::end() ?>