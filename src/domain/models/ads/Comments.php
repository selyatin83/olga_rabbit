<?php

declare(strict_types=1);

namespace omarinina\domain\models\ads;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;
use omarinina\domain\models\Users;

/**
 * This is the model class for table "comments".
 *
 * @property int $id
 * @property int $author
 * @property int $adId
 * @property string $text
 * @property string $createAt
 *
 * @property Ads $ad
 * @property Users $authorUser
 */
class Comments extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['author', 'adId', 'text'], 'required'],
            [['author', 'adId'], 'integer'],
            [['text'], 'string'],
            [['createAt'], 'safe'],
            [['author'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['author' => 'id']],
            [['adId'], 'exist', 'skipOnError' => true, 'targetClass' => Ads::class, 'targetAttribute' => ['adId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'author' => 'Author',
            'adId' => 'Ad ID',
            'text' => 'Text',
            'createAt' => 'Create At',
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
     * Gets query for [[AuthorUser]].
     *
     * @return ActiveQuery
     */
    public function getAuthorUser(): ActiveQuery
    {
        return $this->hasOne(Users::class, ['id' => 'author']);
    }
}
