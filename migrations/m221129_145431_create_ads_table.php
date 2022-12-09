<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ads}}`.
 */
class m221129_145431_create_ads_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ads}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'typeId' => $this->integer()->notNull(),
            'description' => $this->text()->notNull(),
            'author' => $this->integer()->notNull(),
            'email' => $this->string(50)->notNull(),
            'price' => $this->integer()->notNull(),
            'createAt' => $this->timestamp()
                ->defaultValue(new \yii\db\Expression('NOW()'))->notNull()
        ]);

        $this->addForeignKey(
            'AD_TYPE',
            'ads',
            'typeId',
            'adTypes',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'AD_AUTHOR',
            'ads',
            'author',
            'users',
            'id',
            'CASCADE'
        );

        $this->createIndex('ad_name', 'ads', 'name');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('ad_name', 'ads');
        $this->dropForeignKey('AD_AUTHOR', 'ads');
        $this->dropForeignKey('AD_TYPE', 'ads');
        $this->dropTable('{{%ads}}');
    }
}
