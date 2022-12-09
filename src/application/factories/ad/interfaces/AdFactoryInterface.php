<?php

declare(strict_types=1);

namespace omarinina\application\factories\ad\interfaces;

use omarinina\domain\models\ads\Ads;
use omarinina\application\factories\ad\dto\NewAdDto;

interface AdFactoryInterface
{
    public function createNewAd(NewAdDto $dto): Ads;
}