<?php

// Desactivar el acceso a archivos de directorios
function adria_monroig_security_headers() {
    if (!is_admin()) {
        header("X-Content-Type-Options: nosniff");
        header("X-XSS-Protection: 1; mode=block");
        header("X-Frame-Options: DENY");
    }
}
add_action('send_headers', 'adria_monroig_security_headers');

// Meta tags para SEO
function adria_monroig_add_meta_tags() {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<meta name="description" content="Página oficial de Adrià Monroig, actor. Explora su portafolio, proyectos, habilidades y más.">';
}
add_action('wp_head', 'adria_monroig_add_meta_tags');

// Open Graph para redes sociales
function adria_monroig_open_graph_tags() {
    if (is_single() || is_page()) {
        global $post;
        echo '<meta property="og:title" content="' . get_the_title($post->ID) . '" />';
        echo '<meta property="og:description" content="' . get_the_excerpt($post->ID) . '" />';
        echo '<meta property="og:image" content="' . get_the_post_thumbnail_url($post->ID) . '" />';
        echo '<meta property="og:url" content="' . get_permalink($post->ID) . '" />';
    }
}
add_action('wp_head', 'adria_monroig_open_graph_tags');

// Configuración de colores personalizados
function adria_monroig_customize_register($wp_customize) {
    $wp_customize->add_section('colors_section', array(
        'title' => __('Colors', 'adria_monroig'),
        'priority' => 30,
    ));

    $wp_customize->add_setting('background_color', array(
        'default' => '#ffffff',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'background_color_control', array(
        'label' => __('Color del fons', 'adria_monroig'),
        'section' => 'colors_section',
        'settings' => 'background_color',
    )));
}
add_action('customize_register', 'adria_monroig_customize_register');

function adria_monroig_customize_css() {
    ?>
    <style type="text/css">
        body {
            background-color: <?php echo get_theme_mod('background_color', '#ffffff'); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'adria_monroig_customize_css');

// Añadir soporte para imágenes destacadas
add_theme_support('post-thumbnails');

function adria_monroig_enqueue_styles() {
    // Encolar estilos globales
    wp_enqueue_style('main-style', get_stylesheet_uri());
    wp_enqueue_style('light-mode', get_template_directory_uri() . '/assets/css/light-mode.css');
    wp_enqueue_style('dark-mode', get_template_directory_uri() . '/assets/css/dark-mode.css');
    
    // Encolar librerías externas
    wp_enqueue_style('slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
    wp_enqueue_script('slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), null, true);
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
    wp_enqueue_style('lightbox2-css', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css');
    wp_enqueue_script('lightbox2-js', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js', array('jquery'), null, true);

    // Encolar scripts propios
    wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), null, true);
    wp_enqueue_script('slider-js', get_template_directory_uri() . '/assets/js/slider.js', array('jquery', 'slick-js'), null, true);

    wp_localize_script('main-js', 'adriaMonroig', array(
        'jsonUrl' => get_template_directory_uri() . '/assets/data/curriculum.json'
    ));
}
add_action('wp_enqueue_scripts', 'adria_monroig_enqueue_styles');



// Soporte para menús
function adria_monroig_register_menus() {
    register_nav_menus(
        array(
            'header-menu' => __('Menú Principal'),
            'footer-menu' => __('Menú Footer')
        )
    );
}
add_action('init', 'adria_monroig_register_menus');

// Soporte para Elementor
function adria_monroig_elementor_support() {
    add_theme_support('elementor');
}
add_action('after_setup_theme', 'adria_monroig_elementor_support');

// Crear páginas automáticamente al activar el tema
function adria_monroig_create_default_pages() {
    $pages = array(
        'Videobook' => array(
            'post_title'   => 'Videobook',
            'post_content' => 'Bienvenidos a la página oficial de Adrià Monroig',
            'template'     => 'page-videobook.php'
        ),
        'Portfolio' => array(
            'post_title'   => 'Portfolio',
            'post_content' => 'Aquí puedes ver los proyectos en los que he trabajado',
            'template'     => 'page-portfolio.php'
        ),
        'Galería' => array(
            'post_title'   => 'Galería',
            'post_content' => 'Fotos de Adrià Monroig.',
            'template'     => 'page-gallery.php'
        ),
        'Currículum' => array(
            'post_title'   => 'Currículum',
            'post_content' => 'Descarga mi currículum en PDF.',
            'template'     => 'page-cv.php'
        ),
        'Formación' => array(
            'post_title'   => 'Formación',
            'post_content' => 'Demostrado en papel',
            'template'     => 'page-formacion.php'
        ),
        'Contacto' => array(
            'post_title'   => 'Contacto',
            'post_content' => '[contact_form]',
            'template'     => 'page-contact.php'
        ),
        'Biografía' => array(
            'post_title'   => 'Biografía',
            'post_content' => 'Yo, Adrià Monroig',
            'template'     =>  'page-biography.php'
        )
    );

    foreach ($pages as $slug => $page_data) {
        if (!get_page_by_path(sanitize_title($slug))) {
            wp_insert_post(array(
                'post_title'     => $page_data['post_title'],
                'post_content'   => $page_data['post_content'],
                'post_status'    => 'publish',
                'post_type'      => 'page',
                'post_name'      => sanitize_title($slug),
                'page_template'  => $page_data['template']
            ));
        }
    }
}
add_action('after_switch_theme', 'adria_monroig_create_default_pages');

// Verificar si ACF está activo
function adria_monroig_require_acf() {
    if ( ! class_exists('ACF') ) {
        add_action('admin_notices', function() {
            ?>
            <div class="notice notice-error">
                <p><?php _e('Este tema requiere el plugin <strong>Advanced Custom Fields</strong>. Por favor, instálalo y actívalo para que todas las funciones del tema funcionen correctamente.', 'adria_monroig'); ?></p>
            </div>
            <?php
        });
    }
}
add_action('after_setup_theme', 'adria_monroig_require_acf');

// Añadir soporte para campos personalizados (ACF)
if( function_exists('acf_add_local_field_group') ):
acf_add_local_field_group(array(
    'key' => 'group_actor_info',
    'title' => 'Actor Info',
    'fields' => array(
        array(
            'key' => 'field_actor_name',
            'label' => 'Mombre del actor',
            'name' => 'actor_name',
            'type' => 'text',
            'default_value' => 'ADRIÀ MONROIG',
        ),
        array(
            'key' => 'field_actor_bio',
            'label' => 'Biografía',
            'name' => 'actor_bio',
            'type' => 'textarea',
            'default_value' => 'Biografia predeterminada...',
        ),
        array(
            'key' => 'field_actor_skills',
            'label' => 'Habilidades',
            'name' => 'actor_skills',
            'type' => 'repeater',
            'sub_fields' => array(
                array(
                    'key' => 'field_skill_title',
                    'label' => 'Título de la habilidad',
                    'name' => 'skill_title',
                    'type' => 'text',
                ),
                array(
                    'key' => 'field_skill_description',
                    'label' => 'Descripción de la habilidad',
                    'name' => 'skill_description',
                    'type' => 'textarea',
                ),
            ),
        ),
        array(
            'key' => 'field_hero_image',
            'label' => 'Imagen de Hero',
            'name' => 'hero_image',
            'type' => 'image',
            'return_format' => 'url',
        ),
        array(
            'key' => 'field_resume_pdf',
            'label' => 'Subir CV (PDF)',
            'name' => 'resume_pdf',
            'type' => 'file',
            'return_format' => 'url',
        ),
        array(
            'key' => 'field_whatsapp_number',
            'label' => 'Número de WhatsApp',
            'name' => '+34691305756',
            'type' => 'number',
        ),
        // Campo para videos
        array(
            'key' => 'field_videos',
            'label' => 'Videos',
            'name' => 'videos',
            'type' => 'repeater',
            'sub_fields' => array(
                array(
                    'key' => 'field_video_url',
                    'label' => 'Video URL',
                    'name' => 'video_url',
                    'type' => 'url',
                ),
                array(
                    'key' => 'field_video_description',
                    'label' => 'Descripción',
                    'name' => 'video_description',
                    'type' => 'textarea',
                ),
            ),
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'options_page',
                'operator' => '==',
                'value' => 'acf-options-actor-info',
            ),
        ),
    ),
));
endif;


// Crear un shortcode para mostrar los videos
function adria_monroig_videos_shortcode() {
    $videos = get_field('videos', 'options');
    if ($videos) {
        $output = '<div class="video-gallery">';
        foreach ($videos as $video) {
            $output .= '<div class="video-item">';
            $output .= '<iframe width="560" height="315" src="' . esc_url($video['video_url']) . '" frameborder="0" allowfullscreen></iframe>';
            if (!empty($video['video_description'])) {
                $output .= '<p>' . esc_html($video['video_description']) . '</p>';
            }
            $output .= '</div>';
        }
        $output .= '</div>';
        return $output;
    }
    return '<p>No hay videos disponibles.</p>';
}
add_shortcode('video_gallery', 'adria_monroig_videos_shortcode');

// Formulario de contacto
function adria_monroig_contact_form() {
    ob_start(); ?>
    <form method="post" action="">
        <label for="name">Nombre:</label>
        <input type="text" name="name" required>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <label for="message">Mensaje:</label>
        <textarea name="message" required></textarea>
        <button type="submit">Enviar</button>
    </form>
    <?php
    return ob_get_clean();
}
add_shortcode('contact_form', 'adria_monroig_contact_form');

function handle_contact_form() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $message = sanitize_textarea_field($_POST['message']);
        
        $to = 'adri_monpich93@hotmail.com';
        $subject = 'Nuevo mensaje de ADRIAMONROIG.COM';
        $body = "Nom: $name\nEmail: $email\nMensaje:\n$message";
        $headers = array('Content-Type: text/plain; charset=UTF-8');

        wp_mail($to, $subject, $body, $headers);
        echo '<div>Gracias por tu mensaje. Te contestaré pronto!</div>';
    }
}
add_action('wp', 'handle_contact_form');


if (!function_exists('load_actor_data')) {
    function load_actor_data() {
        $file_path = get_template_directory() . '/assets/data/curriculum.json';
        if (file_exists($file_path)) {
            $json_data = json_decode(file_get_contents($file_path), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                error_log('Error en JSON: ' . json_last_error_msg());
            } else {
                update_option('actor_data', $json_data);
            }
        } else {
            error_log('El archivo JSON no se encontró: ' . $file_path);
        }
    }
}
add_action('after_setup_theme', 'load_actor_data');


function get_actor_data() {
    return get_option('actor_data', []);
}

function create_home_page_on_activation() {
    $existing_page = get_page_by_title('Home', OBJECT, 'page');
    if (!$existing_page) {
        $actor_data = get_actor_data();
        $content = '<h1>' . esc_html($actor_data['name']) . '</h1>';
        $content .= '<h2>Biografía</h2>';
        $content .= '<p>' . esc_html($actor_data['bio']) . '</p>';
        
        if (!empty($actor_data['theater'])) {
            $content .= '<h3>Teatro</h3><ul>';
            foreach ($actor_data['theater'] as $theater) {
                $content .= '<li>' . esc_html($theater['title']) . ' (' . esc_html($theater['year']) . ') - ' . esc_html($theater['venue']) . '</li>';
            }
            $content .= '</ul>';
        }

        if (!empty($actor_data['tv'])) {
            $content .= '<h3>Televisión</h3><ul>';
            foreach ($actor_data['tv'] as $tv) {
                $content .= '<li>' . esc_html($tv['title']) . ' (' . esc_html($tv['year']) . ') - ' . esc_html($tv['network']) . '</li>';
            }
            $content .= '</ul>';
        }

        if (!empty($actor_data['advertising'])) {
            $content .= '<h3>Publicidad</h3><ul>';
            foreach ($actor_data['advertising'] as $ad) {
                $content .= '<li>' . esc_html($ad['title']) . '</li>';
            }
            $content .= '</ul>';
        }

        if (!empty($actor_data['film'])) {
            $content .= '<h3>Cine</h3><ul>';
            foreach ($actor_data['film'] as $film) {
                $content .= '<li>' . esc_html($film['description']) . ' (' . esc_html($film['year']) . ')</li>';
            }
            $content .= '</ul>';
        }

        $post_data = [
            'post_title'   => 'Home',
            'post_content' => $content,
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ];
        
        $post_id = wp_insert_post($post_data);
        if (!is_wp_error($post_id)) {
            update_post_meta($post_id, '_wp_page_template', 'page-home.php');
        }
    }
}
add_action('after_switch_theme', 'create_home_page_on_activation');
