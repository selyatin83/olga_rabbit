<?php

declare(strict_types=1);

/** @var yii\web\View $this */
/** @var Ads[] $newAds */
/** @var Ads[] $popularAds */

use app\widgets\AdWidget;
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
        <li class="categories-list__item">
            <a href="#" class="category-tile category-tile--default">
          <span class="category-tile__image">
            <img src="../img/cat.jpg" srcset="../img/cat@2x.jpg 2x" alt="Иконка категории">
          </span>
                <span class="category-tile__label">Дом <span class="category-tile__qty js-qty">81</span></span>
            </a>
        </li>
        <li class="categories-list__item">
            <a href="#" class="category-tile category-tile--default">
          <span class="category-tile__image">
            <img src="../img/cat02.jpg" srcset="../img/cat02@2x.jpg 2x" alt="Иконка категории">
          </span>
                <span class="category-tile__label">Электроника <span class="category-tile__qty js-qty">62</span></span>
            </a>
        </li>
        <li class="categories-list__item">
            <a href="#" class="category-tile category-tile--default">
          <span class="category-tile__image">
            <img src="../img/cat03.jpg" srcset="../img/cat03@2x.jpg 2x" alt="Иконка категории">
          </span>
                <span class="category-tile__label">Одежда <span class="category-tile__qty js-qty">106</span></span>
            </a>
        </li>
        <li class="categories-list__item">
            <a href="#" class="category-tile category-tile--default">
          <span class="category-tile__image">
            <img src="../img/cat04.jpg" srcset="../img/cat04@2x.jpg 2x" alt="Иконка категории">
          </span>
                <span class="category-tile__label">Спорт/отдых <span class="category-tile__qty js-qty">86</span></span>
            </a>
        </li>
        <li class="categories-list__item">
            <a href="#" class="category-tile category-tile--default">
          <span class="category-tile__image">
            <img src="../img/cat05.jpg" srcset="../img/cat05@2x.jpg 2x" alt="Иконка категории">
          </span>
                <span class="category-tile__label">Авто <span class="category-tile__qty js-qty">34</span></span>
            </a>
        </li>
        <li class="categories-list__item">
            <a href="#" class="category-tile category-tile--default">
          <span class="category-tile__image">
            <img src="../img/cat06.jpg" srcset="../img/cat06@2x.jpg 2x" alt="Иконка категории">
          </span>
                <span class="category-tile__label">Книги <span class="category-tile__qty js-qty">92</span></span>
            </a>
        </li>
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
