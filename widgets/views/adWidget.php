<?php

declare(strict_types=1);

/** @var Ads $ad */

use omarinina\domain\models\ads\AdCategories;
use omarinina\domain\models\ads\Images;
use omarinina\domain\models\ads\Ads;
use yii\helpers\Url;

if (is_array($ad)) {
    $categories = AdCategories::find()->where(['id' => $ad['categories']])->all();
    if ($ad['images']) {
        $image = Images::findOne($ad['images'][0]);
    }
}

?>

<?php if (is_array($ad)) : ?>
<li class="tickets-list__item">
    <div class="ticket-card ticket-card--color01">
        <div class="ticket-card__img">
            <img
                    src="<?= $image->imageSrc ?? '/img/blank.png' ?>"
                    srcset="<?= $image->imageSrc ?? '/img/blank@2x.png 2x' ?>" alt="Изображение товара">
        </div>
        <div class="ticket-card__info">
            <span class="ticket-card__label"><?= $ad['type'] ?></span>
            <?php if ($categories) : ?>
            <div class="ticket-card__categories">
                <?php foreach ($categories as $category) : ?>
                <a href="#"><?= $category->name ?></a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <div class="ticket-card__header">
                <h3 class="ticket-card__title">
                    <a href="<?= Url::to(['offers/view', 'id' => $ad['id']]) ?>"><?= $ad['name'] ?></a>
                </h3>
                <p class="ticket-card__price"><span class="js-sum"><?= $ad['price'] ?></span> ₽</p>
            </div>
            <div class="ticket-card__desc">
                <p><?= mb_strimwidth($ad['description'], 0, 55, '...') ?></p>
            </div>
        </div>
    </div>
</li>
<?php else : ?>
<li class="tickets-list__item">
    <div class="ticket-card ticket-card--color01">
        <div class="ticket-card__img">
            <img
                    src="<?= $ad->images[0]->imageSrc ?? '/img/blank.png' ?>"
                    srcset="<?= $ad->images[0]->imageSrc ?? '/img/blank@2x.png 2x' ?>" alt="Изображение товара">
        </div>
        <div class="ticket-card__info">
            <span class="ticket-card__label"><?= $ad->type->name ?></span>
            <div class="ticket-card__categories">
                <?php foreach ($ad->adCategories as $category) : ?>
                    <a href="#"><?= $category->name ?></a>
                <?php endforeach; ?>
            </div>
            <div class="ticket-card__header">
                <h3 class="ticket-card__title">
                    <a href="<?= Url::to(['offers/view', 'id' => $ad->id]) ?>"><?= $ad->name ?></a>
                </h3>
                <p class="ticket-card__price"><span class="js-sum"><?= $ad->price ?></span> ₽</p>
            </div>
            <div class="ticket-card__desc">
                <p><?= mb_strimwidth($ad->description, 0, 55, '...') ?></p>
            </div>
        </div>
    </div>
</li>
<?php endif; ?>
