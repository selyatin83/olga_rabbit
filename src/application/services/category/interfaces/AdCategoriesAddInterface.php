<?php

declare(strict_types=1);

namespace omarinina\application\services\category\interfaces;

interface AdCategoriesAddInterface
{
    public function addAdCategories(array $categories, int $adId): void;
}