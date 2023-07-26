<?php
/*
Template Name: Quotes Template
*/

get_header(); ?>
<div id="primary" class="content-area">
  <main id="main" class="site-main">
    <div class="quotes">
      <?php
       for($i = 1; $i  <= 5; $i++){
      $api_url = 'https://api.kanye.rest/';
      $response = wp_remote_get($api_url);
      if (is_array($response) && !is_wp_error($response)) {
        $quotes = json_decode(wp_remote_retrieve_body($response));
            echo '<p>' . esc_html($quotes->quote) . '</p>';
        } 
      }
      ?>
    </div>
    </main>
</div>

<?php get_footer(); ?>