<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var Ads[] $newAds */
/** @var Ads[] $popularAds */
/** @var AdCategories[] $categories */

use app\widgets\AdWidget;
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
    <ul class="categories-list__wrapper">
        <?php foreach ($categories as $category) : ?>
            <?php $categorySrc = Yii::$app->params['categorySrc'][array_rand(Yii::$app->params['categorySrc'])] ?>
        <li class="categories-list__item">
            <a href="#" class="category-tile category-tile--default">
          <span class="category-tile__image">
            <img src="<?= $categorySrc ?>" srcset="<?= $categorySrc ?> 2x" alt="Иконка категории">
          </span>
                <span class="category-tile__label"><?= $category->name ?> <span class="category-tile__qty js-qty"><?= $category->getAmountAds() ?></span></span>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
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
