<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use yii\bootstrap5\Html;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    <style>
        body {
            background-color: #141414;
            color: #fff;
        }

        .navbar {
            background-color: #181818;
        }

        .card {
            background-color: #222;
            border: none;
        }

        .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

</head>

<body>



    <?php $this->beginBody() ?>

    <nav class="navbar  navbar-dark p-3 d-flex justify-content-between">
        <a class="navbar-brand" href="/app">Arquetipos Anónimos</a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/app">Home</a></li>

            </ul>
        </div>
    </nav>

    <div class="container-fluid mt-4">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= \yii\widgets\Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= $content ?>
        <?= \yii\bootstrap5\Alert::widget() ?>

    </div>

    <footer class="text-center mt-5 py-4">
        <p>&copy; <?= date('Y') ?> Netflix Clone. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
</body>

</html>
<?php $this->endPage() ?>