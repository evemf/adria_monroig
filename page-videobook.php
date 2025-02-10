<?php
/*
Template Name: Videobook
*/
get_header(); ?>

<section class="page--videobook section">
    <div class="title">
        <h2>Mi Videobook</h2>
    </div>
    <div class="header-image">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/adriulls.png" alt="Adrià" class="biography-header-img">
    </div>
    <div class="container">
    <div class="hero section-parallax">
    <video playsinline controls class="hero-video">
        <source src="<?php echo get_template_directory_uri(); ?>/assets/videos/videobook.mp4" type="video/mp4">
        Tu navegador no soporta el video.
    </video>
    <div class="parallax-bg"></div>
</div>
    </div>
</section>

<?php get_footer(); ?>
