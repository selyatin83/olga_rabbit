<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var string $value */
/** @var array $searchedAds */
/** @var Ads[] $newAds */

$this->params['value'] = $value;

use app\widgets\AdWidget;
use omarinina\domain\models\ads\Ads;

?>

<section class="search-results">
    <h1 class="visually-hidden">Результаты поиска</h1>
    <div class="search-results__wrapper">
        <?php if (!$searchedAds) : ?>
        <div class="search-results__message">
            <p>Не найдено <br>ни&nbsp;одной публикации</p>
        </div>
        <?php else : ?>
        <p class="search-results__label">Найдено <span class="js-results">
                <?= Yii::$app->inflection->pluralize(count($searchedAds), 'публикация') ?>
                </span>
        </p>
        <ul class="search-results__list">
            <?php foreach ($searchedAds as $ad) : ?>
                <?= AdWidget::widget(['ad' => $ad]) ?>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </div>
</section>
<section class="tickets-list">
    <h2 class="visually-hidden">Самые новые предложения</h2>
    <div class="tickets-list__wrapper">
        <div class="tickets-list__header">
            <p class="tickets-list__title">Самое свежее</p>
        </div>
        <ul>
            <?php foreach ($newAds as $ad) : ?>
                <?= AdWidget::widget(['ad' => $ad]) ?>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

