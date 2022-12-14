<?php

declare(strict_types=1);

namespace omarinina\infrastructure\models\forms;

use yii\base\Model;

class CommentCreateForm extends Model
{
    /** @var string  */
    public string $text = '';

    public function rules(): array
    {
        return [
            ['text', 'required'],
            ['text', 'string', 'min' => 20],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'text' => 'Комментарий',
        ];
    }
}