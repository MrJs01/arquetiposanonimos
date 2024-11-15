<?php

// pegar imagens do arquetiposanonimos/web/file_contents/boas-vindas/comece-aqui/0001.jpg, 0022.jpg, 0033.jpg


$model = \app\models\Films::find()->where(['slug' => $slug])->one();
$files = explode(',', $model->files);


?>

<h1 class="text-center mt-3"> <?= $model->title ?> </h1>

<p class="text-center"> <?= $model->description ?> </p>


<!-- swiper slide -->
<div class="p-0">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <?php foreach ($files as $file): ?>
                <div class="swiper-slide">
                    <img src="/<?= $file ?>" alt="<?= $file ?>" style="object-fit: contain;">
                </div>
            <?php endforeach; ?>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>

<style>
    /* Ajustando o Swiper para ocupar a tela inteira */
    .swiper {
        width: 100%;
        height: 85vh; /* 100% da altura da tela */
    }

    .swiper-slide img {
        width: 100%; /* Garantir que as imagens ocupem toda a largura */
        height: 100%; /* Garantir que as imagens ocupem toda a altura */
    }

    .container-fluid {
        padding: 0; /* Remover margens e padding */
    }
</style>

<script>
    var swiper = new Swiper(".mySwiper", {
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
   
    });
</script>
