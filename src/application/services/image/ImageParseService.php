<?php

declare(strict_types=1);

namespace omarinina\application\services\image;

use omarinina\application\services\image\interfaces\ImageParseInterface;
use yii\web\UploadedFile;
use Yii;

class ImageParseService implements ImageParseInterface
{
    public function parseImage(UploadedFile $image, bool $isAvatar): string
    {
        $name = uniqid('upload', true) . '.' . $image->getExtension();

        $uploadPartPath = $isAvatar ? Yii::$app->params['pathAvatar'] : Yii::$app->params['pathImage'];
        $uploadFullPath = Yii::getAlias('@webroot') . $uploadPartPath;


        if (!file_exists($uploadFullPath)) {
            mkdir($uploadFullPath, 0777, true);
        }

        $image->saveAs('@webroot' . $uploadPartPath . $name);

        return $uploadPartPath . $name;
    }
}