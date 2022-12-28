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

    public function parseVkAvatar(string $urlAvatarVk): string
    {
        $url = $urlAvatarVk;
        $fileName = Yii::$app->params['pathAvatar'] . uniqid('upload', true) . '.' . 'jpg';

        $uploadPath = Yii::getAlias('@webroot') . Yii::$app->params['pathAvatar'];

        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $fullPath = Yii::getAlias('@webroot') . $fileName;
        file_put_contents($fullPath, file_get_contents($url));

        return $fileName;
    }
}