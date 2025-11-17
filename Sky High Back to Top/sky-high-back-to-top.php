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

defined( 'ABSPATH' ) || exit;

define( 'SKYBT_VERSION', '1.0.0' );
define( 'SKYBT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * Output the Back to Top button markup.
 *
 * @since 1.0.0
 */
function skybt_add_backtotop_button() {
    ?>
    <button id="toTop" type="button" aria-label="<?php esc_attr_e( 'Scroll to top', 'skybt' ); ?>">
        <span class="dashicons dashicons-arrow-up-alt2"></span>
    </button>
    <?php
}
add_action( 'wp_footer', 'skybt_add_backtotop_button' );

/**
 * Enqueue plugin styles and scripts and add inline styles from customizer.
 *
 * @since 1.0.0
 */
function skybt_enqueue_assets() {
    if ( ! wp_style_is( 'dashicons' ) ) {
        wp_enqueue_style( 'dashicons' );
    }
    wp_enqueue_style( 'skybt-style', SKYBT_PLUGIN_URL . 'assets/css/style.css', [], SKYBT_VERSION );
    wp_enqueue_script( 'skybt-script', SKYBT_PLUGIN_URL . 'assets/js/script.js', ['jquery'], SKYBT_VERSION, true );

    $bg = get_theme_mod( 'skybt_bg_color', '#0073aa' );
    $bg = sanitize_hex_color( $bg );

    if ( $bg ) {
        $custom_css = ":root { --button-bg: {$bg}; }";
        wp_add_inline_style( 'skybt-style', $custom_css );
    }
}
add_action( 'wp_enqueue_scripts', 'skybt_enqueue_assets' );

/**
 * Register Back to Top button background color setting in the Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 *
 * @since 1.0.0
 */
function skybt_customize_register( $wp_customize ) {
    $wp_customize->add_setting( 'skybt_bg_color', [
        'default'           => '#0073aa',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'skybt_bg_color', [
        'label'   => __( 'Back to top BG color', 'skybt' ),
        'section' => 'colors',
    ]));
}
add_action( 'customize_register', 'skybt_customize_register' );
