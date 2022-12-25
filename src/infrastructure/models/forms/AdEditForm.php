<?php

declare(strict_types=1);

namespace omarinina\infrastructure\models\forms;

use omarinina\domain\models\ads\AdTypes;

class AdEditForm extends AdCreateForm
{
    public function rules(): array
    {
        return [
            [['name', 'typeId', 'description', 'email', 'price', 'categories'], 'required'],
            ['name', 'string', 'min' => 10, 'max' => 100],
            ['description', 'string', 'min' => 50, 'max' => 1000],
            ['categories', 'validateCategories'],
            ['email', 'email'],
            ['price', 'default'],
            ['price', 'integer', 'min' => 100],
            ['typeId', 'exist', 'targetClass' => AdTypes::class, 'targetAttribute' => ['typeId' => 'id']],
            ['images', 'image', 'maxFiles' => 10, 'extensions' => 'png, jpg', 'maxSize' => 5 * 1024 * 1024],
        ];
    }
}