<!-- swiper slide -->
<div class="p-0">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="https://placehold.co/1200x500" alt="Slide 1">
            </div>
            <div class="swiper-slide">
                <img src="https://placehold.co/1200x500" alt="Slide 2">
            </div>
            <div class="swiper-slide">
                <img src="https://placehold.co/1200x500" alt="Slide 3">
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>

<style>
    /* Ajustando o Swiper para ocupar a tela inteira */
    .swiper {
        width: 100%;
        height: 90vh; /* 100% da altura da tela */
    }

    .swiper-slide img {
        width: 100%; /* Garantir que as imagens ocupem toda a largura */
        height: 100%; /* Garantir que as imagens ocupem toda a altura */
        object-fit: cover; /* Ajuste para que a imagem cubra todo o slide sem distorção */
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
