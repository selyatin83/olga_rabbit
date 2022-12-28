<?php

declare(strict_types=1);

use yii\authclient\clients\VKontakte;
use yii\authclient\Collection;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var Collection $collectionClientsOAuth */
$collectionClientsOAuth = Yii::$app->get('authClientCollection');

/** @var VKontakte $vkClientOAuth */
$vkClientOAuth = $collectionClientsOAuth->getClient('vkontakte');

$urlVkAuth = $vkClientOAuth->buildAuthUrl([
    'redirect_uri' => Url::to(['auth/authorize-user-via-vk'], 'http'),
    'response_type' => 'code',
    'scope' => 'email, offline'
]);

echo Html::a(
    'Войти через <span class="icon icon--vk"></span>',
    $urlVkAuth,
    ['class'=>'btn btn--small btn--flex btn--white']
);
