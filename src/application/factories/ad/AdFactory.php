<?php

namespace omarinina\application\factories\ad;

use omarinina\application\factories\ad\dto\NewAdDto;
use omarinina\application\factories\ad\interfaces\AdFactoryInterface;
use omarinina\application\services\category\interfaces\AdCategoriesAddInterface;
use omarinina\application\services\image\interfaces\AdImageAddInterface;
use omarinina\application\services\image\interfaces\ImageParseInterface;
use omarinina\application\services\image\interfaces\ImageSaveInterface;
use omarinina\domain\models\ads\Ads;
use omarinina\domain\models\ads\Images;
use omarinina\domain\models\Users;
use Yii;
use yii\web\ServerErrorHttpException;

class AdFactory implements AdFactoryInterface
{
    /**
     * @param NewAdDto $dto
     * @return Ads
     * @throws ServerErrorHttpException
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function createNewAd(NewAdDto $dto): Ads
    {
        $imageParse = Yii::$container->get(ImageParseInterface::class);
        $imageSave = Yii::$container->get(ImageSaveInterface::class);
        $adCategoriesAdd = Yii::$container->get(AdCategoriesAddInterface::class);
        $adImagesAdd = Yii::$container->get(AdImageAddInterface::class);

        foreach ($dto->form->images as $image) {
            $imageSrc = $imageParse->parseImage($image, false);
            $images[] = $imageSave->saveNewImage($imageSrc);
        }

        $newAd = new Ads();
        $newAd->attributes = $dto->form->getAttributes();
        $newAd->email = mb_strtolower($dto->form->email);
        $newAd->author = $dto->author;

        if (!$newAd->save(false)) {
            throw new ServerErrorHttpException(
                'Your data has not been recorded, please try again later',
                500
            );
        }

        if (!$adCategoriesAdd->addAdCategories($dto->form->categories, $newAd->id)) {
            throw new ServerErrorHttpException(
                'Your data has not been recorded, please try again later',
                500
            );
        }

        if (!$adImagesAdd->addAdImages($images, $newAd->id)) {
            throw new ServerErrorHttpException(
                'Your data has not been recorded, please try again later',
                500
            );
        }

        return $newAd;
    }
}