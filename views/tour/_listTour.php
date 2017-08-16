<?php

use yii\helpers\Html;

?>

<div class="l-destinations__item">
    <div class="c-tour">
        <div class="c-tour__content cf">
            <div class="c-tour__header">
                <img src="<?= Yii::$app->request->baseUrl . '/uploads/photos/' . $tour->id . '/' . $tour->promoPhoto->src ?>" class="c-tour__img">
                <div class="c-tour__bg"></div>
            </div>
            <div class="c-tour__body">
                <div class="c-tour__head">
                    <?= Html::a($tour->name, ['view', 'id' => $tour->id]); ?>
                </div>
                <div class="c-tour__text">
                    <?= $tour->descShort; ?>
                    <?= Html::a('Read more >', ['view', 'id' => $tour->id], ['class' => 'c-tour__readMore']); ?>
                </div>
                <div class="c-tour__info cf">
                    <div class="c-tour__leftPart">
                        <div class="c-time">
                            <div class="c-time__img">
                                <svg class="c-time__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
                                    <path d="M49.9 11C28.4 11 11 28.4 11 49.9c0 21.4 17.4 38.9 38.9 38.9 21.4 0 38.9-17.4 38.9-38.9C88.7 28.4 71.3 11 49.9 11zm0 69.5c-16.9 0-30.6-13.7-30.6-30.6C19.3 33 33 19.3 49.9 19.3c16.9 0 30.6 13.7 30.6 30.6 0 16.8-13.8 30.6-30.6 30.6zm0 0"/>
                                    <path d="M70.1 48.7H52.7v-21c0-1.8-1.4-3.2-3.2-3.2-1.8 0-3.2 1.4-3.2 3.2v24.2c0 1.8 1.4 3.2 3.2 3.2h20.7c1.8 0 3.2-1.4 3.2-3.2-.1-1.8-1.5-3.2-3.3-3.2zm0 0"/>
                                </svg>
                            </div>
                            <div class="c-time__text">Duration:</div>
                            <div class="c-time__clock"><?= $tour->secondsToWords($tour->duration) ?></div>
                        </div>
                    </div>
                    <div class="c-tour__rightPart">
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
                            <div class="c-rating__value">(<?= round($tour->ratings, 2) ?>)</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="c-tour__footer">
                <div class="c-tour__priceBlock">
                    <div class="c-tour__text">Price from</div>
                    <div class="c-tour__price">$<?= $tour->priceAdult; ?></div>
                </div>
                <div class="c-tour__bookBlock">
                    <div class="c-tour__text c-tour__text--lightColor">Book with</div>
                    <div class="c-tour__book">$<?= $tour->deposit; ?></div>
                </div>
                <div class="c-tour__buttonWrap">
                    <?= Html::a('Details', ['view', 'id' => $tour->id], ['class' => 'c-button c-button--tourDetails']); ?>
                </div>
            </div>
        </div>
    </div>
</div>