<?php


Yii::$container->set(
    \omarinina\application\services\image\interfaces\ImageParseInterface::class,
    \omarinina\application\services\image\ImageParseService::class
);

Yii::$container->set(
    \omarinina\application\factories\user\interfaces\UserFactoryInterface::class,
    \omarinina\application\factories\user\UserFactory::class
);
