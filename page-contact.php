<?php
/*
Template Name: Contacto
*/
get_header(); ?>

<section class="contact-section section">
    <div class="title"><h2>Contáctame</h2></div>
    <div class="header-image">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/adriulls.png" alt="Adrià" class="biography-header-img">
    </div>
    <div class="container">
        <div class="contact-info">
            <p><strong>Nombre:</strong> Adrià Monroig Picher</p>
            <p><strong>Teléfono:</strong> 691305756</p>
            <p><strong>Email:</strong> <a href="mailto:adri_monpich93@hotmail.com">adri_monpich93@hotmail.com</a></p>
            <p><strong>Instagram:</strong> <a href="https://instagram.com/adriamonroig" target="_blank">@adriamonroig</a></p>
        </div>
        <?php get_template_part('template-parts/contact-form'); ?>
        <p>También puedes contactarme directamente por WhatsApp:</p>
        <a target="_blank" href="https://wa.me/<?php the_field('whatsapp_number'); ?>" class="whatsapp-btn">Contactar por WhatsApp</a>
    </div>
</section>
<?php get_footer(); ?>
