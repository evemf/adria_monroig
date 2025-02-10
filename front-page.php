<?php get_header(); ?>

<!-- Sección de Hero -->
<div class="hero section-parallax">
    <video muted autoplay playsinline controls class="hero-video">
        <source src="<?php echo get_template_directory_uri(); ?>/assets/videos/videobook.mp4" type="video/mp4">
        Tu navegador no soporta el video.
    </video>
    <div class="parallax-bg"></div>
</div>

<!-- Sección de Contenido Principal -->
<div class="content-parallax">
    <div class="fourth section">
        <svg class="svg svg-fourth-section" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="M0 100 C 20 0 50 0 100 100 Z"></path>
        </svg>

        <div class="fourth--content section-weight">
            <?php
            // Obtener la página "Introducción"
            $introduccion = get_page_by_path('introduccion');

            // Si la página existe, mostrar su contenido
            if ($introduccion) {
                echo '<div class="title"><h2>' . esc_html(get_the_title($introduccion->ID)) . '</h2></div>';
                echo apply_filters('the_content', $introduccion->post_content);
            } else {
                // Si no existe, mostrar un mensaje de fallback
                echo '<div class="title"><h2>Sobre Mí</h2></div>';
                echo '<p>Desde pequeño, el cine y la interpretación han sido mi refugio y mi pasión. Crecí rodeado de VHS y sueños, con un amor innato por contar historias.</p>';
                echo '<p>Mi formación en interpretación y mi crecimiento personal han sido un viaje de autodescubrimiento y superación. Hoy, vivo con la certeza de que actuar no es solo una profesión, sino una forma de vida.</p>';
                echo '<p>Como dijo Nathalie Poza: <em>"No sé si cambiaremos el mundo, pero a mí este oficio me ha salvado la vida."</em></p>';
                echo '<p>Bienvenidos a mi universo.</p>';
                echo '<p>Podéis saber un poquito más de mi en Mi Biografía.</p>';
            }
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
