<?php

// Initialize settings API for YouTube Vid Gallery
function yvg_settings_api_init(){
    // Add settings section for YouTube Vid Gallery under Reading settings
    add_settings_section(
        'yvg_setting_section', // Unique identifier for the section
        'YouTube Vid Gallery Settings', // Title displayed for the section
        'yvg_setting_section_callback', // Callback function to display section content
        'reading' // Page where the section will be displayed (Reading settings page)
    );
   
    // Add settings field for Disable Fullscreen option under YouTube Vid Gallery section
    add_settings_field(
        'yvg_setting_disable_fullscreen', // Unique identifier for the field
        'Disable Fullscreen', // Label displayed for the field
        'yvg_setting_disable_fullscreen_callback', // Callback function to display field content
        'reading', // Page where the field will be displayed (Reading settings page)
        'yvg_setting_section' // Section to which the field belongs (YouTube Vid Gallery section)
    );

    // Register the setting for Disable Fullscreen option
    register_setting('reading', 'yvg_setting_disable_fullscreen');
}

// Hook the yvg_settings_api_init function to admin_init action
add_action('admin_init','yvg_settings_api_init');

// Callback function to display content for YouTube Vid Gallery section
function yvg_setting_section_callback(){
    echo '<p>Settings For YouTube Vid Gallery</p>'; // Display a paragraph with section description
}

// Callback function to display content for Disable Fullscreen option
function yvg_setting_disable_fullscreen_callback(){
    // Display a checkbox input for Disable Fullscreen option
    echo '<input type="checkbox" name="yvg_setting_disable_fullscreen" id="yvg_setting_disable_fullscreen" value="1" class="code" ' . checked(1, get_option('yvg_setting_disable_fullscreen'), false) . '>';
}

?>

<!--
   Explanation:

    The code initializes the WordPress settings API to create a settings section and a settings field under the Reading settings page.  The yvg_settings_api_init function sets up the section and field, while the yvg_setting_section_callback and yvg_setting_disable_fullscreen_callback functions define the content for the section and field, respectively.
    The add_action function hooks the yvg_settings_api_init function to the admin_init action to ensure it runs when the WordPress admin area is initialized.
    The register_setting function registers the setting for the Disable Fullscreen option, allowing it to be saved and retrieved using the WordPress options system.

-->