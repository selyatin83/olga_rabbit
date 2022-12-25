<?php

declare(strict_types=1);

namespace omarinina\application\services\category\interfaces;

use omarinina\domain\models\ads\Ads;

interface AdCategoryUpdateInterface
{
    /**
     * @param Ads $ad
     * @param array|null $categories
     * @return void
     */
    public function updateAdCategories(Ads $ad, ?array $categories = null) : void;
}