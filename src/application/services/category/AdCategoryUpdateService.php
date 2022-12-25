<?php

declare(strict_types=1);

namespace omarinina\application\services\category;

use omarinina\application\services\category\interfaces\AdCategoryUpdateInterface;
use omarinina\domain\models\ads\Ads;
use omarinina\domain\models\ads\AdsToCategories;
use Yii;

class AdCategoryUpdateService implements AdCategoryUpdateInterface
{

    public function updateAdCategories(Ads $ad, ?array $categories = null): void
    {
        if ($categories) {
            $currentAdCategories = array_map(
                static function ($adCategory) {
                    return $adCategory->categoryId;
                },
                $ad->adsToCategories
            );

            $outdatedCategories = array_diff($currentAdCategories, $categories);
            $updatedCategories = array_diff($categories, $currentAdCategories);
            $adId = $ad->id;

            if ($outdatedCategories) {
                Yii::$app->db->transaction(function () use ($outdatedCategories, $adId) {
                    foreach ($outdatedCategories as $categoryId) {
                        /** @var AdsToCategories $category */
                        $category = AdsToCategories::find()
                            ->where(['categoryId' => $categoryId])
                            ->andWhere(['adId' => $adId])
                            ->one();
                        $category->deleteCategory();
                    }
                });
            }

            if ($updatedCategories) {
                Yii::$app->db->transaction(function () use ($updatedCategories, $adId) {
                    foreach ($updatedCategories as $categoryId) {
                        $newExecutorCategory = new AdsToCategories();
                        $newExecutorCategory->categoryId = (int)$categoryId;
                        $newExecutorCategory->adId = $adId;
                        $newExecutorCategory->save(false);
                    }
                });
            }
        }
    }
}