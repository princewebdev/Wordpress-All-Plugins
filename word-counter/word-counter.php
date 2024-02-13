<?php
/*
 * Plugin Name:       Word Counter
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Prince
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       wordc
 * Domain Path:       /languages
 */


add_action('plugin_loaded', 'wordc_load_text_domain');
function wordc_load_text_domain(){
load_plugin_textdomain('wct', false, dirname(__FILE__)."/languages");
}

add_filter( 'the_content', 'wordc_word_count' );
function wordc_word_count($word){
   $word = strip_tags($word);
   $wordn = str_word_count($word);
   $heading = apply_filters('wordc_head', "Your Total Word is"); 
   $tag = apply_filters( 'wordc_tag', 'h3');
   $total =  sprintf("%s <br> <%s> %s : %s</%s>", $word, $tag, $heading,  $wordn, $tag);
   return  __($total, 'wordc');
}