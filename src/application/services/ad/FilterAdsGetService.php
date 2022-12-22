<?php

namespace omarinina\application\services\ad;

use omarinina\application\services\ad\interfaces\FilterAdsGetInterface;
use omarinina\domain\models\ads\AdCategories;
use omarinina\domain\models\ads\Ads;
use Yii;
use yii\data\Pagination;
use yii\db\ActiveQuery;
use yii\sphinx\Query;
use yii\web\NotFoundHttpException;

class FilterAdsGetService implements FilterAdsGetInterface
{

    public function getNewAds(): array
    {
        return Ads::find()->orderBy('createAt DESC')->limit(8)->all();
    }

    public function getPopularAds(): array
    {
        return Ads::find()
            ->joinWith(['comments'])
            ->select(['ads.*', 'COUNT(comments.id) AS commentsCount'])
            ->groupBy(['ads.id'])
            ->orderBy(['commentsCount' => SORT_DESC])
            ->limit(8)
            ->all();
    }

    public function getSearchedAds(string $search): ?array
    {
        $query = new Query();
        return $query->from('idx_ads')
            ->match($search)
            ->all();
    }

    /**
     * @param int $categoryId
     * @return ActiveQuery
     */
    public function getCategoryAds(int $categoryId): ActiveQuery
    {
        return Ads::find()
            ->joinWith('adsToCategories')
            ->where(['categoryId' => $categoryId])
            ->orderBy('createAt DESC');
    }
}
