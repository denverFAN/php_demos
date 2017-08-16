<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\date\DatePicker;
use unclead\multipleinput\MultipleInput;
use kartik\select2\Select2;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\Tour */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
    'options' => ['class' => 'l-addTour'],
]) ?>
    <h3 class="l-addTour__stepsTitle">
        Step 1
    </h3>
    <div class="l-addTour__helpText">
        All fields are required unless marked optional.
    </div>
    <section class="l-addTour__step">
        <div class="c-tourForm">
            <div class="c-tourForm__block">
                <div class="c-tourForm__title">
                    1. Tour type.
                </div>
                <div class="c-tourForm__content">
                    <div class="c-tourForm__leftSide">
                        <div class="c-tourForm__text">
                            Vestibulum laoreet molestie nunc id dignissim. Phasellus lacinia dictum mi. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        </div>
                    </div>
                    <div class="c-tourForm__rightSide">
                        <div class="c-tourForm__label">
                            Tour type
                        </div>
                        <div class="c-tourForm__selectWrapper">
                            <?= $form->field($tour, 'typeId')->widget(Select2::classname(), [
                                'data' => $typesList,
                                'options' => [
                                    'class' => 'c-tourForm__selectCustom',
                                    'placeholder' => '- Tour type -',
                                ],
                            ])->label(false) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="c-tourForm">
            <div class="c-tourForm__block">
                <div class="c-tourForm__title">
                    2. Tour name.
                </div>
                <div class="c-tourForm__content">
                    <div class="c-tourForm__leftSide">
                        <div class="c-tourForm__text">
                            Vestibulum laoreet molestie nunc id dignissim. Phasellus lacinia dictum mi. Lorem ipsum dolor sit amet.
                        </div>
                    </div>
                    <div class="c-tourForm__rightSide">
                        <div class="c-tourForm__label">
                            Tour name (max 70 characters)
                        </div>
                        <?= $form->field($tour, 'name')->textInput(['class' => 'c-tourForm__input', 'maxlength' => true, 'placeholder' => '- Tour name -'])->label(false) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="c-tourForm">
            <div class="c-tourForm__block">
                <div class="c-tourForm__title">
                    3. Country and city.
                </div>
                <div class="c-tourForm__content">
                    <div class="c-tourForm__leftSide">
                        <div class="c-tourForm__text">
                            Vestibulum laoreet molestie nunc id dignissim. Phasellus lacinia dictum mi. Lorem ipsum dolor sit amet.
                        </div>
                    </div>
                    <div class="c-tourForm__rightSide">
                        <div class="c-tourForm__label">
                            Tour's location
                        </div>
                        <input type="text" id="locationAutocomplete" class="c-tourForm__input" placeholder="- Location -">
                        <?= $form->field($country, 'id')->hiddenInput()->label(false) ?>
                        <?= $form->field($country, 'name')->hiddenInput()->label(false) ?>
                        <?= $form->field($city, 'name')->hiddenInput()->label(false) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="c-tourForm">
            <div class="c-tourForm__block">
                <div class="c-tourForm__title">
                    4. Tour photo cover.
                </div>
                <div class="c-tourForm__content">
                    <div class="c-tourForm__leftSide">
                        <div class="c-tourForm__text">
                            Vestibulum laoreet molestie nunc id dignissim. Phasellus lacinia dictum mi. Lorem ipsum dolor sit amet.
                        </div>
                    </div>
                    <div class="c-tourForm__rightSide">
                        <div class="c-tourForm__label">
                            Upload photo cover
                        </div>
                        <div class="c-tourForm__uploadWrapper">
                            <?= $form->field($tourPhotos, 'promoImage')->hiddenInput()->label(false) ?>
                            <input type="file" id="fileInput" class="c-tourForm__link" >
                            <label class="c-tourForm__linkLabel" for="fileInput">
                                <svg class="c-tourForm__iconUpload" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 491.95 491.95">
                                    <path d="M365.675,112.25l-107-107c-7-7-18.4-7-25.5,0l-107,107c-7,7-7,18.4,0,25.5c7.1,7,18.5,7,25.5-0.1l76.3-76.2v310.6
			c0,9.9,8.1,18,18,18c9.9,0,18-8.1,18-18V61.45l76.3,76.3c3.5,3.5,8.1,5.3,12.7,5.3c4.6,0,9.2-1.8,12.7-5.3
			C372.675,130.75,372.675,119.35,365.675,112.25z"/>
                                    <path d="M439.975,336.35c-9.9,0-18,8.1-18,18v101.6h-352v-101.6c0-9.9-8.1-18-18-18s-18,8.1-18,18v119.6c0,9.9,8,18,18,18h388
			c9.9,0,18-8.1,18-18v-119.6C457.975,344.45,449.875,336.35,439.975,336.35z"/>
                                </svg>
                                Upload
                            </label>
                            <div class="c-tourForm__linkTitle" id="deleteImage">
                                <svg class="c-tourForm__linkCancel" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
                                    <path d="M28.941,31.786L0.613,60.114c-0.787,0.787-0.787,2.062,0,2.849c0.393,0.394,0.909,0.59,1.424,0.59   c0.516,0,1.031-0.196,1.424-0.59l28.541-28.541l28.541,28.541c0.394,0.394,0.909,0.59,1.424,0.59c0.515,0,1.031-0.196,1.424-0.59   c0.787-0.787,0.787-2.062,0-2.849L35.064,31.786L63.41,3.438c0.787-0.787,0.787-2.062,0-2.849c-0.787-0.786-2.062-0.786-2.848,0   L32.003,29.15L3.441,0.59c-0.787-0.786-2.061-0.786-2.848,0c-0.787,0.787-0.787,2.062,0,2.849L28.941,31.786z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="c-tourForm__imgWrapper" id="cropPreview"></div>
                <div class="c-tourForm__imgWrapper" id="cropResult"></div>
                <div class="c-tourForm__imgButtonWrapper">
                    <button type="button" id="cropButton" class="c-button c-tourForm__imgButton" style="display:none">Crop</button>
                </div>
            </div>
        </div>
        <div class="c-tourForm">
            <div class="c-tourForm__block">
                <div class="c-tourForm__title">
                    5. Tour's pictures.
                </div>
                <div class="c-tourForm__content">
                    <div class="c-tourForm__leftSide">
                        <div class="c-tourForm__text">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </div>
                    </div>
                    <div class="c-tourForm__rightSide">
                        <div class="c-tourForm__label">
                            The maximum size of a single file is 3 MB.Supported file formats: JPG, PNG, GIF, BMP.
                        </div>
                        <?= $form->field($tourPhotos, 'images[]')->widget(FileInput::classname(), [
                            'options' => ['accept'=>'image/*', 'multiple' => true, 'id' => 'tourPhotos'],
                            'pluginOptions' => [
                                'allowedFileExtensions' => ['jpg','gif','png'],
                                'showCaption' => false,
                                'showUpload' => false,
                                'showCancel' => false,
                                'fileActionSettings' => [
                                    'showZoom' => false,
                                    'indicatorNew' => '',
                                ],
                                'layoutTemplates' => [
                                    // hide modal window (for file content preview zooming)
                                    'modalMain' => '',
                                    // custom template for the "browse" button
                                    'btnBrowse' => '
                                        <button class="c-tourForm__photoBrowse btn-file">
                                            <svg class="c-tourForm__photoBrowseImg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 415.979 415.978">
                                                <path d="M412.762,119.011c-2.369-2.629-5.744-4.13-9.283-4.13h-2.346c-2.904-26.221-25.189-46.685-52.172-46.685H210.488V55.898
                                                c0-6.903-5.597-12.5-12.5-12.5H52.5C23.552,43.398,0,66.95,0,95.898c0,0.371,0.017,0.741,0.05,1.11l20,224.184
                                                c0.005,0.063,0.012,0.126,0.018,0.188c3.199,30.624,24.27,51.2,52.433,51.2H343.48c27.082,0,47.633-19.862,52.354-50.603
                                                c0.031-0.201,0.059-0.404,0.078-0.607l20-192.701C416.277,125.15,415.133,121.639,412.762,119.011z M375.838,114.881h-137.85
                                                c-13.168,0-24.199-9.306-26.875-21.685h137.85C362.131,93.196,373.16,102.501,375.838,114.881z M371.078,318.468
                                                c-1.154,7.209-6.426,29.112-27.6,29.112H72.5c-18.068,0-26.078-14.812-27.558-28.706L25.005,95.392
                                                c-1.138-14.935,12.5-26.994,27.495-26.994h132.989V87.38c0,28.948,23.552,52.5,52.5,52.5h151.625L371.078,318.468z"/>
                                            </svg>
                                            Browse
                                        </button>',
                                    // custom template for the "remove" button
                                    'btnDefault' => '
                                        <button class="c-tourForm__photoRemove fileinput-remove fileinput-remove-button">
                                            <svg class="c-tourForm__photoRemoveImg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
                                                <path d="M25.834,10.825H6.165c-2.133,0-3.868-1.736-3.868-3.869s1.735-3.869,3.868-3.869h19.669c2.134,0,3.869,1.736,3.869,3.869
                                                S27.968,10.825,25.834,10.825z M6.165,5.087c-1.03,0-1.868,0.838-1.868,1.869s0.838,1.869,1.868,1.869h19.669
                                                c1.03,0,1.869-0.838,1.869-1.869s-0.839-1.869-1.869-1.869H6.165z"/>
                                                <path d="M22.867,32H9.132c-1.431,0-2.615-1.073-2.757-2.496L4.417,9.925l1.99-0.199l1.958,19.58C8.404,29.702,8.734,30,9.132,30
                                                h13.735c0.397,0,0.728-0.299,0.768-0.694l1.957-19.58l1.99,0.199l-1.957,19.58C25.482,30.927,24.297,32,22.867,32z"/>
                                                <path d="M20.235,4.027c-0.553,0-1-0.448-1-1C19.235,2.461,18.774,2,18.208,2h-4.417c-0.566,0-1.027,0.461-1.027,1.027
                                                c0,0.552-0.447,1-1,1s-1-0.448-1-1C10.764,1.358,12.122,0,13.791,0h4.417c1.669,0,3.027,1.358,3.027,3.027
                                                C21.235,3.58,20.788,4.027,20.235,4.027z"/>
                                            </svg>
                                            Remove
                                        </button>',
                                ],
                            ],
                        ])->label(false) ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <h3 class="l-addTour__stepsTitle">
        Step 2
    </h3>
    <section class="l-addTour__step">
        <div class="c-tourForm">
            <div class="c-tourForm__block">
                <div class="c-tourForm__title">
                    Tour overview.
                </div>
                <div class="c-tourForm__content">
                    <div class="c-tourForm__leftSide">
                        <div class="c-tourForm__text">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </div>
                    </div>
                    <div class="c-tourForm__rightSide">
                        <div class="c-tourForm__label">
                            <svg class="c-tourForm__iconTime" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 472.617 472.617">
                                <path d="M453.652,157.878c-3.656-9.651-14.438-14.515-24.093-10.859c-9.648,3.647-14.511,14.436-10.857,24.088     c17.961,47.441,16.837,99.245-3.163,145.879c-20.531,47.865-58.47,84.874-106.837,104.206     c-48.364,19.33-101.361,18.674-149.227-1.854c-13.88-5.952-26.834-13.366-38.719-22.068     c-29.116-21.332-51.765-50.429-65.491-84.771c-19.333-48.363-18.679-101.358,1.85-149.231     c20.53-47.866,58.477-84.876,106.842-104.212c46.279-18.496,96.796-18.641,143.004-0.635l-13.242,22.365     c-3.638,6.144-0.842,10.244,6.202,9.104l62.911-10.156c7.048-1.139,10.868-7.582,8.474-14.307l-21.34-60.051     c-2.39-6.726-7.324-7.209-10.957-1.062l-12.77,21.561c-56.603-23.77-119.088-24.33-176.159-1.518     C92.45,47.396,47.238,91.495,22.769,148.538c-24.465,57.041-25.25,120.202-2.21,177.836     c16.361,40.929,43.344,75.597,78.048,101.015c14.158,10.371,29.605,19.205,46.137,26.292     c57.044,24.461,120.195,25.25,177.827,2.218c57.64-23.034,102.849-67.142,127.312-124.188     C473.716,276.148,475.055,214.406,453.652,157.878z"/>
                                <path d="M228.112,90.917c-8.352,0-15.128,6.771-15.128,15.13v150.745l137.872,71.272c2.219,1.148,4.593,1.693,6.931,1.688     c5.478,0,10.765-2.979,13.455-8.183c3.833-7.424,0.931-16.549-6.499-20.389l-121.496-62.81V106.047     C243.246,97.688,236.475,90.917,228.112,90.917z"/>
                            </svg>
                            Duration
                        </div>
                        <div class="c-tourForm__inputGroup">
                            <?= $form->field($tour, 'duration[]')->textInput(['class' => 'c-tourForm__input', 'placeholder' => 'Days'])->label(false) ?>
                            <?= $form->field($tour, 'duration[]')->textInput(['class' => 'c-tourForm__input', 'placeholder' => 'Hours'])->label(false) ?>
                            <?= $form->field($tour, 'duration[]')->textInput(['class' => 'c-tourForm__input', 'placeholder' => 'Minutes'])->label(false) ?>
                        </div>
                        <div class="c-tourForm__label">
                            Short description (max 220 characters)
                        </div>
                        <?= $form->field($tour, 'descShort')->textarea(['class' => 'c-tourForm__input c-tourForm__textarea', 'maxlength' => true, 'placeholder' => 'Short description'])->label(false) ?>
                        <div class="c-tourForm__label">
                            Full description (max 450 characters)
                        </div>
                        <?= $form->field($tour, 'descLong')->textarea(['class' => 'c-tourForm__input c-tourForm__textarea', 'maxlength' => true, 'placeholder' => 'Full description'])->label(false) ?>
                        <div class="c-tourForm__label c-tourForm__label--full">
                            Add some short extra information to your description (max 6 items)
                        </div>
                        <?= $form->field($tour, 'descExtra')->widget(MultipleInput::className(), [
                            'max' => 5,
                            'min' => 2,
                            'addButtonPosition' => MultipleInput::POS_FOOTER,
                            'addButtonOptions' => [
                                'class' => 'c-tourForm__add'
                            ],
                            'removeButtonOptions' => [
                                'class' => 'c-tourForm__add'
                            ],
                            'columns' => [
                                [
                                    'name' => 'descExtra',
                                    'enableError' => true,
                                    'options' => [
                                        'class' => 'c-tourForm__input',
                                        'placeholder' => 'Extra information',
                                    ]
                                ]
                            ],
                        ])->label(false) ?>
<!--                        <ul class="c-tourForm__list">
                            <li class="c-tourForm__item">
                                <input type="text" class="c-tourForm__input" placeholder="Extra information">
                            </li>
                            <li class="c-tourForm__item js-tourForm__item">
                                <input type="text" class="c-tourForm__input" placeholder="Extra information">
                            </li>
                        </ul>
                        <a id="addItem" class="c-tourForm__add">+ add item</a>-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <h3 class="l-addTour__stepsTitle">
        Step 3
    </h3>
    <section class="l-addTour__step">
        <div class="c-tourForm">
            <div class="c-tourForm__block">
                <div class="c-tourForm__title">
                    1. Inclusions/Exclusions.
                </div>
                <div class="c-tourForm__content">
                    <div class="c-tourForm__leftSide">
                        <div class="c-tourForm__text">
                            Vestibulum laoreet molestie nunc id dignissim. Phasellus lacinia dictum mi. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Nulla vestibulum tortor eget consectetur efficitur. Praesent luctus condimentum nisl, pharetra varius orci sollicitudin in.
                        </div>
                    </div>
                    <div class="c-tourForm__rightSide">
                        <div class="c-tourForm__blockWrapper">
                            <div class="c-tourForm__label">
                                Inclusions
                            </div>
                            <?= $form->field($tour, 'inclusion')->widget(MultipleInput::className(), [
                                'max' => 5,
                                'min' => 2,
                                'addButtonPosition' => MultipleInput::POS_FOOTER,
                                'addButtonOptions' => [
                                    'class' => 'c-tourForm__add'
                                ],
                                'removeButtonOptions' => [
                                    'class' => 'c-tourForm__add'
                                ],
                                'columns' => [
                                    [
                                        'name' => 'inclusion',
                                        'enableError' => true,
                                        'options' => [
                                            'class' => 'c-tourForm__input',
                                            'placeholder' => 'Inclusions',
                                        ]
                                    ]
                                ],
                            ])->label(false) ?>
<!--                            <ul class="c-tourForm__list">
                                <li class="c-tourForm__item">
                                    <input type="text" class="c-tourForm__input" placeholder="Inclusions">
                                </li>
                                <li class="c-tourForm__item js-tourForm__Incl">
                                    <input type="text" class="c-tourForm__input" placeholder="Inclusions">
                                </li>
                            </ul>
                            <a id="addIncl" class="c-tourForm__add">+ add item</a>-->
                        </div>
                        <div class="c-tourForm__blockWrapper">
                            <div class="c-tourForm__label">
                                Exclusions
                            </div>
                            <?= $form->field($tour, 'exclusion')->widget(MultipleInput::className(), [
                                'max' => 5,
                                'min' => 2,
                                'addButtonPosition' => MultipleInput::POS_FOOTER,
                                'addButtonOptions' => [
                                    'class' => 'c-tourForm__add'
                                ],
                                'removeButtonOptions' => [
                                    'class' => 'c-tourForm__add'
                                ],
                                'columns' => [
                                    [
                                        'name' => 'exclusion',
                                        'enableError' => true,
                                        'options' => [
                                            'class' => 'c-tourForm__input',
                                            'placeholder' => 'Exclusions',
                                        ]
                                    ]
                                ],
                            ])->label(false) ?>
<!--                            <ul class="c-tourForm__list">
                                <li class="c-tourForm__item">
                                    <input type="text" class="c-tourForm__input" placeholder="Exclusions">
                                </li>
                                <li class="c-tourForm__item js-tourForm__Excl">
                                    <input type="text" class="c-tourForm__input" placeholder="Exclusions">
                                </li>
                            </ul>
                            <a id="addExcl" class="c-tourForm__add">+ add item</a>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="c-tourForm">
            <div class="c-tourForm__block">
                <div class="c-tourForm__title">
                    2. Itinerary.
                </div>
                <div class="c-tourForm__content">
                    <div class="c-tourForm__leftSide">
                        <div class="c-tourForm__text">
                            Vestibulum laoreet molestie nunc id dignissim. Phasellus lacinia dictum mi. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Nulla vestibulum tortor eget consectetur efficitur. Praesent luctus condimentum nisl, pharetra varius orci sollicitudin in. elit.Nulla vestibulum tortor eget consectetur efficitur. Praesent luctus condimentum nisl, pharetra varius orci sollicitudin in.elit.Nulla vestibulum tortor eget consectetur efficitur. Praesent luctus condimentum nisl, pharetra varius orci sollicitudin in.
                        </div>
                    </div>
                    <div class="c-tourForm__rightSide">
                        <div class="c-tourForm__blockWrapper">
                            <div class="c-tourForm__label">
                                Time period and description
                            </div>
                            <?= $form->field($tour, 'itinerary')->widget(MultipleInput::className(), [
                                'max' => 5,
                                'min' => 2,
                                'addButtonPosition' => MultipleInput::POS_FOOTER,
                                'addButtonOptions' => [
                                    'class' => 'c-tourForm__add'
                                ],
                                'removeButtonOptions' => [
                                    'class' => 'c-tourForm__add'
                                ],
                                'columns' => [
                                    [
                                        'name' => 'itineraryTime',
                                        'type' => MaskedInput::className(),
                                        'enableError' => true,
                                        'options' => [
                                            'type' => 'time',
                                            'mask' => '99:99',
                                            'options' => [
                                                'class' => 'c-tourForm__input',
                                                'placeholder' => 'Time, e.g. 21:00',
                                            ],
                                        ]
                                    ],
                                    [
                                        'name' => 'itineraryDesc',
                                        'type' => 'textInput',
                                        'enableError' => true,
                                        'options' => [
                                            'class' => 'c-tourForm__input',
                                            'placeholder' => 'Description',
                                        ]
                                    ]
                                ],
                            ])->label(false) ?>
<!--                            <div class="c-tourForm__list c-tourForm__list--noList">
                                <div class="c-tourForm__doubleInputs">
                                    <div class="c-tourForm__item c-tourForm__item--noList">
                                        <input type="time" class="c-tourForm__input" placeholder="Time, e.g. 21:00">
                                    </div>
                                    <div class="c-tourForm__item c-tourForm__item--noList">
                                        <input type="text" class="c-tourForm__input" placeholder="Description">
                                    </div>
                                </div>
                                <div class="c-tourForm__doubleInputs js-tourForm__Time">
                                    <div class="c-tourForm__item c-tourForm__item--noList">
                                        <input type="time" class="c-tourForm__input" placeholder="Time, e.g. 21:00">
                                    </div>
                                    <div class="c-tourForm__item c-tourForm__item--noList ">
                                        <input type="text" class="c-tourForm__input" placeholder="Description">
                                    </div>
                                </div>
                            </div>
                            <a id="addTime" class="c-tourForm__add c-tourForm__add--noList">+ add item</a>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="c-tourForm">
            <div class="c-tourForm__block">
                <div class="c-tourForm__title">
                    3. Payment method.
                </div>
                <div class="c-tourForm__content">
                    <div class="c-tourForm__leftSide">
                        <div class="c-tourForm__text">
                            Vestibulum laoreet molestie nunc id dignissim. Phasellus lacinia dictum mi. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Nulla vestibulum tortor eget consectetur efficitur. Praesent luctus condimentum nisl, pharetra varius orci sollicitudin in. elit.Nulla vestibulum tortor eget consectetur efficitur. Praesent luctus condimentum nisl, pharetra varius orci sollicitudin in.elit.Nulla vestibulum tortor eget consectetur efficitur. Praesent luctus condimentum nisl, pharetra varius orci sollicitudin in.
                        </div>
                    </div>
                    <div class="c-tourForm__rightSide">
                        <div class="c-tourForm__blockWrapper">
                            <div class="c-tourForm__label">
                                Choose your payment methods
                            </div>
                            <div class="c-tourForm__list c-tourForm__list--noList">
                                <div class="c-tourForm__checkbox">
                                    <?= $form->field($tour, 'payMethod')->checkboxList(['1'=>'Credit or debit card', '2'=>'Cash in USD', '3'=>'Cash in local currency'])->label(false) ?>
<!--                                    --><?/*= $form->field($tour, 'payMethod')->checkboxList(['1'=>'Credit or debit card', '2'=>'Cash in USD', '3'=>'Cash in local currency'], [
                                        'item' => function($index, $label, $name, $checked, $value) {
                                            return $template = '
                                                <div class="c-tourForm__checkboxWrapper">
                                                    <label class="c-tourForm__checkboxLabel">'.$label.'
                                                    <input class="c-tourForm__checkboxInput" type="checkbox" name="'.$name.'" value="'.$value.'">
                                                    </label>
                                                </div>
                                            ';
                                        }
                                    ])->label(false) */?>
<!--                                    <div class="c-tourForm__checkboxWrapper">
                                        <input class="c-tourForm__checkboxInput" id="checkPay1" type="checkbox" value="Credit or debit card">
                                        <label class="c-tourForm__checkboxLabel" for="checkPay1">Credit or debit card</label>
                                    </div>
                                    <div class="c-tourForm__checkboxWrapper">
                                        <input class="c-tourForm__checkboxInput" id="checkPay2" type="checkbox" value="Cash in USD">
                                        <label class="c-tourForm__checkboxLabel" for="checkPay2">Cash in USD</label>
                                    </div>
                                    <div class="c-tourForm__checkboxWrapper">
                                        <input class="c-tourForm__checkboxInput" id="checkPay3" type="checkbox" value="Cash in local currency">
                                        <label class="c-tourForm__checkboxLabel" for="checkPay3">Cash in local currency</label>
                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <h3 class="l-addTour__stepsTitle">
        Step 4
    </h3>
    <section class="l-addTour__step">
        <div class="c-tourForm">
            <div class="c-tourForm__block">
                <div class="c-tourForm__title">
                    1. Guides and dates.
                </div>
                <div class="c-tourForm__text">
                    Vestibulum laoreet molestie nunc id dignissim. Phasellus lacinia dictum mi. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Nulla vestibulum tortor eget consectetur efficitur. Praesent luctus condimentum nisl, pharetra varius orci sollicitudin in. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </div>
                <div class="c-tourForm__Guide">
                    <?= $form->field($tourDates, 'allDates')->widget(MultipleInput::className(), [
                        'rendererClass' => \unclead\multipleinput\renderers\ListRenderer::className(),
                        'max' => 3,
                        'min' => 1,
                        'addButtonPosition' => MultipleInput::POS_FOOTER,
                        'addButtonOptions' => [
                            'class' => 'c-tourForm__add'
                        ],
                        'removeButtonOptions' => [
                            'class' => 'c-tourForm__add'
                        ],
                        'columns' => [
                            [
                                'name' => 'languageId',
                                'title' => 'Choose guide',
                                'type' => Select2::classname(),
                                'options' => [
                                    'data' => $languagesList,
                                    'options' => [
                                        'class' => 'c-tourForm__selectCustom',
                                        'placeholder' => '- Guide -',
                                    ],
                                ]
                            ],
                            [
                                'name' => 'dates',
                                'title' => 'Pick available dates for this guide:',
                                'type' => DatePicker::classname(),
                                'options' => [
                                    'type' => DatePicker::TYPE_INPUT,
                                    'options' => [
                                        'class' => 'c-tourForm__input c-tourForm__input--calendar',
                                        'placeholder' => '- Available dates -',
                                    ],
                                    'pluginOptions' => [
                                        'format' => 'd/m/yyyy',
                                        'multidate' => true,
                                        'multidateSeparator' => '; ',
                                    ],
                                ]
                            ]
                        ],
                    ])->label(false) ?>
<!--                    <div class="c-tourForm__GuideBlock js-tourForm__Block">
                        <div class="c-tourForm__GuideContent">
                            <div class="c-tourForm__content">
                                <div class="c-tourForm__leftSide">
                                    <div class="c-tourForm__label c-tourForm__label--guide">
                                        Choose guide
                                    </div>
                                    <div class="c-tourForm__selectWrapper c-tourForm__selectWrapper--guide">
                                        <select class="c-tourForm__selectCustom js-tourForm__selectGuide">
                                            <option class="c-tourForm__option"></option>
                                            <option class="c-tourForm__option">Russian</option>
                                            <option class="c-tourForm__option">English</option>
                                        </select>
                                    </div>
                                    <div class="c-tourForm__label c-tourForm__label--guide">
                                        Pick available dates for this guide:
                                    </div>
                                    <input type="text" class="c-tourForm__input c-tourForm__input--calendar js-tourForm__Clear" placeholder="- Available dates -">
                                </div>
                                <div class="c-tourForm__rightSide">
                                    <div class="c-tourForm__text c-tourForm__text--guide">
                                        Vestibulum laoreet molestie nunc id dignissim. Phasellus lacinia dictum mi. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a id="addGuide" class="c-tourForm__add c-tourForm__add--guide">+ add one more guide</a>-->
                </div>
            </div>
        </div>
        <div class="c-tourForm">
            <div class="c-tourForm__block">
                <div class="c-tourForm__title">
                    2. Price.
                </div>
                <div class="c-tourForm__content">
                    <div class="c-tourForm__leftSide">
                        <div class="c-tourForm__text">
                            Vestibulum laoreet molestie nunc id dignissim. Phasellus lacinia dictum mi. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Nulla vestibulum tortor eget consectetur efficitur. Praesent luctus condimentum nisl, pharetra varius orci sollicitudin in.
                        </div>
                    </div>
                    <div class="c-tourForm__rightSide">
                        <div class="c-tourForm__label--black">
                            1. Person
                        </div>
                        <div class="c-tourForm__checkboxBlock">
                            <div class="c-tourForm__checkboxItem">
                                <div class="c-tourForm__checkboxGroup">
                                    <input class="c-tourForm__checkboxInput" id="checkAdult" type="checkbox" value="Adult">
                                    <label class="c-tourForm__checkboxLabel" for="checkAdult">Adult</label>
                                </div>
                                <div class="c-tourForm__checkboxEl">
                                    <span class="c-tourForm__currency">$</span>
                                    <?= $form->field($tour, 'priceAdult')->textInput(['class' => 'c-tourForm__input--small', 'disabled' => true])->label(false) ?>
                                </div>
                            </div>
                            <div class="c-tourForm__checkboxItem">
                                <div class="c-tourForm__checkboxGroup">
                                    <input class="c-tourForm__checkboxInput" id="checkChild" type="checkbox" value="Child">
                                    <label class="c-tourForm__checkboxLabel" for="checkChild">Child</label>
                                </div>
                                <div class="c-tourForm__checkboxEl">
                                    <span class="c-tourForm__currency">$</span>
                                    <?= $form->field($tour, 'priceChild')->textInput(['class' => 'c-tourForm__input--small', 'disabled' => true])->label(false) ?>
                                </div>
                            </div>
                            <div class="c-tourForm__checkboxItem">
                                <div class="c-tourForm__checkboxGroup">
                                    <input class="c-tourForm__checkboxInput" id="checkInfant" type="checkbox" value="Infant">
                                    <label class="c-tourForm__checkboxLabel" for="checkInfant">Infant</label>
                                </div>
                                <div class="c-tourForm__checkboxEl">
                                    <span class="c-tourForm__currency">$</span>
                                    <?= $form->field($tour, 'priceInfant')->textInput(['class' => 'c-tourForm__input--small', 'disabled' => true])->label(false) ?>
                                </div>
                            </div>
                            <div class="c-tourForm__checkboxItem">
                                <div class="c-tourForm__checkboxGroup">
                                    <input class="c-tourForm__checkboxInput" id="checkSenior" type="checkbox" value="Senior">
                                    <label class="c-tourForm__checkboxLabel" for="checkSenior">Senior</label>
                                </div>
                                <div class="c-tourForm__checkboxEl">
                                    <span class="c-tourForm__currency">$</span>
                                    <?= $form->field($tour, 'priceSenior')->textInput(['class' => 'c-tourForm__input--small', 'disabled' => true])->label(false) ?>
                                </div>
                            </div>
                        </div>
                        <div class="c-tourForm__label--black">
                            2. Create groups
                        </div>
                        <?= $form->field($groups, 'newGroups')->widget(MultipleInput::className(), [
                            'rendererClass' => \unclead\multipleinput\renderers\ListRenderer::className(),
                            'max' => 5,
                            'min' => 1,
                            'addButtonPosition' => MultipleInput::POS_FOOTER,
                            'addButtonOptions' => [
                                'class' => 'c-tourForm__add'
                            ],
                            'removeButtonOptions' => [
                                'class' => 'c-tourForm__add'
                            ],
                            'columns' => [
                                [
                                    'name' => 'name',
                                    'type' => 'textInput',
                                    'enableError' => true,
                                    'options' => [
                                        'class' => 'c-tourForm__input--small',
                                        'placeholder' => 'Group name',
                                    ]
                                ],
                                [
                                    'name' => 'peopleFrom',
                                    'title' => 'People from-to',
                                    'type' => 'textInput',
                                    'enableError' => true,
                                    'options' => [
                                        'class' => 'c-tourForm__input--number',
                                    ]
                                ],
                                [
                                    'name' => 'peopleTo',
                                    'title' => '-',
                                    'type' => 'textInput',
                                    'enableError' => true,
                                    'options' => [
                                        'class' => 'c-tourForm__input--number',
                                    ]
                                ],
                                [
                                    'name' => 'price',
                                    'title' => 'Price for group $',
                                    'type' => 'textInput',
                                    'enableError' => true,
                                    'options' => [
                                        'class' => 'c-tourForm__input--small',
                                    ]
                                ],
                            ]
                        ])->label(false) ?>
<!--                        <div class="c-tourForm__list c-tourForm__list--noList">
                            <div class="c-tourForm__groupWrapper js-tourForm__group">
                                <input class="c-tourForm__input--small" placeholder="Group name">
                                <div class="c-tourForm__groupQuant ">
                                                <span class="c-tourForm__groupQuantTitle">
                                                    People from-to
                                                </span>
                                    <input class="c-tourForm__input--number">
                                        <span class="c-tourForm__groupSep">
                                                    -
                                                </span>
                                    <input class="c-tourForm__input--number">
                                </div>
                                <div class="c-tourForm__groupPrice">
                                                <span class="c-tourForm__groupPriceTitle">
                                                    Price for group
                                                </span>
                                    <span class="c-tourForm__currency">$</span>
                                    <input class="c-tourForm__input--small">
                                </div>
                            </div>
                        </div>
                        <div class="c-tourForm__addWrapper">
                            <a id="addGroup" class="c-tourForm__add c-tourForm__add">+ add group</a>
                        </div>-->
                        <div class="c-tourForm__label">
                            Additional information
                        </div>
                        <?= $form->field($tour, 'addInfo')->textarea(['class' => 'c-tourForm__input c-tourForm__textarea', 'maxlength' => true, 'placeholder' => 'Additional information'])->label(false) ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <h3 class="l-addTour__stepsTitle">
        Step 5
    </h3>
    <section class="l-addTour__step">
        <div class="c-tourForm">
            <div class="c-tourForm__block c-tourForm__pickUp">
                <div class="c-tourForm__title">
                    PickUp points.
                </div>
                <div class="c-tourForm__text">
                    Vestibulum laoreet molestie nunc id dignissim. Phasellus lacinia dictum mi. Lorem ipsum dolor sit amet, consectetur adipiscing elit.Nulla vestibulum tortor eget consectetur efficitur. Praesent luctus condimentum nisl, pharetra varius orci sollicitudin in.
                </div>
                <?= $form->field($tour, 'hotelPickup')->checkbox() ?>
<!--                <div class="c-tourForm__checkboxWrapper">
                    <svg class="c-tourForm__pickUpIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 46.087 46.087">
                        <path d="M44.6,7.162h-3.379v11.625h1.351v5.338h-2.568V6.487C40.005,2.904,37.1,0,33.517,0H12.162   C8.58,0,5.675,2.904,5.675,6.487v17.3h-2.23v-5.678h1.419V6.487H1.486v11.622h1.419v6.22h2.77v12.705   c0,2.454,1.366,4.593,3.379,5.694v3.358h5.676V43.52h16.083v2.567h5.678v-3.294c2.086-1.076,3.513-3.251,3.513-5.76V24.664h3.109   v-5.878h1.487L44.6,7.162L44.6,7.162z M15.407,1.35h15.136v3.516H15.407V1.35z M17.028,36.762H8.649V32.98h8.379V36.762z    M37.301,36.762h-8.379V32.98h8.379V36.762z M37.301,24.598c0,0-1.622,5.137-14.596,5.137c-12.976,0-14.328-5.137-14.328-5.137   V6.756h28.924V24.598z"></path>
                    </svg>
                    <input class="c-tourForm__checkboxInput" id="checkPickUp" type="checkbox" value="Hotel Pick-Up and Drop-Off">
                    <label class="c-tourForm__checkboxLabel" for="checkPickUp">Hotel Pick-Up and Drop-Off</label>
                </div>-->
                <div class="c-tourForm__map" id="map"></div>
                <?= $form->field($pickupPoints, 'allPoints')->hiddenInput()->label(false) ?>
                <div class="c-tourForm__mapButtonWrapper">
                    <button class="c-button c-tourForm__imgButton" id="removePoints">Remove all points</button>
                </div>
<!--                    <div class="c-mapForm">
                        <div class="c-mapForm__title">
                            Point
                        </div>
                        <div class="c-mapForm__block">
                            <div class="c-mapForm__label">
                                Name the point
                            </div>
                            <input class="c-mapForm__input" placeholder="-Point name-">
                            <div class="c-mapForm__label">
                                Tour's guide
                            </div>
                            <div class="c-mapForm__selectWrapper">
                                <select class="c-mapForm__select js-tourForm__selectTours">
                                    <option class="c-mapForm__option"></option>
                                    <option class="c-mapForm__option">English</option>
                                    <option class="c-mapForm__option">Ukrainian</option>
                                </select>
                            </div>
                            <div class="c-mapForm__label">
                                Departure time
                            </div>
                            <input class="c-mapForm__input" type="time" placeholder="-24-hour format, e.g. 21:00-">
                            <div class="c-mapForm__label">
                                Additional information
                            </div>
                            <textarea class="c-mapForm__input c-mapForm__textarea" placeholder="Additional information"></textarea>
                            <div class="c-mapForm__buttonGroup">
                                <button class="c-button c-button--transparentButton c-button--noneTransform">
                                    Delete
                                </button>
                                <button class="c-button c-button--noneTransform">
                                    Save the point
                                </button>
                            </div>
                        </div>
                    </div>-->
            </div>
        </div>
    </section>
    <h3 class="l-addTour__stepsTitle">
        <svg class="l-addTour__checkedIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 426.667 426.667">
            <path d="M213.333,0C95.518,0,0,95.514,0,213.333s95.518,213.333,213.333,213.333
	c117.828,0,213.333-95.514,213.333-213.333S331.157,0,213.333,0z M174.199,322.918l-93.935-93.931l31.309-31.309l62.626,62.622
	l140.894-140.898l31.309,31.309L174.199,322.918z"/>
        </svg>
    </h3>
    <section class="l-addTour__step">
        <div class="l-addTour__applyBlock">
            <p class="l-addTour__text">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
            <?= Html::submitButton($tour->isNewRecord ? 'Apply Tour' : 'Update Tour', ['class' => 'c-button']) ?>
        </div>
    </section>
<?php ActiveForm::end(); ?>