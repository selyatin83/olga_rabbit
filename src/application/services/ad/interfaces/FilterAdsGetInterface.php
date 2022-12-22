<?php

namespace omarinina\application\services\ad\interfaces;

use yii\db\ActiveQuery;

interface FilterAdsGetInterface
{
    public function getNewAds(): array;
    public function getPopularAds(): array;
    public function getSearchedAds(string $search): ?array;
    public function getCategoryAds(int $categoryId): ActiveQuery;
}