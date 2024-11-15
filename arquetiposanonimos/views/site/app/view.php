<?php

// pegar imagens do arquetiposanonimos/web/file_contents/boas-vindas/comece-aqui/0001.jpg, 0022.jpg, 0033.jpg


$file_name = str_replace('_', '/', $file_name);
// verificar se termina com /
if (substr($file_name, -1) !== '/') {
    $file_name .= '/';
}

// $dir = \Yii::getAlias('@app') . '/web/file_contents/boas-vindas/comece-aqui/';
$dir = \Yii::getAlias('@app') . '/web/file_contents/' . $file_name;
$files = scandir($dir);
$files = array_splice($files, 2);


?>


<!-- swiper slide -->
<div class="p-0">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <?php foreach ($files as $file): ?>
                <div class="swiper-slide">
                    <img src="/file_contents/boas-vindas/comece-aqui/<?= $file ?>" alt="<?= $file ?>" style="object-fit: contain;">
                </div>
            <?php endforeach; ?>
        </div>
        <div class="swiper-pagination"></div>
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
        loop: true, // Loop infinito para os slides
        autoplay: {
            delay: 3000, // Intervalo de 3 segundos entre os slides
        },
    });
</script>
