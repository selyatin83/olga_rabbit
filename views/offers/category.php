<?php

declare(strict_types=1);

use app\widgets\AdWidget;
use app\widgets\CategoryNavigationWidget;
use omarinina\domain\models\ads\AdCategories;
use omarinina\domain\models\ads\Ads;
use yii\data\Pagination;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */
/** @var AdCategories[] $categories */
/** @var Ads[] $categoryAds */
/** @var AdCategories $currentCategory */
/** @var Pagination $pagination */


?>

<section class="categories-list">
    <h1 class="visually-hidden">Сервис объявлений "Куплю - продам"</h1>
    <?= CategoryNavigationWidget::widget(['categories' => $categories]) ?>
</section>
<section class="tickets-list">
    <h2 class="visually-hidden">Предложения из категории <?= $currentCategory->name ?></h2>
    <div class="tickets-list__wrapper">
        <div class="tickets-list__header">
            <p class="tickets-list__title">
                <?= $currentCategory->name ?> <b class="js-qty">
                    <?= $currentCategory->getAmountAds() ?></b>
            </p>
        </div>
        <?php if (!$categoryAds) : ?>
        <div class="message__text">
            <p>Объявления отсутствуют.</p>
        </div>
        <?php else : ?>
        <ul>
            <?php foreach ($categoryAds as $ad) : ?>
                <?= AdWidget::widget(['ad' => $ad]) ?>
            <?php endforeach; ?>
        </ul>
        <div class="tickets-list__pagination">
            <?= LinkPager::widget([
                'pagination' => $pagination,
                'options' => ['class' => 'pagination'],
                'activePageCssClass' => 'active',
                'disableCurrentPageButton' => true,
                'maxButtonCount' => 5,
                'prevPageLabel' => false,
                'nextPageLabel' => 'дальше',
                'hideOnSinglePage' => true,
            ]) ?>
        </div>
        <?php endif; ?>
    </div>
</section>
