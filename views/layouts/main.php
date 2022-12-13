<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\MainAsset;
use omarinina\domain\models\Users;
use yii\bootstrap5\Html;
use yii\widgets\Menu;
use yii\helpers\Url;

/** @var Users $currentUser */
$currentUser = Yii::$app->user->identity;

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
<html lang="<?= Yii::$app->sourceLanguage ?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<header class="header header--logged">
    <div class="header__wrapper">
        <a class="header__logo logo" href="<?= Url::to(['/']) ?>">
            <img src="/img/logo.svg" width="179" height="34" alt="Логотип Куплю Продам">
        </a>
        <?php if (!Yii::$app->user->isGuest) : ?>
            <nav class="header__user-menu">
            <?php
            echo Menu::widget([
                'items' => [
                    ['label' => 'Публикации', 'url' => ['/html/my-tickets.html']],
                    ['label' => 'Комментарии', 'url' => ['/html/comments.html']],
                ],
                'options' => [
                    'class' => 'header__list'
                ],
                'itemOptions' => [
                    'class' => 'header__item'
                ],
                'linkTemplate' => '<a href="{url}">{label}</a>',
                'activeCssClass' => 'header__item--active'
            ])
            ?>
        </nav>
        <?php endif; ?>
        <form class="search" method="get" action="#" autocomplete="off">
            <input type="search" name="query" placeholder="Поиск" aria-label="Поиск">
            <div class="search__icon"></div>
            <div class="search__close-btn"></div>
        </form>
        <?php if (!Yii::$app->user->isGuest) : ?>
            <a class="header__avatar avatar" href="#">
                <img src="<?= $currentUser->avatarSrc ?>" srcset="<?= $currentUser->avatarSrc ?> 2x" alt="Аватар пользователя">
            </a>
        <?php endif; ?>
        <?php if (Yii::$app->user->isGuest) : ?>
        <?php
            echo Html::a('Вход и регистрация', 'register/index', ['class'=>'header__input', 'style' => 'display:flex']);
        ?>
        <?php endif; ?>
    </div>

</header>

<main class="page-content">
    <?= $content ?>
</main>

<footer class="page-footer">
    <div class="page-footer__wrapper">
        <div class="page-footer__col">
            <a href="https://htmlacademy.ru/" target="_blank" class="page-footer__logo-academy" aria-label="Ссылка на сайт HTML-Академии">
                <svg width="132" height="46">
                    <use xlink:href="img/sprite_auto.svg#logo-htmlac"></use>
                </svg>
            </a>
            <p class="page-footer__copyright">© 2019 Проект Академии</p>
        </div>
        <div class="page-footer__col">
            <a href="#" class="page-footer__logo logo">
                <img src="/img/logo.svg" width="179" height="35" alt="Логотип Куплю Продам">
            </a>
        </div>
        <div class="page-footer__col">
            <?php echo Menu::widget([
                'items' => [
                    ['label' => 'Вход и регистрация', 'url' => ['register/index']],
                    ['label' => 'Создать объявление', 'url' => ['offers/add']],
                ],
                'options' => [
                    'class' => 'page-footer__nav'
                ],
                'linkTemplate' => '<a href="{url}">{label}</a>',
                'activeCssClass' => 'header__item--active'
            ]) ?>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
