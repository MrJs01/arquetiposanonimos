<?php

/** @var yii\web\View $this */

$this->title = 'Netflix Clone';
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
<div class="container-fluid mb-5">
    <div class="highlight-card">
        <img id="highlight-img" src="https://placehold.co/1200x500" alt="Destaque">
        <div class="highlight-content">
            <h2 id="highlight-title" class="highlight-title">Título do Destaque</h2>
            <p id="highlight-description" class="highlight-description">Descrição do filme ou série em destaque.</p>
            <button class="btn btn-danger btn-highlight">Assistir</button>
            <button class="btn btn-secondary btn-highlight">Trailer</button>
        </div>
    </div>
</div>


<!-- Três Swipers Menores -->
<div class="container-fluid">
    <h2 class="text-white m-5">Filmes em Destaque</h2>
    <div class="swiper mySwiper" id="swiper-destaques">
        <div class="swiper-wrapper">
            <?php foreach ($comece_aqui as $filme): // Criando 8 filmes por carrossel 
            ?>
                <div class="swiper-slide" style="width: auto;">
                    <div class="card" onclick="location.href='<?= $filme['slug'] ?>'" style="width: 300px;">
                        <img src="/file_contents/<?= $filme['img'] ?>" class="card-img-top" alt="Filme" style="object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $filme['title'] ?></h5>
                            <p class="card-text"><?= $filme['description'] ?></p>
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
            title: "Filme Destaque 1",
            description: "Descrição do filme destaque 1. Uma aventura épica e emocionante.",
            img: "https://placehold.co/1200x500/ff0000/ffffff",
            bgColor: "#1c1c1c"
        },
        {
            title: "Filme Destaque 2",
            description: "Descrição do filme destaque 2. Suspense e drama intensos.",
            img: "https://placehold.co/1200x500/00ff00/ffffff",
            bgColor: "#2b2b2b"
        },
        {
            title: "Filme Destaque 3",
            description: "Descrição do filme destaque 3. Comédia para toda a família.",
            img: "https://placehold.co/1200x500/0000ff/ffffff",
            bgColor: "#3c3c3c"
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

    setInterval(updateHighlight, 3000); // Troca a cada 3 segundos

    // Configuração do Swiper para cada carrossel menor
</script>