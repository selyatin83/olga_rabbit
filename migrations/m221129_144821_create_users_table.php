<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m221129_144821_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'lastName' => $this->string(50)->notNull(),
            'email' => $this->string(50)->unique()->notNull(),
            'password' => $this->char(60)->notNull(),
            'avatarSrc' => $this->text()->notNull(),
            'vkId' => $this->integer()->null()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
