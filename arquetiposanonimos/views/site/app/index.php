<?php

/** @var yii\web\View $this */

$this->title = 'Netflix Clone';
?>

<div class="swiper mySwiper">
    <div class="swiper-wrapper">
        <!-- Card 1 -->
        <div class="swiper-slide">
            <div class="card" style="width: 18rem;">
                <img src="https://via.placeholder.com/300x400" class="card-img-top" alt="Movie">
                <div class="card-body">
                    <h5 class="card-title">Movie Title</h5>
                    <p class="card-text">Some quick example text about the movie or series.</p>
                </div>
            </div>
        </div>
        <!-- Card 2 -->
        <div class="swiper-slide">
            <div class="card" style="width: 18rem;">
                <img src="https://via.placeholder.com/300x400" class="card-img-top" alt="Movie">
                <div class="card-body">
                    <h5 class="card-title">Another Title</h5>
                    <p class="card-text">Description of the movie or series here.</p>
                </div>
            </div>
        </div>
        <!-- Add more slides/cards as needed -->
    </div>
    <!-- Swiper Pagination -->
    <div class="swiper-pagination"></div>
    <!-- Swiper Navigation -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
</div>

<!-- SwiperJS Initialization -->
<script>
    const swiper = new Swiper('.mySwiper', {
        slidesPerView: 3,
        spaceBetween: 30,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>
