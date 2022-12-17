<?php

namespace omarinina\application\services\ad\interfaces;

interface FilterAdsGetInterface
{
    public function getNewAds(): array;
    public function getPopularAds(): array;
    public function getSearchedAds(string $search): ?array;
    public function getCategoryAds(int $categoryId): ?array;
}