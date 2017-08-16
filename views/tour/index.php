<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use kartik\slider\Slider;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TourSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tours';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('/css/allTours.css');
?>
<div class="l-action l-action--empty">
    <div class="l-mainContent">
        <div class="l-action__content--destination">
            <div class="l-action__formWrap">
                <?php $form = ActiveForm::begin([
                    'action' => '/search',
                    'method' => 'get',
                    'class' => 'c-searchForm'
                ]) ?>
                <div class="l-action__formItem item">
                    <div class="c-searchForm__inputBlock">
                        <?= $form->field($tourSearch, 'name')->textInput(['class' => 'c-searchForm__input', 'placeholder' => 'Where are you going?'])->label(false) ?>
                        <div class="c-searchForm__img">
                            <svg class="c-searchForm__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 430.114 430.114">
                                <path d="M356.208 107.051c-1.531-5.738-4.64-11.852-6.94-17.205C321.746 23.704 261.611 0 213.055 0 148.054 0 76.463 43.586 66.905 133.427v18.355c0 .766.264 7.647.639 11.089 5.358 42.816 39.143 88.32 64.375 131.136 27.146 45.873 55.314 90.999 83.221 136.106 17.208-29.436 34.354-59.259 51.17-87.933 4.583-8.415 9.903-16.825 14.491-24.857 3.058-5.348 8.9-10.696 11.569-15.672 27.145-49.699 70.838-99.782 70.838-149.104v-20.262c.001-5.347-6.627-24.081-7-25.234zm-141.963 92.142c-19.107 0-40.021-9.554-50.344-35.939-1.538-4.2-1.414-12.617-1.414-13.388v-11.852c0-33.636 28.56-48.932 53.406-48.932 30.588 0 54.245 24.472 54.245 55.06 0 30.587-25.305 55.051-55.893 55.051z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="l-action__formItem l-action__formItem--button item">
                    <?= Html::submitButton('Search', ['class' => 'c-button']) ?>
                </div>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>
<div class="l-tools">
    <div class="l-tools__content l-mainContent cf">
<!--        <div class="l-tools__leftPart">
            <div class="c-breadCrumbs">
                <a class="c-breadCrumbs__link" href="#">
                    Europe
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
                    Europe
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
                    Europe
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
                    Europe
                </a>
                <div class="c-breadCrumbs__arrow">
                    <svg class="c-breadCrumbs__icon" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 46.02 46.02">
                        <path d="M14.757 46.02c-1.412 0-2.825-.521-3.929-1.569-2.282-2.17-2.373-5.78-.204-8.063L23.382 22.97 10.637 9.645C8.46 7.37 8.54 3.76 10.816 1.582c2.277-2.178 5.886-2.097 8.063.179l16.505 17.253c2.104 2.2 2.108 5.665.013 7.872L18.893 44.247c-1.123 1.177-2.626 1.773-4.136 1.773z"/>
                    </svg>
                </div>
            </div>
        </div>-->
        <div class="l-tools__rightPart">
            <div class="c-sort">
                <div class="c-sort__head">Sort by:</div>
                <div class="c-sort__list">
                    <div class="c-sort__item is-active">
                        <div class="c-sort__link">
                            <div class="c-sort__text">Rating</div>
                            <div class="c-sort__img">
                                <svg xmlns="http://www.w3.org/2000/svg" class="c-sort__icon"
                                     viewBox="0 0 113.5 186">
                                    <path class="c-sort__up"
                                          d="M54.7 9.7L14.2 68.3c-.5.5-.5 1.5-.3 2 .3.8 1 1 1.8 1h80.9c.8 0 1.5-.5 1.8-1 .3-.3.3-.5.3-1s0-.8-.3-1.3L58 9.4c-.3-.3-1-.5-1.5-.5-.8 0-1.3.3-1.8.8z"/>
                                    <path d="M58.8 168.2l40.4-58.6c.5-.5.5-1.5.3-2-.3-.8-1-1-1.8-1H16.8c-.8 0-1.5.5-1.8 1-.3.3-.3.5-.3 1s0 .8.3 1.3l40.4 58.6c.3.3 1 .5 1.5.5.9 0 1.4-.3 1.9-.8z"
                                          class="c-sort__down is-active"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="c-sort__item">
                        <div class="c-sort__link">
                            <div class="c-sort__text">Price</div>
                            <div class="c-sort__img">
                                <svg xmlns="http://www.w3.org/2000/svg" class="c-sort__icon"
                                     viewBox="0 0 113.5 186">
                                    <path class="c-sort__up"
                                          d="M54.7 9.7L14.2 68.3c-.5.5-.5 1.5-.3 2 .3.8 1 1 1.8 1h80.9c.8 0 1.5-.5 1.8-1 .3-.3.3-.5.3-1s0-.8-.3-1.3L58 9.4c-.3-.3-1-.5-1.5-.5-.8 0-1.3.3-1.8.8z"/>
                                    <path d="M58.8 168.2l40.4-58.6c.5-.5.5-1.5.3-2-.3-.8-1-1-1.8-1H16.8c-.8 0-1.5.5-1.8 1-.3.3-.3.5-.3 1s0 .8.3 1.3l40.4 58.6c.3.3 1 .5 1.5.5.9 0 1.4-.3 1.9-.8z"
                                          class="c-sort__down"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="c-sort__item">
                        <div class="c-sort__link">
                            <div class="c-sort__text">Name</div>
                            <div class="c-sort__img">
                                <svg xmlns="http://www.w3.org/2000/svg" class="c-sort__icon"
                                     viewBox="0 0 113.5 186">
                                    <path class="c-sort__up"
                                          d="M54.7 9.7L14.2 68.3c-.5.5-.5 1.5-.3 2 .3.8 1 1 1.8 1h80.9c.8 0 1.5-.5 1.8-1 .3-.3.3-.5.3-1s0-.8-.3-1.3L58 9.4c-.3-.3-1-.5-1.5-.5-.8 0-1.3.3-1.8.8z"/>
                                    <path d="M58.8 168.2l40.4-58.6c.5-.5.5-1.5.3-2-.3-.8-1-1-1.8-1H16.8c-.8 0-1.5.5-1.8 1-.3.3-.3.5-.3 1s0 .8.3 1.3l40.4 58.6c.3.3 1 .5 1.5.5.9 0 1.4-.3 1.9-.8z"
                                          class="c-sort__down"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="c-sort__item">
                        <div class="c-sort__link">
                            <div class="c-sort__text">Required bookeng deposit</div>
                            <div class="c-sort__img">
                                <svg xmlns="http://www.w3.org/2000/svg" class="c-sort__icon"
                                     viewBox="0 0 113.5 186">
                                    <path class="c-sort__up"
                                          d="M54.7 9.7L14.2 68.3c-.5.5-.5 1.5-.3 2 .3.8 1 1 1.8 1h80.9c.8 0 1.5-.5 1.8-1 .3-.3.3-.5.3-1s0-.8-.3-1.3L58 9.4c-.3-.3-1-.5-1.5-.5-.8 0-1.3.3-1.8.8z"/>
                                    <path d="M58.8 168.2l40.4-58.6c.5-.5.5-1.5.3-2-.3-.8-1-1-1.8-1H16.8c-.8 0-1.5.5-1.8 1-.3.3-.3.5-.3 1s0 .8.3 1.3l40.4 58.6c.3.3 1 .5 1.5.5.9 0 1.4-.3 1.9-.8z"
                                          class="c-sort__down"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="l-destinations">
    <div class="l-destinations__content l-mainContent cf">
        <div class="l-destinations__leftPart">
<!--            <div class="l-destinations__filter">
                <div class="c-selectedItems">
                    <div class="c-selectedItems__head">Selected Items</div>
                    <div class="c-selectedItems__content">
                        <div class="c-selectedItems__list">
                            <div class="c-selectedItems__item c-selectedItems__item--first">
                                <div class="c-selectedItems__img">
                                    <svg class="c-selectedItems__icon" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 47.971 47.971">
                                        <path d="M28.228 23.986L47.092 5.122c1.172-1.171 1.172-3.071 0-4.242-1.172-1.172-3.07-1.172-4.242 0L23.986 19.744 5.121.88C3.949-.292 2.051-.292.879.88c-1.172 1.171-1.172 3.071 0 4.242l18.865 18.864L.879 42.85c-1.172 1.171-1.172 3.071 0 4.242.586.585 1.354.878 2.121.878s1.535-.293 2.121-.879l18.865-18.864L42.85 47.091c.586.586 1.354.879 2.121.879s1.535-.293 2.121-.879c1.172-1.171 1.172-3.071 0-4.242L28.228 23.986z"/>
                                    </svg>
                                </div>
                                <div class="c-selectedItems__text">Bus SightseeIng Tours</div>
                            </div>
                            <div class="c-selectedItems__item">
                                <div class="c-selectedItems__img">
                                    <svg class="c-selectedItems__icon" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 47.971 47.971">
                                        <path d="M28.228 23.986L47.092 5.122c1.172-1.171 1.172-3.071 0-4.242-1.172-1.172-3.07-1.172-4.242 0L23.986 19.744 5.121.88C3.949-.292 2.051-.292.879.88c-1.172 1.171-1.172 3.071 0 4.242l18.865 18.864L.879 42.85c-1.172 1.171-1.172 3.071 0 4.242.586.585 1.354.878 2.121.878s1.535-.293 2.121-.879l18.865-18.864L42.85 47.091c.586.586 1.354.879 2.121.879s1.535-.293 2.121-.879c1.172-1.171 1.172-3.071 0-4.242L28.228 23.986z"/>
                                    </svg>
                                </div>
                                <div class="c-selectedItems__text">Bus SightseeIng Tours</div>
                            </div>
                            <div class="c-selectedItems__item">
                                <div class="c-selectedItems__img">
                                    <svg class="c-selectedItems__icon" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 47.971 47.971">
                                        <path d="M28.228 23.986L47.092 5.122c1.172-1.171 1.172-3.071 0-4.242-1.172-1.172-3.07-1.172-4.242 0L23.986 19.744 5.121.88C3.949-.292 2.051-.292.879.88c-1.172 1.171-1.172 3.071 0 4.242l18.865 18.864L.879 42.85c-1.172 1.171-1.172 3.071 0 4.242.586.585 1.354.878 2.121.878s1.535-.293 2.121-.879l18.865-18.864L42.85 47.091c.586.586 1.354.879 2.121.879s1.535-.293 2.121-.879c1.172-1.171 1.172-3.071 0-4.242L28.228 23.986z"/>
                                    </svg>
                                </div>
                                <div class="c-selectedItems__text">Bus SightseeIng Tours</div>
                            </div>
                        </div>
                        <div class="c-selectedItems__buttonWrap">
                            <div class="c-button c-button--selectedItems">Clear all</div>
                        </div>
                    </div>
                </div>
            </div>-->
            <?php $form = ActiveForm::begin([
                'method' => 'get',
            ]) ?>
            <div class="l-destinations__instruments">
                <div class="l-destinations__instrument l-destinations__instrument--first">
                    <div class="c-selectPlace">
                        <div class="c-selectPlace__header">Destinations</div>
                        <div class="c-selectPlace__body">
                            <div class="c-selectPlace__list">
                                <?= $form->field($tourSearch, 'continent')->widget(Select2::classname(), [
                                    'data' => $continentsList,
                                    'options' => [
                                        'placeholder' => 'Choose Continent'
                                    ],
                                ])->label(false) ?>
                                <?= $form->field($tourSearch, 'country', ['options' => ['style' => 'display:none']])->widget(DepDrop::classname(), [
                                    'options' => [
                                        'placeholder' => 'Choose Country',
                                    ],
                                    'type' => DepDrop::TYPE_SELECT2,
                                    'pluginOptions' => [
                                        'depends' => ['toursearch-continent'],
                                        'url' => Url::to(['/tour/child-location']),
                                        'loadingText' => 'Loading countries...',
                                    ],
                                    'pluginEvents' => [
                                        'depdrop:change' => "function() { $('.field-toursearch-country').show(); }",
                                    ]
                                ])->label(false) ?>
                                <?= $form->field($tourSearch, 'city', ['options' => ['style' => 'display:none']])->widget(DepDrop::classname(), [
                                    'options' => [
                                        'placeholder' => 'Choose City'
                                    ],
                                    'type' => DepDrop::TYPE_SELECT2,
                                    'pluginOptions' => [
                                        'depends' => ['toursearch-country'],
                                        'url' => Url::to(['/tour/child-location']),
                                        'loadingText' => 'Loading cities...',
                                    ],
                                    'pluginEvents' => [
                                        'depdrop:change' => "function(event) { (event.target.length != 1) ? $('.field-toursearch-city').show() : false; }",
                                    ]
                                ])->label(false) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="l-destinations__instrument">
                    <div class="c-selectCategory">
                        <div class="c-selectCategory__header">Categories</div>
                        <?= $form->field($tourSearch, 'typeId')->widget(Select2::classname(), [
                            'data' => $typesList,
                            'options' => [
                                'multiple' => true,
                                'placeholder' => 'Tour Types'
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])->label(false) ?>
                    </div>
                </div>
                <div class="l-destinations__instrument l-destinations__instrument--last">
                    <div class="c-selectRating">
                        <div class="c-selectRating__header">Rating</div>
                        <div class="c-selectRating__body">
                            <div class="c-selectRating__toddler">
                            <?= $form->field($tourSearch, 'ratings')->widget(Slider::classname(), [
                                'pluginConflict' => true,
                                'sliderColor' => '#00bcd4',
                                'handleColor' => '#d4f4f9',
                                'pluginOptions' => [
                                    'min' => 1,
                                    'max' => 5,
                                    'step' => 1,
                                    'range' => true,
                                ],
                                'pluginEvents' => [
                                    // change text in the bottom infoblocks (rating values) when the dragging stops
                                    'slideStop' => "function(event) { 
                                        $('#leftInfo').text(event.value[0] + ' star(s)');
                                        $('#rightInfo').text(event.value[1] + ' star(s)');
                                     }",
                                ],
                            ])->label(false) ?>
                                <div id="leftInfo" class="c-selectRating__leftInfo">1 star(s)</div>
                                <div id="rightInfo" class="c-selectRating__rightInfo">5 star(s)</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="l-destinations__instrument">
                    <div class="l-destinations__buttonWrap">
                        <?= Html::a('Reset', ['index'], ['class' => 'c-button c-button--reset']) ?>
                        <?= Html::submitButton('Search', ['class' => 'c-button']) ?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end() ?>
        </div>
        <div class="l-destinations__rightPart">
            <?= ListView::widget([
                'layout' => "{sorter}\n{items}\n{pager}",
                'dataProvider' => $dataProvider,
                'options' => [
                    'class' => 'l-destinations__list',
                ],
                'itemOptions' => [
                    'tag' => false,
                ],
                'itemView' => function ($model, $key, $index, $widget) {
                    return $this->render('_listTour',['tour' => $model]);
                },
                'emptyText' => 'There is no available tours',
            ]) ?>
            <!--<div class="l-destinations__dotsWrap">
                <div class="l-destinations__dots">
                    <div class="c-numberDots">
                        <div class="c-numberDots__body cf">
                            <div class="c-numberDots__left">
                                <svg class="c-numberDots__icon" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 477.175 477.175">
                                    <path d="M145.188 238.575l215.5-215.5c5.3-5.3 5.3-13.8 0-19.1s-13.8-5.3-19.1 0l-225.1 225.1c-5.3 5.3-5.3 13.8 0 19.1l225.1 225c2.6 2.6 6.1 4 9.5 4s6.9-1.3 9.5-4c5.3-5.3 5.3-13.8 0-19.1l-215.4-215.5z"/>
                                </svg>
                            </div>
                            <div class="c-numberDots__content">
                                <div class="c-numberDots__item is-active">
                                    <div class="c-numberDots__text">1</div>
                                </div>
                                <div class="c-numberDots__item">
                                    <div class="c-numberDots__text">2</div>
                                </div>
                                <div class="c-numberDots__item">
                                    <div class="c-numberDots__text">3</div>
                                </div>
                                <div class="c-numberDots__item">
                                    <div class="c-numberDots__text">4</div>
                                </div>
                                <div class="c-numberDots__item">
                                    <div class="c-numberDots__text">5</div>
                                </div>
                                <div class="c-numberDots__item">
                                    <div class="c-numberDots__text">...</div>
                                </div>
                                <div class="c-numberDots__item">
                                    <div class="c-numberDots__text">47</div>
                                </div>
                            </div>
                            <div class="c-numberDots__right">
                                <svg class="c-numberDots__icon" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 477.175 477.175">
                                    <path d="M360.731 229.075l-225.1-225.1c-5.3-5.3-13.8-5.3-19.1 0s-5.3 13.8 0 19.1l215.5 215.5-215.5 215.5c-5.3 5.3-5.3 13.8 0 19.1 2.6 2.6 6.1 4 9.5 4 3.4 0 6.9-1.3 9.5-4l225.1-225.1c5.3-5.2 5.3-13.8.1-19z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
        </div>
    </div>
</div>
