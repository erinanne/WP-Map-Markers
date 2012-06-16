<?php

/**
 * Include and setup custom metaboxes and fields.
 *
 * @category WP Map Markers
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */
add_filter( 'cmb_meta_boxes', 'cmb_wpmm_metaboxes' );

/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_wpmm_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_wpmm_';

	$meta_boxes[] = array(
		'id' => 'wpmm_metabox',
		'title' => 'Map Markers Options',
		'pages' => array( 'wpmm_location', ), // Post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Location name',
				'desc' => 'the name of the location',
				'id' => $prefix . 'location_name',
				'type' => 'text',
			),
			array(
				'name' => 'Dsiplay on map',
				'desc' => 'check to display this location on the global map',
				'id'   => $prefix . 'displayonmap',
				'type' => 'checkbox',
			),	
			array(
				'name' => 'Latitude',
				'desc' => 'the latitude of the location',
				'id' => $prefix . 'latitude',
				'type' => 'text',
			),		
			array(
				'name' => 'Longitude',
				'desc' => 'the longitude of the location',
				'id' => $prefix . 'longitude',
				'type' => 'text',
			),					
		),
	);

	// Add other metaboxes as needed

	return $meta_boxes;
}



add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );

/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( !class_exists( 'cmb_Meta_Box' ) )
		require_once 'metabox/init.php';
}

add_filter( 'cmb_meta_box_url', 'windows_cmb_meta_box_url' );

function windows_cmb_meta_box_url( $url ) {
	return trailingslashit( str_replace( '\\', '/', str_replace( str_replace( '/', '\\', WP_CONTENT_DIR ), WP_CONTENT_URL, $url ) ) );
}