<?php
$is_logged_in = is_user_logged_in();

// Define the number of projects to retrieve
$num_projects = $is_logged_in ? 6 : 3;

// Initialize response data
$response = array(
    'success' => true,
    'data' => array(),
);

// Query projects based on user login status and project type
$args = array(
    'post_type' => 'project', // Change 'project' to your custom post type name if different
    'post_status' => 'publish',
    'posts_per_page' => $num_projects,
    'tax_query' => array(
        array(
            'taxonomy' => 'project_type', // Change 'project_type' to your custom taxonomy name if different
            'field' => 'slug',
            'terms' => 'architecture', // Change 'architecture' to your desired project type slug
        ),
    ),
);

$projects_query = new WP_Query($args);

if ($projects_query->have_posts()) {
    while ($projects_query->have_posts()) {
        $projects_query->the_post();
        $project_id = get_the_ID();
        $project_title = get_the_title();
        $project_link = get_permalink();
        $project_data = array(
            'id' => $project_id,
            'title' => $project_title,
            'link' => $project_link,
        );
        $response['data'][] = $project_data;
    }
    wp_reset_postdata();
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
exit;
?>