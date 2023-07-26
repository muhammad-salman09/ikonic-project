<?php
/**
 * Template Name: Projects Archive
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        $posts_per_page = 6;
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $args = array(
            'post_type' => 'projects', 
            'posts_per_page' => $posts_per_page,
            'paged' => $paged,
        );

        $projects_query = new WP_Query($args);

        if ($projects_query->have_posts()) :
            while ($projects_query->have_posts()) : $projects_query->the_post();
              the_title();
              the_content();
            endwhile;
            // Add pagination
            if ($projects_query->max_num_pages > 1) :
                echo '<div class="pagination">';
                echo paginate_links(array(
                    'base' => get_pagenum_link(1) . '%_%',
                    'format' => 'page/%#%/',
                    'current' => max(1, get_query_var('paged')),
                    'total' => $projects_query->max_num_pages,
                    'prev_text' => __('&laquo; Previous'),
                    'next_text' => __('Next &raquo;'),
                ));
                echo '</div>';
            endif;

            wp_reset_postdata();
        else :
            echo '<p>No projects found.</p>';
        endif;
        ?>

    </main>
</div>

<?php get_footer(); ?>