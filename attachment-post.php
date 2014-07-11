<?php
/*
Plugin Name: Post Attachment
version: 1.0
Description: Use Post Attachment for upload your media in directory Year/Month/ for the current year and month, when the date of publication of your article is different.
Author: Beapi
*/

add_action( 'plugins_loaded', 'init_ap_plugin' );

function init_ap_plugin() {
	if( is_admin() ) {
		new Attachment_Post();
	}
}

class Attachment_Post {

	function __construct() {
		add_filter( 'upload_dir', array( __CLASS__, 'upload_dir' ) );
	}

	public static function upload_dir( $params ) {
		if( isset( $_POST['action'] ) && $_POST['action'] == 'upload-attachment' ) {
			$params['subdir'] = '/' .date('Y') . '/' . date('m');
			$params['path']   = $params['basedir'] . $params['subdir'];
			$params['url']    = $params['baseurl'] . $params['subdir'];
		}
		return $params;
	}
}