<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <link rel="stylesheet" href="css/app.css">
    <script src="https://kit.fontawesome.com/da3a01af99.js" crossorigin="anonymous"></script>
</head>

<body id="page-top">
    <?php $this->beginBody() ?>

    <!-- Nav heading -->
    <div class="fixed-div">
        <div class="parent-div">
            <img src="https://github.com/Chinemereem/Netflix-clone/blob/master/images/netflix%20logo.png?raw=true" alt="netflix img" class="logo">
            <div class="dropdown">
                <span class="browse-el">Browse</span>
                <div class="dropdown-content">
                    <p>Home</p>
                    <p><a href='#dramas'>Tv shows</a></p>
                    <p>Movies</p>
                    <p><a href='#top-tv'>News & popular</a></p>
                    <p><a href="#list">My List</a></p>
                </div>
            </div>
        </div>

        <div class="" style="overflow: scroll;">
            <?php if (!empty($this->params['breadcrumbs'])): ?>
                <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
            <?php endif ?>
            <?= Alert::widget() ?>
            <?= $content ?>


        </div>
    </div>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>