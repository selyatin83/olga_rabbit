<?php

declare(strict_types=1);

namespace omarinina\application\services\image;

use omarinina\application\services\image\interfaces\ImageSaveInterface;
use omarinina\domain\models\ads\Images;
use yii\web\ServerErrorHttpException;

class ImageSaveService implements ImageSaveInterface
{
    /**
     * @param string $imageSrc
     * @return int
     * @throws ServerErrorHttpException
     */
    public function saveNewImage(string $imageSrc): int
    {
        $newImage = new Images();
        $newImage->imageSrc = $imageSrc;

        if (!$newImage->save(false)) {
            throw new ServerErrorHttpException(
                'Your data has not been recorded, please try again later',
                500
            );
        }

        return $newImage->id;
    }
}