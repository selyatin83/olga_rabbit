<?php

namespace omarinina\application\factories\user\dto;

use omarinina\infrastructure\models\forms\RegistrationForm;

class NewUserDto
{
    public function __construct(public readonly RegistrationForm $form)
    {
    }
}