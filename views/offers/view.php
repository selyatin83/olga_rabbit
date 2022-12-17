<?php

declare(strict_types=1);

use app\widgets\CommentWidget;
use omarinina\domain\models\ads\AdCategories;
use omarinina\domain\models\ads\Ads;
use omarinina\domain\models\ads\AdTypes;
use omarinina\domain\models\Users;
use omarinina\infrastructure\models\forms\AdCreateForm;
use omarinina\infrastructure\models\forms\CommentCreateForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var Ads $currentAd */
/** @var CommentCreateForm $model */

/** @var Users $currentUser */
$currentUser = Yii::$app->user->identity;

?>

<section class="ticket">
    <div class="ticket__wrapper">
        <h1 class="visually-hidden">Карточка объявления</h1>
        <div class="ticket__content">
            <div class="ticket__img">
                <img src="<?= $currentAd->images[0]->imageSrc ?? Yii::$app->params['defaultImageSrc'] ?>" srcset="<?= $currentAd->images[0]->imageSrc ?? Yii::$app->params['defaultImageSrc'] ?>" alt="Изображение товара">
            </div>
            <div class="ticket__info">
                <h2 class="ticket__title"><?= $currentAd->name ?></h2>
                <div class="ticket__header">
                    <p class="ticket__price"><span class="js-sum"><?= $currentAd->price ?></span> ₽</p>
                    <p class="ticket__action"><?= strtoupper($currentAd->type->name) ?></p>
                </div>
                <div class="ticket__desc">
                    <p><?= $currentAd->description ?></p>
                </div>
                <div class="ticket__data">
                    <p>
                        <b>Дата добавления:</b>
                        <span><?= Yii::$app->formatter->asDate($currentAd->createAt, 'dd MMMM yyyy') ?></span>
                    </p>
                    <p>
                        <b>Автор:</b>
                        <a href="#"><?= $currentAd->authorUser->name . ' ' . $currentAd->authorUser->lastName ?></a>
                    </p>
                    <p>
                        <b>Контакты:</b>
                        <a href="mailto:<?= $currentAd->email ?>"><?= $currentAd->email ?></a>
                    </p>
                </div>
                <ul class="ticket__tags">
                    <?php foreach ($currentAd->adCategories as $category): ?>
                    <?php $categorySrc = Yii::$app->params['categorySrc'][array_rand(Yii::$app->params['categorySrc'])] ?>
                    <li>
                        <a href="#" class="category-tile category-tile--small">
                            <span class="category-tile__image">
                              <img src="<?= $categorySrc ?>" srcset="<?= $categorySrc ?> 2x" alt="Иконка категории">
                            </span>
                            <span class="category-tile__label"><?= $category->name ?></span>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="ticket__comments">
            <?php if (Yii::$app->user->isGuest): ?>
            <div class="ticket__warning">
                <p>Отправка комментариев доступна <br>только для зарегистрированных пользователей.</p>
                <a href="sign-up.html" class="btn btn--big">Вход и регистрация</a>
            </div>
            <?php endif; ?>
            <h2 class="ticket__subtitle">Коментарии</h2>
            <?php if (!Yii::$app->user->isGuest): ?>
            <div class="ticket__comment-form">
                <?php $form = ActiveForm::begin([
                    'id' => CommentCreateForm::class,
                    'options' => [
                        'class' => 'form comment-form'
                    ],
                    'fieldConfig' => [
                        'template' => "{input}\n{label}\n{error}",
                        'inputOptions' => ['class' => 'js-field'],
                        'errorOptions' => ['tag' => 'span', 'class' => 'error__list', 'style' => 'display: flex']
                    ]
                ])
                ?>
                    <div class="comment-form__header">
                        <a href="#" class="comment-form__avatar avatar">
                            <img src="<?= $currentUser->avatarSrc ?>" srcset="<?= $currentUser->avatarSrc ?>" alt="Аватар пользователя">
                        </a>
                        <p class="comment-form__author">Вам слово</p>
                    </div>
                    <div class="comment-form__field">
                        <?= $form->field($model, 'text', [
                            'options' => [
                                'class' => 'form__field',
                                'cols' => 30,
                                'rows' => 10
                            ]])->textarea() ?>
                    </div>
                <?php
                echo Html::submitButton('Отправить', ['class' => 'comment-form__button btn btn--white js-button']);

                ActiveForm::end()
                ?>
            </div>
            <?php endif; ?>
            <?php if (!$currentAd->comments): ?>
                <div class="ticket__message">
                    <p>У этой публикации еще нет ни одного комментария.</p>
                </div>
            <?php else: ?>
                <div class="ticket__comments-list">
                    <ul class="comments-list">
                        <?php foreach ($currentAd->getComments()->orderBy(['createAt' => SORT_DESC])->all() as $comment) : ?>
                            <?= CommentWidget::widget(['comment' => $comment]) ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
        <button class="chat-button" type="button" aria-label="Открыть окно чата"></button>
    </div>
</section>