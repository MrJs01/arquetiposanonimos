<?php

/** @var yii\web\View $this */

$this->title = 'Tipologias Psicológicas';
?>

<!-- Estilos adicionais para personalizar o layout -->
<style>
    body {
        background-color: #141414;
        color: #ffffff;
        transition: all 0.5s;

        /* background gradient blue top black bottom */
        background-image: linear-gradient(to bottom, #141414, #000000);

    }

    /* Carrossel Principal */
    .highlight-card {
        position: relative;
        height: 500px;
        color: #ffffff;
    }

    .highlight-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 8px;
        opacity: 0.4;
    }

    .highlight-content {
        position: absolute;
        top: 30%;
        left: 5%;
        color: #fff;
        z-index: 10;
    }

    .highlight-title {
        font-size: 3rem;
        font-weight: bold;
    }

    .highlight-description {
        font-size: 1.2rem;
        margin: 10px 0;
    }

    .btn-highlight {
        margin-top: 15px;
    }

    /* Carrosséis Menores */
    .card {
        background-color: #1c1c1c;
        color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        transition: transform 0.3s ease;
        position: relative;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .card-body {
        display: none;
        position: absolute;
        bottom: 0;
        background: rgba(0, 0, 0, 0.8);
        width: 100%;
        padding: 10px;
        text-align: center;
        transition: opacity 0.3s ease;
    }

    .card:hover .card-body {
        display: block;
    }

    .swiper {
        margin-bottom: 20px;
    }
</style>

<!-- Carrossel Principal (Destaque) -->
<div class="highlight-card">
    <img id="highlight-img" src="https://placehold.co/1200x500" alt="Destaque">
    <div class="highlight-content">
        <h2 id="highlight-title" class="highlight-title">Título do Destaque</h2>
        <p id="highlight-description" class="highlight-description">Descrição do filme ou série em destaque.</p>
    </div>
</div>

<?php
$films = \app\models\Films::find()->all();


?>


<!-- Três Swipers Menores -->
<div class="container-fluid">
    <h2 class="text-white m-5">Destaque</h2>
    <div class="swiper mySwiper" id="swiper-destaques">
        <div class="swiper-wrapper">
            <?php foreach ($films as $film): // Criando 8 filmes por carrossel 
            ?>
                <div class="swiper-slide" style="width: auto;">
                    <div class="card" onclick="location.href='/app/view/<?= $film['slug'] ?>'" style="width: 500px;">
                        <img src="/<?= $film['img'] ?>" class="card-img-top" alt="Filme" style="object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $film['title'] ?></h5>
                            <p class="card-text"><?= $film['description'] ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>

    <script>
        var swiper_destaques = new Swiper("#swiper-destaques", {
            spaceBetween: 15, // Espaçamento entre os slides
            slidesPerView: 'auto', // Deixa os slides ajustarem o tamanho automaticamente

            // Navegação
            navigation: {
                nextEl: $("#swiper-destaques").find(".swiper-button-next")[0],
                prevEl: $("#swiper-destaques").find(".swiper-button-prev")[0],
            },

            // Ajuste adicional para o alinhamento correto
            centeredSlides: true, // Centraliza os slides
            initialSlide: 1, // Começa no segundo slide
        });
    </script>


</div>

<!-- Swiper.js e configuração -->

<script>
    // Array de filmes em destaque
    const destaques = [{
            title: "Tipologia Psicológica de Carl Jung",
            description: "Uma plataforma dedicada ao estudo da Psicologia Analítica de Carl Jung, abordando arquétipos, tipologias psicológicas e filosofia com conteúdo multimodal (textos, áudios e vídeos).",
            img: "/assets_main/img/wal3.jpeg", // Imagem ilustrativa do projeto
            bgColor: "#1c1c1c"
        },
        {
            title: "IA e Audiobooks",
            description: "Uso de IA para gerar audiobooks a partir de textos, permitindo uma experiência imersiva de aprendizagem e estudo da psicologia analítica.",
            img: "/assets_main/img/wal2.png", // Imagem representando IA ou áudio
            bgColor: "#2b2b2b"
        },
        {
            title: "Conteúdo Interativo",
            description: "Conteúdos interativos como quizzes, fóruns de discussão e artigos multimídia para facilitar o aprendizado de psicologia e filosofia.",
            img: "/assets_main/img/wal1.png", // Imagem de conteúdo interativo
            bgColor: "#3c3c3c"
        },
        {
            title: "Monetização e Acesso Exclusivo",
            description: "Apoio ao projeto por meio de anúncios e planos de membros, oferecendo acesso a conteúdo exclusivo, audiobooks e materiais de estudo.",
            img: "/assets_main/img/wal4.jpeg", // Imagem representando monetização
            bgColor: "#4a4a4a"
        },
        {
            title: "Organização de Estudo",
            description: "Conteúdos organizados em categorias de estudo como 'Arquétipos', 'Tipologias', 'Filosofia', para uma navegação eficiente e aprendizado personalizado.",
            img: "/assets_main/img/wal5.jpeg", // Imagem representando organização
            bgColor: "#5c5c5c"
        }
    ];


    // Configuração do carrossel principal
    let currentHighlight = 0;

    function updateHighlight() {
        const highlight = destaques[currentHighlight];

        // Atualiza os elementos de destaque
        document.getElementById("highlight-img").src = highlight.img;
        document.getElementById("highlight-title").textContent = highlight.title;
        document.getElementById("highlight-description").textContent = highlight.description;



        // Atualiza o índice para o próximo destaque
        currentHighlight = (currentHighlight + 1) % destaques.length;
    }

    setInterval(updateHighlight, 5000); // Troca a cada 3 segundos
    updateHighlight()
    // Configuração do Swiper para cada carrossel menor
</script>