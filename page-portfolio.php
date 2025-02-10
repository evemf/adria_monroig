<?php
/*
Template Name: Portfolio
*/
get_header(); ?>
<section class="projects portfolio-section section">
    <div class="title"><h2>Proyectos</h2></div>
    <div class="header-image">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/adriulls.png" alt="Adrià" class="biography-header-img">
    </div>

    <div class="video-gallery">
        <?php
        if (have_rows('video_projects')): 
            while (have_rows('video_projects')): the_row();
                $video_url = get_sub_field('video_url');
                $video_title = get_sub_field('video_title');
                $video_description = get_sub_field('video_description');
        ?>
            <div class="video-item">
                <div class="video-loader">
                    <div class="spinner"></div>
                </div>
                <iframe src="<?php echo esc_url($video['url']); ?>" title="<?php echo esc_attr($video['title']); ?>" allowfullscreen loading="lazy"></iframe>
            </div>

        <?php
            endwhile; 
        else:
            $default_videos = [
                ['url' => 'https://www.youtube.com/embed/hCf9Z-aYN10', 'title' => 'Video 1', 'description' => 'Descripción del video 1.'],
                ['url' => 'https://www.youtube.com/embed/1iI_hOvdVts', 'title' => 'Video 2', 'description' => 'Descripción del video 2.'],
                ['url' => 'https://www.youtube.com/embed/A2WPG3_xL7A', 'title' => 'Video 3', 'description' => 'Descripción del video 3.'],
                ['url' => 'https://www.youtube.com/embed/_sfZzb3frOk', 'title' => 'Video 4', 'description' => 'Descripción del video 4.'],
                ['url' => 'https://www.youtube.com/embed/UyHjveemNi0', 'title' => 'Video 5', 'description' => 'Descripción del video 5.'],
                ['url' => 'https://www.youtube.com/embed/VGMnJ4BaF1I', 'title' => 'Video 6', 'description' => 'Descripción del video 6.'],
                ['url' => 'https://www.youtube.com/embed/6QGCI64d2Co', 'title' => 'Video 7', 'description' => 'Descripción del video 7.'],
                ['url' => 'https://www.youtube.com/embed/OjHSCp3naAM', 'title' => 'Video 8', 'description' => 'Descripción del video 8.'],
            ];
            
            foreach ($default_videos as $video):
        ?>
           <div class="video-item">
                <div class="video-loader">
                    <div class="spinner"></div>
                </div>
                <iframe src="<?php echo esc_url($video['url']); ?>" title="<?php echo esc_attr($video['title']); ?>" allowfullscreen loading="lazy"></iframe>
            </div>

        <?php
            endforeach;
        endif; 
        ?>
    </div>
</section>

<?php get_footer(); ?>
