<?php

declare(strict_types=1);

namespace omarinina\domain\models\ads;

use yii\base\InvalidConfigException;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "adCategories".
 *
 * @property int $id
 * @property string $name
 *
 * @property AdsToCategories[] $adsToCategories
 * @property Ads[] $ads
 */
class AdCategories extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'adCategories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[AdsToCategories]].
     *
     * @return ActiveQuery
     */
    public function getAdsToCategories(): ActiveQuery
    {
        return $this->hasMany(AdsToCategories::class, ['categoryId' => 'id']);
    }

    /**
     * Gets query for [[Ads]].
     *
     * @return ActiveQuery
     * @throws InvalidConfigException
     */
    public function getAds(): ActiveQuery
    {
        return $this->hasMany(Ads::class, ['id' => 'adId'])
            ->viaTable('adsToCategories', ['categoryId' => 'id']);
    }

    /**
     * @return int
     * @throws InvalidConfigException
     */
    public function getAmountAds(): int
    {
        return $this->getAds()->count();
    }
}
