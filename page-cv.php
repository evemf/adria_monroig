<?php
/*
Template Name: Currículum
*/
get_header(); ?>

<section class="page--cv section">
    <div class="title">
        <h2>Mi Trayectoría</h2>
    </div>
    <div class="header-image">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/adriulls.png" alt="Adrià" class="biography-header-img">
    </div>
    <div class="container">
        <div class="tabs" class="tabs--titles">
            <?php
            // Obtener los datos del actor desde JSON
            $actor_data = get_actor_data();

            $sections = ['theater' => 'Teatro', 'tv' => 'Televisión', 'advertising' => 'Publicidad', 'film' => 'Cine'];

foreach ($sections as $key => $value) :
    if (!empty($actor_data[$key])) : // Verifica si hay datos en la sección correspondiente
        echo '<button class="tab" data-section="' . $key . '">' . esc_html($value) . '</button>';
    endif;
endforeach;
            ?>
        </div>

        <div id="content" class="tabs--content">
            <?php
            // Crear dinámicamente las secciones de contenido
            foreach ($sections as $key => $value) :
                if (!empty($actor_data[$key])) :
                    echo '<div id="' . $key . '" class="section-cv">';
                    foreach ($actor_data[$section] as $item) :
                        if ($section == 'theater' || $section == 'tv' || $section == 'advertising') :
                            echo '<p>' . esc_html($item['year']) . ' - ' . esc_html($item['title']) . (isset($item['venue']) ? ' (' . esc_html($item['venue']) . ')' : '') . (isset($item['network']) ? ' (' . esc_html($item['network']) . ')' : '') . (isset($item['client']) ? ' (' . esc_html($item['client']) . ')' : '') . '</p>';
                        elseif ($section == 'film') :
                            echo '<p>' . esc_html($item['year']) . ': ' . esc_html($item['description']) . '</p>';
                        endif;
                    endforeach;
                    echo '</div>';
                endif;
            endforeach;
            ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
