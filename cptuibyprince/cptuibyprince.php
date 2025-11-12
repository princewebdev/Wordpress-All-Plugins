<?php
/*
 * Plugin Name:       CPT UI By Prince
 * Plugin URI:        #
 * Description:       Handle the basics with this plugin.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Shariar Mahmud Prince
 * Author URI:        https://princewebdev.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       cptp
 * Domain Path:       /languages
 */

defined('ABSPATH') || exit();

function cptp_register_post_type(){
    $labels = [
        'name'          => 'Portfolios',
        'singular_name' => 'Portfolio',
        'add_new_item'  => 'Add Protfolio',
        'new_item'      => 'New Protfolio',
        'view_item'     => 'View Portfolio',
        'all_items'     => 'All Portfolios'
        
    ];

    $args = [
        'labels'        => $labels,
        'public'        => true,
        'has_archive'   => true,
        'menu_icon'     => 'dashicons-portfolio',
        'supports'      => ['thumbnail', 'title'],
        'taxonomies'    => ['post_tag'],
        'show_in_rest' => true,

    ];

    register_post_type('cptp_portfolio', $args);
}
add_action('init', 'cptp_register_post_type');


