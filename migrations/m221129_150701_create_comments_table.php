<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comments}}`.
 */
class m221129_150701_create_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comments}}', [
            'id' => $this->primaryKey(),
            'author' => $this->integer()->notNull(),
            'adId' => $this->integer()->notNull(),
            'text' => $this->text()->notNull(),
            'createAt' => $this->timestamp()
                ->defaultValue(new \yii\db\Expression('NOW()'))->notNull()
        ]);

        $this->addForeignKey(
            'COMMENT_AUTHOR',
            'comments',
            'author',
            'users',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'COMMENT_AD',
            'comments',
            'adId',
            'ads',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('COMMENT_AD', 'comments');
        $this->dropForeignKey('COMMENT_AUTHOR', 'comments');
        $this->dropTable('{{%comments}}');
    }
}
