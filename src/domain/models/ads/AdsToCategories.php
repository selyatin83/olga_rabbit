<?php

declare(strict_types=1);

namespace omarinina\domain\models\ads;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "adsToCategories".
 *
 * @property int $id
 * @property int $adId
 * @property int $categoryId
 *
 * @property Ads $ad
 * @property AdCategories $category
 */
class AdsToCategories extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'adsToCategories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['adId', 'categoryId'], 'required'],
            [['adId', 'categoryId'], 'integer'],
            [['adId'], 'exist', 'skipOnError' => true, 'targetClass' => Ads::class, 'targetAttribute' => ['adId' => 'id']],
            [['categoryId'], 'exist', 'skipOnError' => true, 'targetClass' => AdCategories::class, 'targetAttribute' => ['categoryId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'adId' => 'Ad ID',
            'categoryId' => 'Category ID',
        ];
    }

    /**
     * Gets query for [[Ad]].
     *
     * @return ActiveQuery
     */
    public function getAd(): ActiveQuery
    {
        return $this->hasOne(Ads::class, ['id' => 'adId']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return ActiveQuery
     */
    public function getCategory(): ActiveQuery
    {
        return $this->hasOne(AdCategories::class, ['id' => 'categoryId']);
    }
}
