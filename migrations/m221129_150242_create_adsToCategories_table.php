<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%adsToCategories}}`.
 */
class m221129_150242_create_adsToCategories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%adsToCategories}}', [
            'id' => $this->primaryKey(),
            'adId' => $this->integer()->notNull(),
            'categoryId' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'CATEGORY_AD_ID',
            'adsToCategories',
            'adId',
            'ads',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'AD_CATEGORY_ID',
            'adsToCategories',
            'categoryId',
            'adCategories',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('AD_CATEGORY_ID', 'adsToCategories');
        $this->dropForeignKey('CATEGORY_AD_ID', 'adsToCategories');
        $this->dropTable('{{%adsToCategories}}');
    }
}
