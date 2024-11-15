<?php

/** @var yii\web\View $this */

$this->title = 'Netflix Clone';
?>

<!-- Estilos adicionais para personalizar o layout -->
<style>
    body {
        background-color: #141414;
        color: #ffffff;
        transition: background 0.5s;
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
    <h2 class="text-white">Filmes em Destaque</h2>
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <?php for ($j = 0; $j < 8; $j++): // Criando 8 filmes por carrossel 
            ?>
                <div class="swiper-slide">
                    <div class="card" onclick="location.href='/filme.php?id=<?= $j ?>'">
                        <img src="https://placehold.co/300x400" class="card-img-top" alt="Filme">
                        <div class="card-body">
                            <h5 class="card-title">Título do Filme <?= $j + 1 ?></h5>
                            <p class="card-text">Descrição curta do filme ou série.</p>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>

    <h2 class="text-white">Series em Destaque</h2>
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <?php for ($j = 0; $j < 8; $j++): // Criando 8 seíries por carrossel 
            ?>
                <div class="swiper-slide">
                    <div class="card" onclick="location.href='/serie.php?id=<?= $j ?>'">
                        <img src="https://placehold.co/300x400" class="card-img-top" alt="Seírie">
                        <div class="card-body">
                            <h5 class="card-title">Título da Seírie <?= $j + 1 ?></h5>
                            <p class="card-text">Descrição curta da seírie.</p>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>

    <h2 class="text-white">Animes em Destaque</h2>
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <?php for ($j = 0; $j < 8; $j++): // Criando 8 animes por carrossel 
            ?>
                <div class="swiper-slide">
                    <div class="card" onclick="location.href='/animes.php?id=<?= $j ?>'">
                        <img src="https://placehold.co/300x400" class="card-img-top" alt="Anime">
                        <div class="card-body">
                            <h5 class="card-title">Título do Anime <?= $j + 1 ?></h5>
                            <p class="card-text">Descrição curta do anime.</p>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
</div>

<!-- Swiper.js e configuração -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

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
        document.getElementById("highlight-img").src = highlight.img;
        document.getElementById("highlight-title").textContent = highlight.title;
        document.getElementById("highlight-description").textContent = highlight.description;
        document.body.style.backgroundColor = highlight.bgColor;

        currentHighlight = (currentHighlight + 1) % destaques.length;
    }
    setInterval(updateHighlight, 3000); // Troca a cada 3 segundos

    // Configuração do Swiper para cada carrossel menor
    document.querySelectorAll('.mySwiper').forEach(function(swiperContainer) {
        new Swiper(swiperContainer, {
            slidesPerView: 4,
            spaceBetween: 20,
            loop: true,
            navigation: {
                nextEl: swiperContainer.querySelector('.swiper-button-next'),
                prevEl: swiperContainer.querySelector('.swiper-button-prev'),
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 10,
                },
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 20,
                },
                1440: {
                    slidesPerView: 6,
                    spaceBetween: 30,
                }
            }
        });
    });
</script>