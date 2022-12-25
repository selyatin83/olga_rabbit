<?php

declare(strict_types=1);

namespace app\controllers;

use omarinina\domain\models\ads\Ads;
use omarinina\domain\models\Users;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class MyController extends SecurityController
{
    public function behaviors(): array
    {
        $rules = parent::behaviors();
        $rule = [
            'allow' => false,
            'actions' => ['delete'],
            'matchCallback' => function () {
                $currentUser = Yii::$app->user->id;
                $adUser = $this->findModel(Yii::$app->request->get('id'))->author;
                return $currentUser === $adUser;
            }
        ];
        array_unshift($rules['access']['rules'], $rule);
        return $rules;
    }

    /**
     * @param $id
     * @return Ads
     * @throws NotFoundHttpException
     */
    protected function findModel($id): Ads
    {
        /** @var Ads $model */
        $model = Ads::find()
            ->where(['id' => $id])
            ->with('images', 'adsToCategories', 'adsToImages', 'comments')
            ->one();

        if ($model === null) {
            throw new NotFoundHttpException('The requested page does not exist.', 404);
        }

        return $model;
    }


    public function actionIndex()
    {
        /** @var Users $user */
        $user = Yii::$app->user->identity;
        $userAds = $user->getAds()->orderBy('createAt DESC')->all();

        return $this->render('index', [
           'userAds' => $userAds
        ]);
    }

    /**
     * @param int $id
     * @return Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete(int $id): Response
    {
        $deletedAd = $this->findModel($id);

        $deletedAd->deleteAd();

        return $this->redirect('index');
    }
}
