<?php

declare(strict_types=1);

namespace omarinina\domain\models\ads;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "adTypes".
 *
 * @property int $id
 * @property string $name
 *
 * @property Ads[] $ads
 */
class AdTypes extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'adTypes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
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
     * Gets query for [[Ads]].
     *
     * @return ActiveQuery
     */
    public function getAds(): ActiveQuery
    {
        return $this->hasMany(Ads::class, ['typeId' => 'id']);
    }
}
