<?php
/*
 * Plugin Name:       Sky High Back to Top
 * Plugin URI:        https://princewebdev.com/plugin-back-to-top
 * Description:       Sky High Back to Top adds a beautiful, lightweight, and fully customizable “Scroll to Top” button to your WordPress site. It smoothly takes users back to the top of the page with elegant animation and modern styling.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Shariar Mahmud Prince
 * Author URI:        https://princewebdev.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://princewebdev.com/contact
 * Text Domain:       skybt
 * Domain Path:       /languages
 */

defined( 'ABSPATH' ) || exit();

// Define Constant
define( "VERSION" , time() );
define( "FILE" , plugin_dir_url(__FILE__) );

function skybt_action(){
   ?>
   <button id="toTop" aria-label="<?php esc_attr_e( 'Scroll to top', 'skybt' ) ?>">
        <span class="dashicons dashicons-arrow-up-alt2"></span> 
    </button>
   <?php
}
add_action('wp_footer', 'skybt_action');

function skybt_assets(){

    wp_enqueue_style( 'skybt-style',  FILE . 'assets/css/style.css','', VERSION, false );
    wp_enqueue_script( 'skybt-script', FILE. 'assets/js/script.js', ['jquery'], VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'skybt_assets' );