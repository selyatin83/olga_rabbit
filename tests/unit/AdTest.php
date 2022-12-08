<?php

declare(strict_types=1);

namespace unit;

use Codeception\Verify\Verify;
use Mockery;
use omarinina\domain\models\ads\Ads;
use omarinina\domain\models\ads\AdsToCategories;
use omarinina\domain\models\ads\Comments;

class AdTest extends \Codeception\Test\Unit
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

    /**
     * @throws \Exception
     */
    public function testFilterNewAds(): void
    {
        $allAds = $this->make(Ads::class, [
            [
                'name' => 'Really big bed',
                'imageSrc' => '/img/blank.jpg',
                'typeId' => 1,
                'description' => 'Something what descriptions this product as something interesting and important',
                'author' => 1,
                'email' => 'example@mail.ru',
                'createAt' => '2022-11-30 15:55:27'
            ],
            [
                'name' => 'Refrigerator',
                'imageSrc' => '/img/blank.jpg',
                'typeId' => 1,
                'description' => 'Something what descriptions this product as something interesting and important',
                'author' => 2,
                'email' => 'example@mail.ru',
                'createAt' => '2022-12-01 15:55:27'
            ],
            [
                'name' => 'Some special apples',
                'imageSrc' => '/img/blank.jpg',
                'typeId' => 2,
                'description' => 'Something what descriptions this product as something interesting and important',
                'author' => 3,
                'email' => 'example@mail.ru',
                'createAt' => '2022-12-02 15:55:27'
            ],
            [
                'name' => 'Warm jacket',
                'imageSrc' => '/img/blank.jpg',
                'typeId' => 1,
                'description' => 'Something what descriptions this product as something interesting and important',
                'author' => 3,
                'email' => 'example@mail.ru',
                'createAt' => '2022-12-03 15:55:27'
            ]
        ]);

        $allNewAds = $allAds->getNewAds;
        $this->assertEquals('2022-12-03 15:55:27', array_shift($allNewAds)['createAt']);
        $this->assertEquals('2022-11-30 15:55:27', array_pop($allNewAds)['createAt']);
    }

    public function testCreateNewAd(): void
    {
        $adDto = Mockery::mock('AdDto');
        $adDto->shouldReceive('name', 'imageSrc', 'typeId', 'description', 'author', 'email')
            ->once()
            ->andReturn(
                'Really big bed',
                '/img/blank.jpg',
                1,
                'Something what descriptions this product as something interesting and important',
                1,
                'example@mail.ru',
            );

        $categories = $this->make(CreateAdForm::class, ['categories' => [1, 3, 6,]]);
//        $categories = Mockery::mock('CreateAdForm');
//        $categories->shouldReceive('categories')
//            ->once()
//            ->andReturn([1, 3, 6]);

        $newAd = (new AdCreateService())->createNewAd($adDto, $categories);

        $this->assertEquals('Really big bed', $newAd->name);
        $this->assertEquals($categories, $newAd->adsCategories);
    }

    /**
     * @throws \Exception
     */
    public function testUpdateAd(): void
    {
        $adDto = Mockery::mock('AdDto');
        $adDto->shouldReceive('name', 'imageSrc', 'typeId', 'description', 'author', 'email')
            ->once()
            ->andReturn(
                'Really big bed',
                '/img/blank.jpg',
                1,
                'Something what descriptions this product as something interesting and important',
                3,
                'example@mail.ru',
            );

        $ad = $this->make(Ads::class, [
            'id' => 1,
            'name' => 'Warm jacket',
            'imageSrc' => '/img/blank.jpg',
            'typeId' => 1,
            'description' => 'Something what descriptions this product as something interesting and important',
            'author' => 3,
            'email' => 'example@mail.ru',
        ]);

        $this->make(AdsToCategories::class, [
            [
                'adId' => 1,
                'categoryId' => 1
            ],
            [
                'adId' => 1,
                'categoryId' => 3
            ],
            [
                'adId' => 1,
                'categoryId' => 6
            ],
        ]);

        $newCategories = Mockery::mock('CreateAdForm');
        $newCategories->shouldReceive('categories')
            ->once()
            ->andReturn([1, 3]);

        $updateAd = $ad->updateAd($adDto, $newCategories);

        $this->assertEquals('Really big bed', $updateAd->name);
        Verify::Array($updateAd->getAdCategories())
            ->contains(1)
            ->contains(3)
            ->notContains(6);
    }

    /**
     * @throws \Exception
     */
    public function testDeleteAd(): void
    {
        $deletedAd = $this->make(Ads::class, [
            'id' => 2,
            'name' => 'Refrigerator',
            'imageSrc' => '/img/blank.jpg',
            'typeId' => 1,
            'description' => 'Something what descriptions this product as something interesting and important',
            'author' => 2,
            'email' => 'example@mail.ru',
            'createAt' => '2022-12-01 15:55:27'
        ]);

        $this->make(Comments::class, [
            [
                'author' => 1,
                'adId' => 2,
                'text' => 'Do you know that it is cheaper in the shop?',
                'createAt' => '2022-11-30 15:55:54'
            ],
            [
                'author' => 2,
                'adId' => 2,
                'text' => 'I have craft product so you can never buy the same product',
                'createAt' => '2022-11-30 16:55:54'
            ],
            [
                'author' => 1,
                'adId' => 2,
                'text' => 'Ok, please send me what differences you have',
                'createAt' => '2022-11-30 17:55:54'
            ],
            [
                'author' => 2,
                'adId' => 2,
                'text' => 'Yes, of course. Write me on my mail',
                'createAt' => '2022-11-30 18:55:54'
            ]
        ]);

        $this->make(AdsToCategories::class, [
            [
                [
                    'adId' => 2,
                    'categoryId' => 1
                ],
                [
                    'adId' => 2,
                    'categoryId' => 3
                ],
                [
                    'adId' => 2,
                    'categoryId' => 6
                ],
            ]
        ]);

        $deletedAd->deleteAd();

        verify(Ads::findOne(2))->null();
        verify(Comments::find()->where(['adId' => 2]))->null();
        verify(AdsToCategories::find()->where(['adId' => 2]))->null();
    }
}