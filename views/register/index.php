<?php

declare(strict_types=1);

use omarinina\infrastructure\models\forms\RegistrationForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var RegistrationForm $model */

?>

<section class="sign-up">
    <h1 class="visually-hidden">Регистрация</h1>
        <?php $form = ActiveForm::begin([
            'id' => 'registration-form',
            'options' => [
                'class' => 'sign-up__form form'
            ],
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'inputOptions' => ['class' => 'js-field'],
                'errorOptions' => ['tag' => 'span']
            ]
        ])
        ?>
        <div class="sign-up__title">
            <h2>Регистрация</h2>
            <?php echo Html::a('Вход', 'login.html', ['class'=>'sign-up__link']) ?>
        </div>
        <div class="sign-up__avatar-container js-preview-container">
            <div class="sign-up__avatar js-preview"></div>
            <div class="sign-up__field-avatar">
                <label for="avatar">
                    <?= $form->field($model, 'avatar', [
                        'template' => "<span class=\"sign-up__text-upload\">Загрузить аватар…{input}",
                        'inputOptions' => [
                            'style' => 'display: none',
                            'hidden' => true,
                            'class' => 'visually-hidden js-file-field'
                        ],
                    ])->hiddenInput(['id' => 'registration-form']) ?>
                    <?= $form->field($model, 'avatar', [
                        'template' => "<label class=\"sign-up__text-another\">Загрузить другой аватар…{input}",
                        'inputOptions' => [
                            'style' => 'display: none',
                            'hidden' => true,
                            'class' => 'visually-hidden js-file-field'
                        ],
                    ])->hiddenInput(['id' => 'registration-form']) ?>
                </label>
            </div>
        </div>
        <?= $form->field($model, 'name', ['options' => ['class' => 'form__field sign-up__field']])->textInput() ?>
        <?= $form->field($model, 'lastName', ['options' => ['class' => 'form__field sign-up__field']])->textInput() ?>
        <?= $form->field($model, 'email', ['options' => ['class' => 'form__field sign-up__field']])->textInput() ?>
        <?= $form->field($model, 'password', ['options' => ['class' => 'form__field sign-up__field']])
            ->passwordInput() ?>
        <?= $form->field($model, 'repeatedPassword', ['options' => ['class' => 'half-wrapper form-group']])
            ->passwordInput() ?>

        <?php
            echo Html::submitButton('Создать аккаунт', ['class' => 'sign-up__button btn btn--medium js-button']);
            echo Html::a('Войти через <span class="icon icon--vk"></span>', '#', ['class'=>'btn btn--small btn--flex btn--white']);

            ActiveForm::end() ?>
</section>
