<?php

declare(strict_types=1);

namespace omarinina\application\services\image;

use omarinina\application\services\image\interfaces\AdImageAddInterface;
use omarinina\domain\models\ads\AdsToImages;
use omarinina\domain\models\ads\Images;
use Yii;

class AdImageAddService implements AdImageAddInterface
{
    /**
     * @param Images[] $images
     * @param int $adId
     * @return bool
     * @throws \Throwable
     */
    public function addAdImages(array $images, int $adId): bool
    {
        Yii::$app->db->transaction(function () use ($images, $adId) {
            foreach ($images as $image) {
                $newAdImage = new AdsToImages;
                $newAdImage->imageId = $image;
                $newAdImage->adId = $adId;
                $newAdImage->save(false);
            }
        });

        return true;
    }
}