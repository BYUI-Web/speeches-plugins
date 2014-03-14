<?php
/**
 * Plugin Name: BYU-Idaho Speeches Archive
 * Plugin URI: http://mayanmediagroup.com
 * Description: devotional Directory Plugin
 * Version: 0.1
 * Author: Josh Crowther
 * Author URI: http://joshcrowther.com
 * License: OSS
 */


function admin_dependencies() {
	echo '<link rel="stylesheet" href="'.plugins_url( 'SpeechesArchive/css/token-input.css' , dirname(__FILE__) ).'">';
}

add_action( 'admin_head', 'admin_dependencies');


function my_admin_footer_function() {
	echo '<script src="'.plugins_url( 'SpeechesArchive/js/speechesjs.min.js' , dirname(__FILE__) ).'"></script>';
}
add_action('admin_footer', 'my_admin_footer_function');
/**********************************************/
/***** Register Devotionals Post Types *****/
/**********************************************/
function register_devotionals_posttype() {
	register_post_type( 'devotional',
		array(
			'labels' => array(
				'name' => __( 'Devotionals' ),
				'singular_name' => __( 'Devotional' ),
				'add_new' => __( 'Add New Devotional' ),
				'add_new_item' => __( 'Add New Devotional' ),
				'edit_item' => __( 'Edit Devotional' ),
				'new_item' => __( 'Add New Devotional' ),
				'view_item' => __( 'View Devotional' ),
				'search_items' => __( 'Search Devotionals' ),
				'not_found' => __( 'No Devotionals found' )
				),
			'has_archive' => true,
			'taxonomies' => array('category','post_tag'),
			'public' => true,
			'supports' => array( 'title', 'thumbnail', 'revisions'),
      'rewrite' => array( "slug" => "devotionals" , 'with_front' => true), // Permalinks format
      'menu_position' => 5,
      'register_meta_box_cb' => 'add_devotional_metaboxes'
      )
		);
	flush_rewrite_rules( false );
}
add_action( 'init', 'register_devotionals_posttype' );

/**********************************************/
/******** Register Speakers Post Types ********/
/**********************************************/
function register_speakers_posttype() {
	register_post_type( 'speaker',
		array(
			'labels' => array(
				'name' => __( 'Speakers' ),
				'singular_name' => __( 'Speaker' ),
				'add_new' => __( 'Add New Speaker' ),
				'add_new_item' => __( 'Add New Speaker' ),
				'edit_item' => __( 'Edit Speaker' ),
				'new_item' => __( 'Add New Speaker' ),
				'view_item' => __( 'View Speaker' ),
				'search_items' => __( 'Search Speakers' ),
				'not_found' => __( 'No Speakers found' )
				),
			'has_archive' => true,
			'taxonomies' => array('category'),
			'public' => true,
			'supports' => array( 'title', 'thumbnail', 'revisions'),
      'rewrite' => array( "slug" => "speaker" , 'with_front' => true), // Permalinks format
      'menu_position' => 5,
      'register_meta_box_cb' => 'add_speakers_metaboxes'
      )
		);
	flush_rewrite_rules( false );
}
add_action( 'init', 'register_speakers_posttype' );

/**********************************************/
/*********** Post Thumbnail Support ***********/
/**********************************************/
function create_post_pub()
{
	add_theme_support( 'post-thumbnails', array( 'speaker', 'publicidade' ) );
	add_theme_support( 'thumbnail', array( 'speaker', 'publicidade' ) );
}
add_action( 'init', 'create_post_pub' );
/*************************************************/
/**********     devotional Meta     *********/
/*************************************************/
// Add the devotional Meta Boxes
function add_devotional_metaboxes() {
	add_meta_box('devotional_metaboxes', 'Devotional Information', 'devotional_metaboxes', 'devotional', 'normal', 'default');
}
function add_speakers_metaboxes() {
	add_meta_box('speakers_metaboxes', 'Speaker Information', 'speakers_metaboxes', 'speaker', 'normal', 'default');
}

// The Event Location Metabox
function speakers_metaboxes() {
	global $post;

  // Noncename needed to verify where the data originated
	echo '<input type="hidden" name="speaker_nonce" id="speaker_nonce" value="' .
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

  // Get the location data if its already been entered
	$title = get_post_meta($post->ID, 'title', true);
	$speaker_bio = get_post_meta($post->ID, 'speaker_bio', true);

  	// Echo out the field
	echo '<p>Speaker Title and Department (if relevant): </p>';
	echo '<input type="text" name="title" class="widefat" value="'.$title.'">';
	echo '<p>Speaker Bio: </p>';
	echo '<textarea name="speaker_bio" rows="10" class="widefat">'.$speaker_bio.'</textarea>';
}

// The Event Location Metabox
function devotional_metaboxes() {
	global $post;

  // Noncename needed to verify where the data originated
	echo '<input type="hidden" name="devotional_nonce" id="devotional_nonce" value="' .
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

  // Get the location data if its already been entered
	$video_embed = get_post_meta($post->ID, 'video_embed', true);
	$video_download = get_post_meta($post->ID, 'video_download', true);
	$audio_embed = get_post_meta($post->ID, 'audio_embed', true);
	$audio_download = get_post_meta($post->ID, 'audio_download', true);
	$event_date = get_post_meta($post->ID, 'event_date', true);
	$prep_material = get_post_meta($post->ID, 'prep_material', true);
	$transcript = get_post_meta($post->ID, 'transcript', true);
	$presenters = get_post_meta($post->ID, 'presenters', true);
	$event_start_time = get_post_meta($post->ID, 'event_start_time', true);
	$event_end_time = get_post_meta($post->ID, 'event_end_time', true);
	$live_stream_embed = get_post_meta($post->ID, 'live_stream_embed', true);
	if ($presenters)
		$presentersArray = explode(', ', $presenters);

	echo '<script>';
	echo 'prepopulate = [];';
	if (is_array($presentersArray)) {
		foreach ($presentersArray as $person) {
			echo 'prepopulate.push({ "id" : '. $person . ', "name" : "' . get_the_title($person) . '" });';
		}
	}
	echo 'speakers = [];';

	$loop = new WP_Query( array( 'post_type' => 'speaker') );
	while ( $loop->have_posts() ) : $loop->the_post(); 
	echo 'speakers.push({ "id" : '. get_the_ID() . ', "name" : "' . get_the_title() . '" });';
	endwhile;
	echo '</script>';

  	// Echo out the field
	echo '<p>Event Date:</p>';
	echo '<input type="date" name="event_date" id="event_date" value="'. $event_date .'"/>';
	echo '<p>Start Time:</p>';
	echo '<input type="time" name="event_start_time" id="event_start_time" value="'. $event_start_time .'"/>';
	echo '<p>End Time:</p>';
	echo '<input type="time" name="event_end_time" id="event_end_time" value="'. $event_end_time .'"/>';
	echo '<p>Live Stream:</p>';
	echo '<input type="radio" name="live_stream" id="live_stream_yes" value="yes"/><label for="live_stream_yes">Yes </label><input type="radio" name="live_stream" id="live_stream_no" value="no" checked/><label for="live_stream_no">No</label>';
	echo '<div id="live_stream"><p>Live Stream Embed Code: </p>';
	echo '<textarea rows="4" name="live_stream_embed" class="widefat">'.$live_stream_embed.'</textarea></div>';
	echo '<p>Presenters:</p>';
	echo '<input type="hidden" name="presenters" id="speaker-ids" value="'.$presenters.'"/>';
	echo '<input type="text" id="speaker-names" name="presenters_display" placeholder="Speaker Name" class="widefat"/>';
	echo '<p>Preparatory Material:</p>';
	echo '<input type="text" name="prep_material" value="'. $prep_material .'" class="widefat" />';
	echo '<p>Video Embed Code: </p>';
	echo '<textarea rows="4" name="video_embed" class="widefat">'.$video_embed.'</textarea>';
	echo '<p>Video Download URL: </p>';
	echo '<input type="text" name="video_download" value="' . $video_download  . '" class="widefat" />';
	echo '<p>Audio Embed Code: </p>';
	echo '<textarea rows="4" name="audio_embed" class="widefat">'.$audio_embed.'</textarea>';
	echo '<p>Audio Download URL: </p>';
	echo '<input type="text" name="audio_download" value="' . $audio_download. '" class="widefat" />';
	echo '<p>Transcript: </p>';
	echo '<textarea rows="10" name="transcript" class="widefat">'.$transcript.'</textarea>';
}

// Save the Metabox Data
function save_speaker_meta($post_id, $post) {
  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times
	if ( !wp_verify_nonce( $_POST['speaker_nonce'], plugin_basename(__FILE__) )) {
		return $post->ID;
	}
  // Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;
  // OK, we're authenticated: we need to find and save the data
  // We'll put it into an array to make it easier to loop though.
	$speaker_meta['title'] = $_POST['title'];
	$speaker_meta['speaker_bio'] = $_POST['speaker_bio'];

  // Add values of $speaker_meta as custom fields
	foreach ($speaker_meta as $key => $value) { 
		if( $post->post_type == 'revision' ) 
			return; 

    	// If $value is an array, make it a CSV (unlikely)
		$value = implode(',', (array)$value);

    	// If the custom field already has a value
		if(get_post_meta($post->ID, $key, FALSE)) { 
			update_post_meta($post->ID, $key, $value);
		} else { 
    	// If the custom field doesn't have a value
			add_post_meta($post->ID, $key, $value);
		}
		// Delete if blank
		if(!$value) 
			delete_post_meta($post->ID, $key); 
	}
}
add_action('save_post', 'save_speaker_meta', 1, 2); // save the custom fields

// Save the Metabox Data
function save_devotional_meta($post_id, $post) {
  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times
	if ( !wp_verify_nonce( $_POST['devotional_nonce'], plugin_basename(__FILE__) )) {
		return $post->ID;
	}
  // Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;
  // OK, we're authenticated: we need to find and save the data
  // We'll put it into an array to make it easier to loop though.
	$devotional_meta['video_embed'] = $_POST['video_embed'];
	$devotional_meta['video_download'] = $_POST['video_download'];
	$devotional_meta['audio_embed'] = $_POST['audio_embed'];
	$devotional_meta['audio_download'] = $_POST['audio_download'];
	$devotional_meta['event_date'] = $_POST['event_date'];
	$devotional_meta['prep_material'] = $_POST['prep_material'];
	$devotional_meta['transcript'] = $_POST['transcript'];
	$devotional_meta['presenters'] = $_POST['presenters'];
	$devotional_meta['event_start_time'] = $_POST['event_start_time'];
	$devotional_meta['event_end_time'] = $_POST['event_end_time'];
	$devotional_meta['live_stream_embed'] = $_POST['live_stream_embed'];

  // Add values of $devotional_meta as custom fields
	foreach ($devotional_meta as $key => $value) { 
		if( $post->post_type == 'revision' ) 
			return; 

    	// If $value is an array, make it a CSV (unlikely)
		$value = implode(',', (array)$value);

    	// If the custom field already has a value
		if(get_post_meta($post->ID, $key, FALSE)) { 
			if ($key != 'video_embed' && $key != 'audio_embed' && $key != 'live_stream_embed')
				update_post_meta($post->ID, $key, $value);
			else
				update_post_meta($post->ID, $key, wpdb::prepare($value));
		} else { 
    	// If the custom field doesn't have a value
			if ($key != 'video_embed' && $key != 'audio_embed' && $key != 'live_stream_embed')
				add_post_meta($post->ID, $key, $value);
			else
				add_post_meta($post->ID, $key, wpdb::prepare($value));
		}
		// Delete if blank
		if(!$value) 
			delete_post_meta($post->ID, $key); 
	}
}
add_action('save_post', 'save_devotional_meta', 1, 2); // save the custom fields

function get_events_pagetype($single_template) {
	global $post;

	if ($post->post_type == 'devotional') {
		$single_template = dirname( __FILE__ ) . '/event_template.php';
	}
	return $single_template;
}
add_filter( 'single_template', 'get_events_pagetype' );

function get_custom_post_type_template( $archive_template ) {
     global $post;

     if ( is_post_type_archive ( 'devotional' ) ) {
          $archive_template = dirname( __FILE__ ) . '/event_archive.php';
     }
     return $archive_template;
}

add_filter( 'archive_template', 'get_custom_post_type_template' ) ;
?>