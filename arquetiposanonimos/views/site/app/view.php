<!-- swiper slide -->
<div class="container-fluid">
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

<script>
    var swiper = new Swiper(".mySwiper", {
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
</script>