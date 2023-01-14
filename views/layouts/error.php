<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\MainAsset;
use yii\helpers\Html;

MainAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0']);
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Доска объявлений — современный веб-сайт, упрощающий продажу или покупку абсолютно любых вещей.']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/img/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->sourceLanguage ?>" class="html-not-found">
<head>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= Html::encode(Yii::$app->params['title']) ?></title>
    <?php $this->head() ?>
</head>
<body class="body-not-found">
<?php $this->beginBody() ?>

<main>
    <?= $content ?>
</main>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

