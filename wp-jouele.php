<?php
/**
 * @package wp-jouele
 */
/*
Plugin Name: Jouele for Wordpress
Plugin URI: https://github.com/beshur/wp-jouele
Version: 0.2.0
Description: Insert audio files with a great Jouele player. Jouele player by Ilya Birman (https://github.com/ilyabirman/Jouele).
Author: alexbuznik
Author URI: http://buznik.com/
License: GPLv2 or later
Text Domain: wp-jouele
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


function load_static() {

	wp_enqueue_script( 'jouele', plugins_url( 'jouele/jouele.min.js', __FILE__ ), array('jquery',), null, true );

	wp_enqueue_style( 'jouele', plugins_url( 'jouele/jouele.min.css', __FILE__ ), null, null );

}
add_action( 'init', 'load_static' );


add_shortcode( 'wp-jouele', 'wp_jouele_link' );
function wp_jouele_link( $atts, $content = null ) {
    $html = trim($content);
    if ($html != null || $html != "") {
    	// find 'class' in the first a tag
    	$aEnd = strpos($html, '>');

    	$classStart = strpos($html, 'class=');
    	if ($classStart != false
    		&& $classStart < $aEnd) {
    		$html = substr($html, 0, $classStart + 7) . 'jouele ' . substr($html, $classStart + 7);
    	} else {
    		$html = substr($html, 0, $aEnd) . ' class="jouele"' . substr($html, $aEnd);
    	}

    	return $html;
    } else {
    	return $html;
    }

}

add_action( 'init', 'wp_jouele_buttons' );
function wp_jouele_buttons() {
    add_filter( "mce_external_plugins", "wp_jouele_add_buttons" );
    add_filter( 'mce_buttons', 'wp_jouele_register_buttons' );
}
function wp_jouele_add_buttons( $plugin_array ) {
    $plugin_array['wp_jouele'] = plugins_url( '/editor-buttons/buttons.js', __FILE__);
    return $plugin_array;
}
function wp_jouele_register_buttons( $buttons ) {
    array_push( $buttons, 'jouele_link' );
    return $buttons;
}
