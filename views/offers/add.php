<?php

declare(strict_types=1);

use omarinina\domain\models\ads\AdCategories;
use omarinina\domain\models\ads\AdTypes;
use omarinina\infrastructure\models\forms\AdCreateForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var AdCreateForm $model */
/** @var AdCategories $categories */
/** @var AdTypes $types */

?>

<section class="ticket-form">
    <div class="ticket-form__wrapper">
        <h1 class="ticket-form__title">Новая публикация</h1>
        <div class="ticket-form__tile">
            <?php $form = ActiveForm::begin([
                'id' => AdCreateForm::class,
                'options' => [
                    'class' => 'ticket-form__form form'
                ],
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'inputOptions' => ['class' => 'js-field'],
                    'errorOptions' => ['tag' => 'span', 'class' => 'error__list', 'style' => 'display: flex']
                ]
            ])
            ?>
                <div class="ticket-form__avatar-container js-preview-container">
                    <div class="ticket-form__avatar js-preview"></div>
                    <div class="ticket-form__field-avatar">
                        <?=$form->field($model, 'images[]', ['template' => "{input}\n{error}"])
                            ->fileInput([
                                'class' => 'visually-hidden js-file-field',
                                'id' => 'avatar',
                                'multiple' => true
                            ])
                        ?>
                        <label for="avatar">
                            <span class="ticket-form__text-upload">Загрузить фото…</span>
                            <span class="ticket-form__text-another">Загрузить другое фото…</span>
                        </label>
                    </div>
                </div>
                <div class="ticket-form__content">
                    <div class="ticket-form__row">
                        <?= $form->field($model, 'name', [
                            'options' => [
                                'class' => 'form__field'
                            ]])->textInput() ?>
                    </div>
                    <div class="ticket-form__content">
                        <?= $form->field($model, 'email', [
                            'options' => [
                                'class' => 'form__field'
                            ]])->textInput() ?>
                    </div>
                    <div class="ticket-form__row">
                        <?= $form->field($model, 'description', [
                            'options' => [
                                'class' => 'form__field',
                                'cols' => 30,
                                'rows' => 10
                            ]])->textarea() ?>
                    </div>
                    <?= $model->getErrors('categories')[0] . PHP_EOL ?>
                    <?= $form->field($model, 'categories', [
                            'options' => ['class' => 'ticket-form__row'],
                            'template' => "{input}"
                        ])
                        ->dropDownList(
                            ArrayHelper::map($categories, 'id', 'name'),
                            [
                                'class' => 'ticket-form__row form__select js-multiple-select',
                                'placeholder' => "Выбрать категорию публикации",
                                'multiple' => true
                            ]
                        )
                    ?>
                    <div class="ticket-form__row">
                        <div>
                        <?= $form->field($model, 'price', ['options' => ['class' => 'form__field form__field--price'], 'template' => "{input}\n{label}\n{error}"])
                            ->input('number', ['class' => 'js-field js-price form__field form__field--price', 'id' => 'price-field']) ?>
                        </div>
                        <div class="form__switch switch">
                        <?= $form->field($model, 'typeId', [
                            'template' => "{input}"
                        ])
                            ->radioList(ArrayHelper::map($types, 'id', 'name'), ['class' => 'form__switch switch',
                                'item' => static function ($index, $label, $name, $checked, $value) {
                                    return
                                        Html::beginTag('div', ['class' => 'switch__item']) .
                                        Html::radio($name, $checked, ['value' => $value, 'id' => $index, 'class' => 'visually-hidden']) .
                                        Html::label($label, $index, ['class' => 'switch__button']) .
                                        Html::endTag('div');
                                },
                            ])
                        ?>
                        </div>
                        <?= $model->getErrors('typeId')[0] . PHP_EOL ?>
                    </div>


                    <?php
            echo Html::submitButton('Опубликовать', ['class' => 'form__button btn btn--medium js-button']);

            ActiveForm::end()
            ?>
        </div>
    </div>
</section>

