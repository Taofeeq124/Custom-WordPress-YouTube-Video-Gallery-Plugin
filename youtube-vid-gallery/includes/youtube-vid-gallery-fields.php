<?php

// Function to add custom meta box for video fields
function yvg_add_fields_metabox(){
    add_meta_box(
        'yvg_video_fields',                             // Meta box ID
        __('Video Fields'),                            // Meta box title
        'yvg_video_fields_callback',                   // Callback function to display meta box content
        'video',                                       // Post type for which the meta box should be added
        'normal',                                      // Priority of the meta box (e.g., 'high', 'core', 'default')
        'default'                                      // Context in the page where the meta box should be displayed (e.g., 'normal', 'side', 'advanced')
    );
}

// Hook to add meta boxes
add_action('add_meta_boxes', 'yvg_add_fields_metabox');

// Function to display meta box content
function yvg_video_fields_callback($post){

    // Add nonce field to prevent CSRF attacks
    wp_nonce_field(basename(__FILE__), 'yvg_videos_nonce');

    // Retrieve stored meta values for the current post
    $yvg_video_stored_meta = get_post_meta($post->ID);

    ?>

    <div class="wrap video-form">

        <!-- Input field for video ID -->
        <div class="form-group">
            <label for="video-id"><?php esc_html_e( 'video ID','yvg_domain'); ?></label>
            <input type="text" name="video_id" id="video_id" value="<?php if(!empty($yvg_video_stored_meta['video_id'])) 
            echo esc_attr( $yvg_video_stored_meta['video_id'][0]);?> ">
        </div>

        <!-- Editor for video details -->
        <div class="form-group">
            <label for="details"><?php esc_html_e('Details','yvg_domain'); ?></label>
            <?php  
                $content = get_post_meta($post->ID, 'details', true);
                $editor  = 'details';
                $settings = array(
                    'textarea_rows'   => 5,
                    'media_buttons'   => false
                );

                // WordPress editor for entering video details
                wp_editor($content, $editor, $settings);
            ?>
        </div>

        <!-- Display embedded video if video ID is set -->
        <?php if(isset($yvg_video_stored_meta['video_id'][0])) : ?>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $yvg_video_stored_meta['video_id'][0];?>" title="YouTube video player" frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        <?php endif; ?>
    
    </div>

    <?php
}

// Function to save meta data when post is saved or updated
function yvg_video_save($post_id){
    $is_autosave    = wp_is_post_autosave($post_id);
    $is_revision    = wp_is_post_revision($post_id);
    $is_valid_nonce = (isset($_POST['yvg_videos_nonce']) && wp_verify_nonce($_POST['yvg_videos_nonce'], basename(__FILE__))) ? 'true' : 'false';

    // Check if it's an autosave, revision, or nonce is invalid
    if($is_autosave || $is_revision || !$is_valid_nonce){
        return ;
    }

    // Update video ID meta data if set
    if(isset($_POST['video_id'])){
        update_post_meta($post_id, 'video_id', sanitize_text_field($_POST['video_id']));
    }

    // Update video details meta data if set
    if(isset($_POST['details'])){
        update_post_meta($post_id, 'details', sanitize_text_field($_POST['details']));
    }
}

// Hook to save post meta data
add_action('save_post', 'yvg_video_save');

?>
