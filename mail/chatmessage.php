<?php

/** @var yii\web\View $this */
/* @var \yii\mail\BaseMessage $message */
/** @var Ads $currentAd */
/** @var Users $sender */
/** @var string $time */
/** @var string $message */

use omarinina\domain\models\ads\Ads;
use omarinina\domain\models\Users;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<h2>У вас новое непрочитанное сообщение к объявлению "<?= $currentAd->name ?>"</h2>

<p>
    Отправитель: <?= $sender->name . ' ' . $sender->lastName ?>; <br>
    Время отправления: <?= Yii::$app->formatter->asDate($time, 'dd MMMM, HH:mm') ?>; <br>
    Сообщение: <?= $message ?>
</p>

<?= Html::a('Перейти к объявлению', Url::to(['offers/view', 'id' => $currentAd->id], 'http')) ?>
