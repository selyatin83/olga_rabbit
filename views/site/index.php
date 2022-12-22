<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var Ads[] $newAds */
/** @var Ads[] $popularAds */
/** @var AdCategories[] $categories */

use app\widgets\AdWidget;
use app\widgets\CategoryNavigationWidget;
use omarinina\domain\models\ads\AdCategories;
use omarinina\domain\models\ads\Ads;

?>

<?php if (!$newAds) : ?>
<div class="message">
    <div class="message__text">
        <p>На сайте еще не опубликовано ни&nbsp;одного объявления.</p>
    </div>
    <a href="#" class="message__link btn btn--big">Вход и регистрация</a>
</div>
<?php else : ?>
<section class="categories-list">
    <h1 class="visually-hidden">Сервис объявлений "Куплю - продам"</h1>
    <?= CategoryNavigationWidget::widget(['categories' => $categories]) ?>
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
<section class="tickets-list">
    <h2 class="visually-hidden">Самые обсуждаемые предложения</h2>
    <div class="tickets-list__wrapper">
        <div class="tickets-list__header">
            <p class="tickets-list__title">Самые обсуждаемые</p>
        </div>
        <ul>
            <?php foreach ($popularAds as $ad) : ?>
                <?= AdWidget::widget(['ad' => $ad]) ?>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
<?php endif; ?>
