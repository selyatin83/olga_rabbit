<?php

declare(strict_types=1);

namespace app\controllers;

use omarinina\application\factories\ad\dto\NewAdDto;
use omarinina\application\factories\ad\interfaces\AdFactoryInterface;
use omarinina\domain\models\ads\AdCategories;
use omarinina\domain\models\ads\AdTypes;
use omarinina\infrastructure\models\forms\AdCreateForm;
use Yii;
use yii\web\Response;
use yii\web\UploadedFile;

class OffersController extends SecurityController
{
    /** @var AdFactoryInterface */
    private AdFactoryInterface $adFactory;

    public function __construct(
        $id,
        $module,
        AdFactoryInterface $adFactory,
        $config = []
    ) {
        $this->adFactory = $adFactory;
        parent::__construct($id, $module, $config);
    }

    /**
     * @return string|Response
     */
    public function actionAdd(): Response|string
    {
        $categories = AdCategories::find()->all();
        $types = AdTypes::find()->all();
        $adCreateForm = new AdCreateForm();
        $author = Yii::$app->user->id;

        if (Yii::$app->request->getIsPost()) {
            $adCreateForm->load(Yii::$app->request->post());
            $adCreateForm->images = UploadedFile::getInstances($adCreateForm, 'images');

            if ($adCreateForm->validate()) {
                $this->adFactory->createNewAd(new NewAdDto($adCreateForm, $author));
                return $this->goHome();
            }
        }

        return $this->render('add', [
            'model' => $adCreateForm,
            'categories' => $categories,
            'types' => $types
        ]);
    }
}