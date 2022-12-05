<?php

declare(strict_types=1);

namespace app\controllers;

use omarinina\application\factories\user\dto\NewUserDto;
use omarinina\application\factories\user\interfaces\UserFactoryInterface;
use omarinina\infrastructure\models\forms\RegistrationForm;
use yii\web\Controller;
use Yii;
use yii\web\Response;

class RegisterController extends Controller
{
    /** @var UserFactoryInterface */
    private UserFactoryInterface $userFactory;

    public function __construct(
        $id,
        $module,
        UserFactoryInterface $userFactory,
        $config = []
    ) {
        $this->userFactory = $userFactory;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex(): string|Response
    {
        $registrationForm = new RegistrationForm();

        if (Yii::$app->request->getIsPost()) {
            $registrationForm->load(Yii::$app->request->post());

            if ($registrationForm->validate()) {
                $this->userFactory->createNewUser(new NewUserDto($registrationForm));
                return $this->redirect(['site/login']);
            }
        }

        return $this->render('index', ['model' => $registrationForm]);
    }
}