<?php
/*
Template Name: Galería
*/
get_header(); ?>

<section class="page--gallery section">
    <div class="title">
        <h2>Galería</h2>
    </div>
    <div class="header-image">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/adriulls.png" alt="Adrià" class="biography-header-img">
    </div>
    <div class="photo-gallery">
        <?php
        // Obtener las imágenes
        $image_dir = get_template_directory() . '/assets/images/adria/';
        $images = glob($image_dir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);

        if ($images) :
            foreach ($images as $index => $image):
                $image_url = get_template_directory_uri() . '/assets/images/adria/' . basename($image);
        ?>
            <div class="photo-item">
                <a href="<?php echo esc_url($image_url); ?>" data-lightbox="galeria" data-title="Foto <?php echo $index + 1; ?>">
                    <img src="<?php echo esc_url($image_url); ?>" alt="Foto <?php echo $index + 1; ?>">
                </a>
            </div>
        <?php
            endforeach;
        else:
            echo '<p>No hay fotos disponibles.</p>';
        endif;
        ?>
    </div>
</section>

<?php get_footer(); ?>
