<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var Ads[] $userAds */

use app\widgets\AdWidget;
use omarinina\domain\models\ads\Ads;
use yii\helpers\Url;

?>

<section class="tickets-list">
    <h2 class="visually-hidden">Самые новые предложения</h2>
    <div class="tickets-list__wrapper">
        <div class="tickets-list__header">
            <a href="<?= Url::to(['offers/add']) ?>" class="tickets-list__btn btn btn--big">
                <span>Новая публикация</span>
            </a>
        </div>
        <ul>
            <?php foreach ($userAds as $ad) : ?>
                <?= AdWidget::widget(['ad' => $ad]) ?>
            <?php endforeach; ?>
        </ul>
    </div>
