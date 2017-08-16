<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $orders app\models\Orders */

$this->title = 'Cart';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('/css/cart.css');
?>

<div class="l-action l-action--textBlock">
    <div class="l-mainContent">
        <div class="l-action__content--textBlock">
            <div class="l-action__textBlock">
                <p class="l-action__text--white l-action__text--bold">
                    Cart!
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
                    Cart
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
    <div class="c-cart">
        <div class="c-cart__list">
            <? foreach ($orders as $order) { ?>
            <div class="c-cart__item">
                <?= Html::a($order->tour->name, ['/tour/view', 'id' => $order->tour->id], ['class' => 'c-cart__title']) ?>
                <div class="c-cart__block cf">
                    <div class="c-cart__image">
                        <img src="<?= Yii::$app->request->baseUrl.'/uploads/photos/'.$order->tour->id .'/'.$order->tour->promoPhoto->src ?>" class="c-cart__img">
                        <div class="c-cart__bg"></div>
                    </div>
                    <div class="c-cart__info">
                        <div class="c-cart__content">
                            <div class="c-cart__row">
                                <div class="c-cart__column">
                                    <? if ($order->totalAdult) { ?>
                                    <span class="c-cart__infoText">
                                        Adults:
                                    </span>
                                    <span class="c-cart__infoNumber">
                                        <?= $order->totalAdult ?>
                                    </span>
                                    <? } ?>
                                    <? if ($order->totalChild) { ?>
                                    <span class="c-cart__infoText c-cart__infoText--second">
                                        Children:
                                    </span>
                                    <span class="c-cart__infoNumber">
                                        <?= $order->totalChild ?>
                                    </span>
                                    <? } ?>
                                </div>
                                <div class="c-cart__column">
                                    <? if ($order->totalInfant) { ?>
                                    <span class="c-cart__infoText">
                                        Infants:
                                    </span>
                                    <span class="c-cart__infoNumber">
                                        <?= $order->totalInfant ?>
                                    </span>
                                    <? } ?>
                                    <? if ($order->totalSenior) { ?>
                                    <span class="c-cart__infoText c-cart__infoText--second">
                                        Senior:
                                    </span>
                                    <span class="c-cart__infoNumber">
                                        <?= $order->totalSenior ?>
                                    </span>
                                    <? } ?>
                                </div>
                            </div>
                            <div class="c-cart__bottomText">
                                <div class="c-cart__infoText">
                                    Travel dates:
                                </div>
                                <div class="c-cart__infoNumber">
                                    <?= $order->dateStartTour ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="c-cart__prices">
                        <div class="c-cart__content">
                            <? if ($order->totalAdult) { ?>
                            <div class="c-cart__pricesBlock">
                                <span class="c-cart__pricesText--gray">
                                    <?= "$".$order->tour->priceAdult." x $order->totalAdult Adults:" ?>
                                </span>
                                <span class="c-cart__pricesText--lightblue">
                                    <?= "$".$order->tour->priceAdult * $order->totalAdult."" ?>
                                </span>
                            </div>
                            <? } ?>
                            <? if ($order->totalChild) { ?>
                            <div class="c-cart__pricesBlock">
                                <span class="c-cart__pricesText--gray">
                                    <?= "$".$order->tour->priceChild." x $order->totalChild Children:" ?>
                                </span>
                                <span class="c-cart__pricesText--lightblue">
                                    <?= "$".$order->tour->priceChild * $order->totalChild."" ?>
                                </span>
                            </div>
                            <? } ?>
                            <? if ($order->totalInfant) { ?>
                            <div class="c-cart__pricesBlock">
                                <span class="c-cart__pricesText--gray">
                                    <?= "$".$order->tour->priceInfant." x $order->totalInfant Infants:" ?>
                                </span>
                                <span class="c-cart__pricesText--lightblue">
                                    <?= "$".$order->tour->priceInfant * $order->totalInfant."" ?>
                                </span>
                            </div>
                            <? } ?>
                            <? if ($order->totalSenior) { ?>
                            <div class="c-cart__pricesBlock">
                                <span class="c-cart__pricesText--gray">
                                    <?= "$".$order->tour->priceSenior." x $order->totalSenior Senior:" ?>
                                </span>
                                <span class="c-cart__pricesText--lightblue">
                                    <?= "$".$order->tour->priceSenior * $order->totalSenior."" ?>
                                </span>
                            </div>
                            <? } ?>
                            <div class="c-cart__bottomText">
                                <div class="c-cart__bottomRow">
                                    <span class="c-cart__pricesText--black">
                                        Booking deposit:
                                    </span>
                                    <span class="c-cart__pricesText--lightblue">
                                        $<?= $order->payPrice ?>
                                    </span>
                                </div>
                                <div class="c-cart__rowBottom">
                                    <span class="c-cart__pricesText--black">
                                        Remaining balance:
                                    </span>
                                    <span class="c-cart__pricesText--lightblue">
                                        $<?= $order->totalPrice - $order->payPrice ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="c-cart__total">
                        <div class="c-cart__content">
                            <div class="c-cart__iconWrapper">
                                <?= Html::beginTag('a', ['href' => Url::to(['/order/delete', 'id' => $order->orderId]), 'data-method' => 'POST']) ?>
                                    <svg class="c-cart__iconClose" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 47.971 47.971">
                                        <path d="M28.228 23.986L47.092 5.122c1.172-1.171 1.172-3.071 0-4.242-1.172-1.172-3.07-1.172-4.242 0L23.986 19.744 5.121.88C3.949-.292 2.051-.292.879.88c-1.172 1.171-1.172 3.071 0 4.242l18.865 18.864L.879 42.85c-1.172 1.171-1.172 3.071 0 4.242.586.585 1.354.878 2.121.878s1.535-.293 2.121-.879l18.865-18.864L42.85 47.091c.586.586 1.354.879 2.121.879s1.535-.293 2.121-.879c1.172-1.171 1.172-3.071 0-4.242L28.228 23.986z"></path>
                                    </svg>
                                <?= Html::endTag('a') ?>
                            </div>
                            <div class="c-cart__totalBlock">
                                <div class="c-cart__totalText">
                                    Per tour:
                                </div>
                                <div class="c-cart__totalPrice">
                                    $<?= $order->totalPrice ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="c-cart__separator"></div>
            <? } ?>
        </div>
        <div class="c-cart__priceBlock">
            <div class="c-cart__priceText">
                <span class="c-cart__priceTitle">Total:</span>
                <span class="c-cart__priceSum">$<?= $totalSum ?></span>
            </div>
            <?= Html::a('Proceed', ['/order/update', 'ids' => $ordersIds], ['class' => 'c-button']) ?>
        </div>
    </div>
</div>