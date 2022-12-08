<?php

declare(strict_types=1);

use omarinina\infrastructure\models\forms\RegistrationForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var RegistrationForm $model */

?>

<section class="sign-up">
    <h1 class="visually-hidden">Регистрация</h1>
        <?php $form = ActiveForm::begin([
            'id' => RegistrationForm::class,
            'options' => [
                'class' => 'sign-up__form form'
            ],
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'inputOptions' => ['class' => 'js-field'],
                'errorOptions' => ['tag' => 'span', 'class' => 'error__list', 'style' => 'display: flex']
            ]
        ])
        ?>
        <div class="sign-up__title">
            <h2>Регистрация</h2>
            <?php echo Html::a('Вход', Url::to(['login/index']), ['class'=>'sign-up__link']) ?>
        </div>
        <div class="sign-up__avatar-container js-preview-container">
            <div class="sign-up__avatar js-preview"></div>
            <div class="sign-up__field-avatar">
                <?=$form->field($model, 'avatar', ['template' => "{input}\n{error}"])
                    ->fileInput([
                        'class' => 'visually-hidden js-file-field',
                        'id' => 'avatar'
                    ])
                ?>
                <label for="avatar">
                    <span class="sign-up__text-upload">Загрузить аватар…</span>
                    <span class="sign-up__text-another">Загрузить другой аватар…</span>
                </label>
            </div>
        </div>
        <?= $form->field($model, 'name', [
                'options' => [
                        'class' => 'form__field sign-up__field'
                ]])->textInput() ?>
        <?= $form->field($model, 'lastName', [
                'options' => [
                        'class' => 'form__field sign-up__field'
                ]])->textInput() ?>
        <?= $form->field($model, 'email', [
                'options' => [
                        'class' => 'form__field sign-up__field'
                ]])->textInput() ?>
        <?= $form->field($model, 'password', [
                'options' => [
                        'class' => 'form__field sign-up__field'
                ]])->passwordInput() ?>
        <?= $form->field($model, 'repeatedPassword', [
                'options' => [
                        'class' => 'form__field sign-up__field'
                ]])->passwordInput() ?>

        <?php
            echo Html::submitButton('Создать аккаунт', ['class' => 'sign-up__button btn btn--medium js-button']);
            echo Html::a('Войти через <span class="icon icon--vk"></span>', '#', ['class'=>'btn btn--small btn--flex btn--white']);

            ActiveForm::end() ?>
</section>
