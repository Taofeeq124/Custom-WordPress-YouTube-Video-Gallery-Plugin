<?php

// Function to list videos using shortcode
function yvg_list_videos($atts, $content = null){
    global $post;

    // Set default attributes for the shortcode
    $atts = shortcode_atts(array(
        'title'    => 'Video Gallery',
        'count'    => 20,
        'category' => 'all'
    ), $atts );

    // Check if a specific category is specified or if all categories are requested
    if ($atts['category'] == 'all'){
        $terms = ''; // If 'all', set terms to empty
    }else{
        $terms = array(
            array(
                'taxonomy'   => 'category',
                'field'      => 'slug',
                'term'       => $atts['category'] // Set taxonomy term based on provided category slug
            )
            );
    }

    // Set up query arguments for fetching videos
    $args = array(
        'post_type'       => 'video',
        'post_status'     => 'publish',
        'orderby'         => 'created',
        'order'           => 'DESC',
        'posts_per_page'  => $atts['count'],
        'tax_query'       => $terms // Include taxonomy terms in query
    );

    // Fetch videos based on query arguments
    $videos = new WP_Query($args);

    // Check if videos are found
    if($videos->have_posts()){
        $category = str_replace('-', ' ', $atts['category']); // Replace hyphens with spaces in category name

        // Initialize output variable
        $output = '';

        // Build output
        $output .='<div class="video-list">';

        // Loop through each video
        while($videos->have_posts()){
            $videos->the_post();

            // Get Field Values for each video
            $video_id = get_post_meta($post->ID, 'video_id', true); // Get video ID from post meta
            $details  = get_post_meta($post->ID, 'details', true); // Get video details from post meta

            // Build HTML output for each video
            $output .= '<div class="yvg-video">';
            $output .= '<h4> '.get_the_title().'</h4>'; // Output video title
            // Check if fullscreen is disabled
            if(get_settings('yvg_setting_disable_fullscreen')){
                // If disabled, display iframe without allowfullscreen attribute
                $output .= '<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$video_id.'" title="YouTube video player" frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"></iframe>';
            }else{
                // If not disabled, display iframe with allowfullscreen attribute
                $output .= '<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$video_id.'" title="YouTube video player" frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
            }
            $output .= '<div>'.$details.'</div>'; // Output video details
            $output .='</div> <br> </hr>'; // Close video container
        }

        $output .='</div>'; // Close video list container

        // Reset the post data after the loop
        wp_reset_postdata();

        // Return the final output
        return $output;
    }else{
        // If no videos found, return a message
        return '<p>No Videos Found</p>';
    }
}

// Add shortcode for listing videos
add_shortcode('videos', 'yvg_list_videos');

?>


<!--
Explanation:

    This code defines a shortcode function yvg_list_videos that lists videos based on specified attributes.
    It sets default attributes for the shortcode such as 'title', 'count', and 'category'.
    The function queries videos based on the provided attributes, including taxonomy terms if a specific category is specified.
    It loops through each video, retrieves its details from post meta, and constructs HTML output for each video.
    The shortcode can be used in WordPress content to display a list of videos with the specified attributes.
    If no videos are found, it returns a message indicating that no videos were found.
-->