<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%adCategories}}`.
 */
class m221129_145336_create_adCategories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%adCategories}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%adCategories}}');
    }
}
