<?php

declare(strict_types=1);

namespace unit;

use Mockery;
use omarinina\application\factories\user\dto\NewUserDto;
use omarinina\application\factories\user\UserFactory;
use omarinina\application\services\image\interfaces\ImageParseInterface;
use omarinina\domain\models\Users;
use omarinina\infrastructure\models\forms\RegistrationForm;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class UserTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected \UnitTester $tester;
    
    protected function _before(): void
    {
    }

    protected function _after(): void
    {
    }

    public function tearDown(): void
    {
        Mockery::close();
    }

    // tests
    public function testCreateNewUser(): void
    {
        $form = new RegistrationForm();
        $form->name = 'Mile';
        $form->lastName = 'Doe';
        $form->email = 'M.doe@google.com';
        $form->password = '123456';
        $form->avatar = $this->make(UploadedFile::class);
        $dto = new NewUserDto($form);
        $imageParse = Yii::$container->get(ImageParseInterface::class);
        Mockery::mock($imageParse)
            ->shouldReceive('parseAvatar')
            ->with($dto->form->avatar)
            ->once()
            ->andReturn('/uploads/avatars/upload639002f3191f72.13517754.png');

        $newUser = (new UserFactory())->createNewUser($dto);
        $this->assertEquals('Mile', $newUser->name);
        $this->assertEquals('m.doe@google.com', $newUser->email);
    }

    /**
     * @throws \Exception
     */
    public function testAddVkId(): void
    {
        $user = $this->make(Users::class, [
            'name' => 'Mile',
            'lastName' => 'Doe',
            'email' => 'M.doe@google.com',
            'password' => '123456',
            'avatarSrc' => '/img/avatar01.jpg',
        ]);

        $newVkId = '09876543';

        $user->addVkId($newVkId);

        $this->assertEquals('09876543', $user->vkId);
    }

    /**
     * @throws \Exception
     */
    public function testAddVkIdException(): void
    {
        $this->expectException(NotFoundHttpException::class);
        $user = $this->make(Users::class, [
            'name' => 'Mile',
            'lastName' => 'Doe',
            'email' => 'M.doe@google.com',
            'password' => '123456',
            'avatarSrc' => '/img/avatar01.jpg',
            'vkId' => '1245780'
        ]);

        $newVkId = '09876543';

        $user->addVkId($newVkId);
    }

    public function testUpdateUserInfo(): void
    {
    }
}