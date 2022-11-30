<?php

declare(strict_types=1);

namespace omarinina\domain\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use omarinina\domain\models\ads\Ads;
use omarinina\domain\models\ads\Comments;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $name
 * @property string $lastName
 * @property string $email
 * @property string $password
 * @property string $avatarSrc
 * @property int|null $vkId
 *
 * @property Ads[] $ads
 * @property Comments[] $comments
 */
class Users extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name', 'lastName', 'email', 'password', 'avatarSrc'], 'required'],
            [['avatarSrc'], 'string'],
            [['vkId'], 'integer'],
            [['name', 'lastName', 'email'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 60],
            [['email'], 'unique'],
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
            'lastName' => 'Last Name',
            'email' => 'Email',
            'password' => 'Password',
            'avatarSrc' => 'Avatar Src',
            'vkId' => 'Vk ID',
        ];
    }

    /**
     * Gets query for [[Ads]].
     *
     * @return ActiveQuery
     */
    public function getAds(): ActiveQuery
    {
        return $this->hasMany(Ads::class, ['author' => 'id']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return ActiveQuery
     */
    public function getComments(): ActiveQuery
    {
        return $this->hasMany(Comments::class, ['author' => 'id']);
    }
}
