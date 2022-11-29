<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%adTypes}}`.
 */
class m221129_145228_create_adTypes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%adTypes}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%adTypes}}');
    }
}
