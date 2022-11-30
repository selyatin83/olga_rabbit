<?php

declare(strict_types=1);

namespace omarinina\domain\models\ads;

use yii\base\InvalidConfigException;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use omarinina\domain\models\Users;

/**
 * This is the model class for table "ads".
 *
 * @property int $id
 * @property string $name
 * @property string $imageSrc
 * @property int $typeId
 * @property string $description
 * @property int $author
 * @property string $email
 * @property string $createAt
 *
 * @property AdsToCategories[] $adsToCategories
 * @property Users $authorUser
 * @property Comments[] $comments
 * @property AdTypes $type
 * @property AdCategories[] $adCategories
 */
class Ads extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'ads';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name', 'imageSrc', 'typeId', 'description', 'author', 'email'], 'required'],
            [['imageSrc', 'description'], 'string'],
            [['typeId', 'author'], 'integer'],
            [['createAt'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 50],
            [['author'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['author' => 'id']],
            [['typeId'], 'exist', 'skipOnError' => true, 'targetClass' => AdTypes::class, 'targetAttribute' => ['typeId' => 'id']],
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
            'imageSrc' => 'Image Src',
            'typeId' => 'Type ID',
            'description' => 'Description',
            'author' => 'Author',
            'email' => 'Email',
            'createAt' => 'Create At',
        ];
    }

    /**
     * Gets query for [[AdsToCategories]].
     *
     * @return ActiveQuery
     */
    public function getAdsToCategories(): ActiveQuery
    {
        return $this->hasMany(AdsToCategories::class, ['adId' => 'id']);
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

    /**
     * Gets query for [[Comments]].
     *
     * @return ActiveQuery
     */
    public function getComments(): ActiveQuery
    {
        return $this->hasMany(Comments::class, ['adId' => 'id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return ActiveQuery
     */
    public function getType(): ActiveQuery
    {
        return $this->hasOne(AdTypes::class, ['id' => 'typeId']);
    }

    /**
     * Gets query for [[AdCategories]].
     *
     * @return ActiveQuery
     * @throws InvalidConfigException
     */
    public function getAdCategories(): ActiveQuery
    {
        return $this->hasMany(AdCategories::class, ['id' => 'categoryId'])
            ->viaTable('adsToCategories', ['adId' => 'id']);
    }
}
