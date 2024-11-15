<!-- Cabeçalho e navegação -->
<div class="user-img" style="float: right;">
    <img src="https://github.com/Chinemereem/Netflix-clone/blob/master/images/user.png?raw=true" alt="">
    <span class="span-icon"></span>
</div>

<div class="between-img-div">
    <img src="https://raw.githubusercontent.com/Chinemereem/Netflix-clone/master/images/between-1.webp" class="between-img" alt="">
</div>

<div class="logo-and-text">
    <div class="titleWrapper">
        <div class="billboard-title">
            <img class="title-logo" src="https://raw.githubusercontent.com/Chinemereem/Netflix-clone/master/images/netflixsvg.webp" alt="Netflix logo">
        </div>
    </div>

    <div class="info-wrapper">
        <div class="info-wrapper-fade">
            <div class="series-synopsis">
                After a mysterious disease kills every resident over 21 years old, survivors of a town must fend for themselves when the government quarantines them.
            </div>
        </div>
        <button class="color-primary" id="playButton">
            <span class="info-btn">Play</span>
        </button>
        <button class="button-secondary" id="infoButton">
            <span class="info-btn">More Info</span>
        </button>
    </div>
</div>

<!-- Avaliação -->
<div class="ratin-div" style="float: right;">
    <button aria-label="Replay" class="color-supplementary" type="button">
        <div class="small-div">
            <svg class="style-svg" viewBox="0 0 24 24">
                <path d="M20 12.35l1.919-1.371 1.162 1.627-4.08 2.915-4.082-2.915 1.162-1.627L18 12.349V12c0-3.87-3.13-7-7-7s-7 3.13-7 7 3.13 7 7 7c1.93 0 3.68-.79 4.94-2.06l1.42 1.42A8.954 8.954 0 0 1 11 21a9 9 0 1 1 9-9v.35z" fill="currentColor"></path>
            </svg>
        </div>
    </button>
    <span class="rating">
        <span class="maturity-number">16+</span>
    </span>
</div>

<!-- Seções de Carrossel -->
<section class="all-drama">
    <div class="tv-dramas" id="dramas">
        <h2 class="tvd-h2">Tv Dramas</h2>
        <div class="div-width" id="div1-width">
            <div class="all-movie-div">
                <!-- Imagens do carrossel de dramas -->
                <div class="orange">
                    <img src="https://github.com/Chinemereem/Netflix-clone/blob/master/images/nevertheless.jpg?raw=true" alt="Orange is the New Black">
                </div>
                <div class="orange">
                    <img src="https://github.com/Chinemereem/Netflix-clone/blob/master/images/nevertheless.jpg?raw=true" alt="Orange is the New Black">
                </div>
                <div class="orange">
                    <img src="https://github.com/Chinemereem/Netflix-clone/blob/master/images/nevertheless.jpg?raw=true" alt="Orange is the New Black">
                </div>
                <div class="orange">
                    <img src="https://github.com/Chinemereem/Netflix-clone/blob/master/images/nevertheless.jpg?raw=true" alt="Orange is the New Black">
                </div>
                <div class="orange">
                    <img src="https://github.com/Chinemereem/Netflix-clone/blob/master/images/nevertheless.jpg?raw=true" alt="Orange is the New Black">
                </div>
                <div class="orange">
                    <img src="https://github.com/Chinemereem/Netflix-clone/blob/master/images/nevertheless.jpg?raw=true" alt="Orange is the New Black">
                </div>
                <div class="orange">
                    <img src="https://github.com/Chinemereem/Netflix-clone/blob/master/images/nevertheless.jpg?raw=true" alt="Orange is the New Black">
                </div>
                <!-- Mais filmes... -->
            </div>
        </div>
    </div>
    <div class="aror">
        <a class="prev" onclick="scrollCarrousel('div1-width', -300)">&#10094;</a>
        <a class="next" onclick="scrollCarrousel('div1-width', 300)">&#10095;</a>
    </div>
</section>

<!-- Mais seções de carrossel (Trending Now, My List, etc.) -->

<section class="all-drama">
    <div class="tv-dramas" id="dramas">
        <h2 class="tvd-h2">Trending Now</h2>
        <div class="div-width" id="div2-width">
            <div class="all-movie-div">
                <!-- Imagens do carrossel de dramas -->
                <div class="orange">
                    <img src="https://github.com/Chinemereem/Netflix-clone/blob/master/images/nevertheless.jpg?raw=true" alt="Orange is the New Black">
                </div>
                <div class="orange">
                    <img src="https://github.com/Chinemereem/Netflix-clone/blob/master/images/resort-to-love.jpeg?raw=true" alt="Orange is the New Black">
                </div>
                <div class="orange">
                    <img src="https://github.com/Chinemereem/Netflix-clone/blob/master/images/nevertheless.jpg?raw=true" alt="Orange is the New Black">
                </div>
                <div class="orange">
                    <img src="https://github.com/Chinemereem/Netflix-clone/blob/master/images/nevertheless.jpg?raw=true" alt="Orange is the New Black">
                </div>
                <div class="orange">
                    <img src="https://github.com/Chinemereem/Netflix-clone/blob/master/images/resort-to-love.jpeg?raw=true" alt="Orange is the New Black">
                </div>
                <div class="orange">
                    <img src="https://github.com/Chinemereem/Netflix-clone/blob/master/images/nevertheless.jpg?raw=true" alt="Orange is the New Black">
                </div>
                <div class="orange">
                    <img src="https://github.com/Chinemereem/Netflix-clone/blob/master/images/nevertheless.jpg?raw=true" alt="Orange is the New Black">
                </div>
                <!-- Mais filmes... -->
            </div>
        </div>
    </div>
    <div class="aror">
        <a class="prev" onclick="scrollCarrousel('div2-width', -300)">&#10094;</a>
        <a class="next" onclick="scrollCarrousel('div2-width', 300)">&#10095;</a>
    </div>
</section>
<!-- ... outras seções de carrossel e conteúdos -->


<!-- Footer -->
<footer>
    <div class="grid-container">
        <div class="grid-item">
            <span><i class="fab fa-facebook-square"></i></span>
            <span><i class="fab fa-instagram"></i></span>
            <span><i class="fab fa-youtube"></i></span>
            <p>Audio and Subtitle</p>
            <p>Media Center</p>
            <p>Privacy</p>
            <p>Contact Us</p>
            <p>&copy; 1997-2021 Netflix, Inc.</p>
        </div>
        <!-- Outras colunas do footer -->
    </div>
</footer>

<!-- Scripts -->
<script>
    // Função para navegação suave do carrossel
    function scrollCarrousel(divId, scrollAmount) {
        const div = document.getElementById(divId);

        // Armazenar a posição inicial
        const start = div.scrollLeft;

        // Posição final após o scroll
        const end = start + scrollAmount;

        // Duração da animação (em milissegundos)
        const duration = 500; // 500ms (0.5 segundos)

        let startTime = null;

        // Função para animar o scroll
        function animateScroll(currentTime) {
            if (startTime === null) startTime = currentTime;
            const progress = currentTime - startTime;
            const position = easeInOutQuad(progress, start, end - start, duration);

            div.scrollLeft = position;

            if (progress < duration) {
                requestAnimationFrame(animateScroll); // Continuar a animação até completar a duração
            }
        }

        // Função de easing (movimento suave)
        function easeInOutQuad(t, b, c, d) {
            t /= d / 2;
            if (t < 1) return c / 2 * t * t + b;
            t--;
            return -c / 2 * (t * (t - 2) - 1) + b;
        }

        requestAnimationFrame(animateScroll); // Iniciar a animação
    }

    // colocar todos os scrolls para esquerda
    document.querySelectorAll('.div-width').forEach(div => {
        div.scrollLeft = 0;
    });
</script>