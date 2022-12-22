<?php

declare(strict_types=1);

namespace app\controllers;

use omarinina\application\factories\ad\dto\NewAdDto;
use omarinina\application\factories\ad\dto\NewCommentDto;
use omarinina\application\factories\ad\interfaces\AdFactoryInterface;
use omarinina\application\factories\ad\interfaces\CommentFactoryInterface;
use omarinina\application\services\ad\interfaces\FilterAdsGetInterface;
use omarinina\domain\models\ads\AdCategories;
use omarinina\domain\models\ads\Ads;
use omarinina\domain\models\ads\AdTypes;
use omarinina\infrastructure\models\forms\AdCreateForm;
use omarinina\infrastructure\models\forms\CommentCreateForm;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

class OffersController extends Controller
{
    /** @var AdFactoryInterface */
    private AdFactoryInterface $adFactory;

    /** @var CommentFactoryInterface  */
    private CommentFactoryInterface $commentFactory;

    /** @var FilterAdsGetInterface */
    private FilterAdsGetInterface $filterAds;

    public function __construct(
        $id,
        $module,
        AdFactoryInterface $adFactory,
        CommentFactoryInterface $commentFactory,
        FilterAdsGetInterface $filterAds,
        $config = []
    ) {
        $this->adFactory = $adFactory;
        $this->commentFactory = $commentFactory;
        $this->filterAds = $filterAds;
        parent::__construct($id, $module, $config);
    }

    public function init(): void
    {
        parent::init();
        Yii::$app->user->loginUrl = ['login/index'];
    }

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['add'],
                'rules' => [
                    [
                        'actions' => ['add'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
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

    /**
     * @param int $id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionView(int $id): string|Response
    {
        $currentAd = Ads::findOne($id);

        if (!$currentAd) {
            throw new NotFoundHttpException('Task is not found', 404);
        }

        $commentForm = new CommentCreateForm();
        $currentUser = Yii::$app->user->id;

        if (Yii::$app->request->getIsPost()) {
            $commentForm->load(Yii::$app->request->post());
            if ($commentForm->validate()) {
                $this->commentFactory->createNewComment(new NewCommentDto(
                    $commentForm,
                    $currentUser,
                    $id
                ));
                return $this->redirect(['view', 'id' => $id]);
            }
        }

        return $this->render('view', [
            'currentAd' => $currentAd,
            'model' => $commentForm
        ]);
    }

    public function actionCategory(int $categoryId)
    {
        $currentCategory = AdCategories::findOne($categoryId);

        if (!$currentCategory) {
            throw new NotFoundHttpException('Category is not found', 404);
        }

        $categories = AdCategories::find()->joinWith(['adsToCategories'])->where(['not', ['adId' => null]])->all();
        $categoryAds = $this->filterAds->getCategoryAds($categoryId);

        $pagination = new Pagination([
            'totalCount' => $categoryAds->count(),
            'pageSize' => Yii::$app->params['categoryAdsOnPage'],
            'forcePageParam' => false,
            'pageSizeParam' => false
        ]);

        $categoryAdsWithPagination = $categoryAds->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();


        return $this->render('category', [
            'categories' => $categories,
            'categoryAds' => $categoryAdsWithPagination,
            'currentCategory' => $currentCategory,
            'pagination' => $pagination
        ]);
    }
}