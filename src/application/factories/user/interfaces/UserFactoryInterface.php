<?php

declare(strict_types=1);

namespace omarinina\application\factories\user\interfaces;

use omarinina\domain\models\Users;
use omarinina\application\factories\user\dto\NewUserDto;

interface UserFactoryInterface
{
    public function createNewUser(NewUserDto $dto): Users;
}