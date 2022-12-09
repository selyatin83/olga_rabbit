<?php

namespace omarinina\application\services\category;

use omarinina\application\services\category\interfaces\AdCategoriesAddInterface;
use omarinina\domain\models\ads\AdsToCategories;
use Yii;

class AdCategoriesAddService implements AdCategoriesAddInterface
{
    /**
     * @param array $categories
     * @param int $adId
     * @return bool
     * @throws \Throwable
     */
    public function addAdCategories(array $categories, int $adId): bool
    {
        Yii::$app->db->transaction(function () use ($categories, $adId) {
            foreach ($categories as $category) {
                $newAdCategory = new AdsToCategories();
                $newAdCategory->categoryId = $category;
                $newAdCategory->adId = $adId;
                $newAdCategory->save(false);
            }
        });

        return true;
    }
}