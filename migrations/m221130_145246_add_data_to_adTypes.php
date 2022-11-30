<?php

use yii\db\Migration;

/**
 * Class m221130_145246_add_data_to_adTypes
 */
class m221130_145246_add_data_to_adTypes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert(
            'adTypes',
            ['name'],
            [
                ['Продам'],
                ['Куплю'],
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
