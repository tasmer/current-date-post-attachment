<?php
/*
Plugin Name: Current date Post Attachment
version: 1.0
Description: Use Post Attachment for upload your media in directory Year/Month/ for the current year and month, when the date of publication of your article is different.
Author: Beapi
*/

add_action( 'plugins_loaded', 'init_ap_plugin' );

/**
 * Init plugin.
 *
 */
function init_ap_plugin() {
	if( is_admin() ) {
		new Current_Date_Post_Attachment();
	}
}

/**
 * Class Current_Date_Post_Attachment
 */
class Current_Date_Post_Attachment {

	function __construct() {
		add_filter( 'upload_dir', array( __CLASS__, 'upload_dir' ) );
	}

	/**
	 * Filter the upload directory datas
	 *
	 * @param array $params Array of upload directory data.
	 *
	 * @return mixed
	 */
	public static function upload_dir( $params ) {
		if( isset( $_POST['action'] ) && $_POST['action'] == 'upload-attachment' ) {
			$params['subdir'] = '/' .date('Y') . '/' . date('m');
			$params['path']   = $params['basedir'] . $params['subdir'];
			$params['url']    = $params['baseurl'] . $params['subdir'];
		}
		return $params;
	}
}