<?php

/** @var yii\web\View $this */

$this->title = 'Netflix Clone';
?>

<div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
    <div class="col">
        <div class="card h-100">
            <img src="https://via.placeholder.com/300x400" class="card-img-top" alt="The Mother">
            <div class="card-body">
                <h5 class="card-title">The Mother</h5>
                <p class="card-text">Coming to Netflix May 12</p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card h-100">
            <img src="https://via.placeholder.com/300x400" class="card-img-top" alt="Black Dust">
            <div class="card-body">
                <h5 class="card-title">Black Dust</h5>
                <p class="card-text">Now streaming on Netflix</p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card h-100">
            <img src="https://via.placeholder.com/300x400" class="card-img-top" alt="The Fox">
            <div class="card-body">
                <h5 class="card-title">The Fox</h5>
                <p class="card-text">Watch now on Netflix</p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card h-100">
            <img src="https://via.placeholder.com/300x400" class="card-img-top" alt="The Perfection">
            <div class="card-body">
                <h5 class="card-title">The Perfection</h5>
                <p class="card-text">Now streaming on Netflix</p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card h-100">
            <img src="https://via.placeholder.com/300x400" class="card-img-top" alt="Extraction">
            <div class="card-body">
                <h5 class="card-title">Extraction</h5>
                <p class="card-text">Watch now on Netflix</p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card h-100">
            <img src="https://via.placeholder.com/300x400" class="card-img-top" alt="Jagame Thandhiram">
            <div class="card-body">
                <h5 class="card-title">Jagame Thandhiram</h5>
                <p class="card-text">Now streaming on Netflix</p>
            </div>
        </div>
    </div>
</div>

<div class="swiper mySwiper">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <div class="card" style="width: 18rem;">
                <img src="https://via.placeholder.com/300x400" class="card-img-top" alt="Movie">
                <div class="card-body">
                    <h5 class="card-title">Movie Title</h5>
                    <p class="card-text">Some quick example text about the movie or series.</p>
                </div>
            </div>
        </div>
        <div class="swiper-slide">
            <div class="card" style="width: 18rem;">
                <img src="https://via.placeholder.com/300x400" class="card-img-top" alt="Movie">
                <div class="card-body">
                    <h5 class="card-title">Another Title</h5>
                    <p class="card-text">Description of the movie or series here.</p>
                </div>
            </div>
        </div>
        <!-- Add more slides as needed -->
    </div>
    <div class="swiper-pagination"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
</div>

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