<?php
/*
Plugin Name: YouTube Video Gallery
Plugin URI: https://homeandedibles.com/taofeeq-masud-portfolio/
Description: Add A YouTube video gallery to your website. 
Version: 1.0
Author: Taofeeq Mas'ud
Author URI: https://homeandedibles.com/taofeeq-masud-portfolio/
Text Domain: todo-list-plugin
Domain Path: /languages
*/

// Exit if accessed directly

if (!defined('ABSPATH')){
    exit;
}


// Load Scripts
require_once(plugin_dir_path(__FILE__).'/includes/youtube-vid-gallery-scripts.php');

// Load Shortcodes
require_once(plugin_dir_path(__FILE__).'/includes/youtube-vid-gallery-shortcodes.php');


if(is_admin()){
  // Load Custom Post Type
  require_once(plugin_dir_path(__FILE__).'/includes/youtube-vid-gallery-cpt.php');

   // Load Settings
   require_once(plugin_dir_path(__FILE__).'/includes/youtube-vid-gallery-settings.php');

   // Custom Fields 
   require_once(plugin_dir_path(__FILE__).'/includes/youtube-vid-gallery-fields.php');
}
