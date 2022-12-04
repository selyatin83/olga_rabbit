<?php

namespace omarinina\infrastructure\models;

use yii\base\Model;
use yii\web\UploadedFile;
use omarinina\domain\models\Users;

class RegistrationFrom extends Model
{
    /** @var string  */
    public string $name = '';

    /** @var string  */
    public string $lastName = '';

    /** @var string  */
    public string $email = '';

    /** @var string  */
    public string $password = '';

    /** @var string  */
    public string $repeatedPassword = '';

    /** @var UploadedFile|null  */
    public ?UploadedFile $avatar = null;

    public function rules(): array
    {
        return [
            [['name', 'lastName', 'email', 'password', 'repeatedPassword', 'avatar'], 'required'],
            [['name', 'lastName'], 'string'],
            [['name', 'lastName'], 'match', 'pattern' => '/^[A-Za-zА-Яа-яЁё]{2,50}$/i'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => Users::class, 'message' => 'Пользователь с таким e-mail уже существует'],
            ['password', 'string', 'min' => 6],
            ['repeatedPassword', 'compare', 'compareAttribute' => 'password'],
            ['avatar', 'file', 'extensions' => 'png, jpg', 'maxSize' => 5 * 1024 * 1024],
        ];
    }
    public function attributeLabels(): array
    {
        return [
            'name' => 'Имя',
            'lastName' => 'Фамилия',
            'email' => 'Эл. почта',
            'password' => 'Пароль',
            'repeatedPassword' => 'Пароль еще раз',
            'avatar' => ''
        ];
    }
}