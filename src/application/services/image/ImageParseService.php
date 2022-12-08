<?php

declare(strict_types=1);

namespace omarinina\application\services\image;

use omarinina\application\services\image\interfaces\ImageParseInterface;
use omarinina\infrastructure\constants\PathConstants;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use Yii;

class ImageParseService implements ImageParseInterface
{
    public function parseAvatar(UploadedFile $avatar): string
    {
        $name = uniqid('upload', true) . '.' . $avatar->getExtension();
        $uploadPath = Yii::getAlias('@webroot') . PathConstants::PATH_AVATAR;

        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $avatar->saveAs('@webroot' . PathConstants::PATH_AVATAR . $name);

        return PathConstants::PATH_AVATAR . $name;
    }
}