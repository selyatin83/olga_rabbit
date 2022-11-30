<?php

use yii\db\Migration;

/**
 * Class m221130_145853_add_data_to_adCategories
 */
class m221130_145853_add_data_to_adCategories extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert(
            'adCategories',
            ['name'],
            [
                ['Дом'],
                ['Спорт и отдых'],
                ['Авто'],
                ['Электроника'],
                ['Одежда'],
                ['Книги'],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
