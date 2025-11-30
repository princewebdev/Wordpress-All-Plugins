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

class Cptp_initial{
    public function __construct(){
        add_action('init', array( $this, 'cptp_register_post_type'));
        add_action('add_meta_boxes', array( $this, 'cptp_meta_box'));
        add_action('save_post', array($this, 'save_portfolio_meta'));
    }

    // Register portfolio post type 
    public function cptp_register_post_type(){
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
            'show_in_rest' 	=> true,
        ];

        register_post_type('cptp_portfolio', $args);
    }

    // add Metabox api
    public function cptp_meta_box(){
        add_meta_box(
            'cptp-add-meta',
            __( 'Add Portfolio Link', 'cptp'),
            array( $this, 'cptp_metbox_content'),
            'cptp_portfolio',
            'advanced',
			'default'
        );
    }

    public function cptp_metbox_content(){
        global $post;
        $post_id = $post -> ID;
        
        // get data from db 
        $data = get_post_meta( $post_id, 'cptp-portfolio-link', true );

        ob_start();
        echo '<input placeholder="https://princewebdev.com" size="30" type="url" value="' . esc_url( $data ) . '" name="cptp_portfolio_link" />';
        ob_end_flush();

        
    }

    public function save_portfolio_meta( ){
        $post_id = isset( $_POST[ 'post_ID'] ) ?  $_POST[ 'post_ID'] : "";
        $data = isset($_POST[ 'cptp_portfolio_link']) ? $_POST[ 'cptp_portfolio_link'] : '';

        $data = esc_url_raw( $data );
        update_post_meta( $post_id ,'cptp-portfolio-link', $data );
    }

}

new Cptp_initial();
