<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%adsToImages}}`.
 */
class m221211_131651_create_adsToImages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%adsToImages}}', [
            'id' => $this->primaryKey(),
            'imageId' => $this->integer()->notNull(),
            'adId' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'AD_IMAGE_ID',
            'AdsToImages',
            'imageId',
            'images',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'IMAGE_AD_ID',
            'AdsToImages',
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
        $this->dropForeignKey('IMAGE_AD_ID', 'AdsToImages');
        $this->dropForeignKey('AD_IMAGE_ID', 'AdsToImages');

        $this->dropTable('{{%adsToImages}}');
    }
}
