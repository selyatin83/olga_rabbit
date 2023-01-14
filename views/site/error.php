<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception $exception */

use omarinina\infrastructure\models\forms\SearchForm;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = $name;
?>

<section class="error">
    <h1 class="error__title"><?= $exception->getCode() ?></h1>
    <h2 class="error__subtitle"><?= $exception->getMessage() ?></h2>
    <ul class="error__list">
        <li class="error__item">
            <a href="<?= Url::to(['register/index']) ?>">Вход и регистрация</a>
        </li>
        <li class="error__item">
            <a href="<?= Url::to(['offers/add']) ?>">Новая публикация</a>
        </li>
        <li class="error__item">
            <a href="<?= Url::to(['/']) ?>">Главная страница</a>
        </li>
    </ul>
    <?php
    $model = new SearchForm();
    if (array_key_exists('value', $this->params)) {
        $model->search = $this->params['value'];
    }

    $form = ActiveForm::begin([
        'id' => SearchForm::class,
        'options' => ['class' => 'error__search search search--small'],
        'fieldConfig' => [
            'template' => "{label}\n{input}\n
                    <div class=\"search__icon\"></div>\n
                    {error}",
        ],
        'action' => ['search/index'],
        'method' => 'get',
    ]);
    ?>
    <?= $form->field($model, 'search')->textInput(['placeholder' => 'Поиск']) ?>
    <div class="search__close-btn"></div>
    <?php ActiveForm::end() ?>
    <a class="error__logo logo" href="<?= Url::to(['/']) ?>">
        <img src="/img/logo.svg" width="179" height="34" alt="Логотип Куплю Продам">
    </a>
</section>


