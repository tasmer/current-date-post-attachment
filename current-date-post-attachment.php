<?php
/*
Plugin Name: Current date Post Attachment
Description: Use Post Attachment for upload your media in directory Year/Month/ for the current year and month, when the date of publication of your article is different.
Author: Be API
Author URI: http://beapi.fr
version: 1.0

----
 Copyright 2016 BE API Technical team (human@beapi.fr)

 This program is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

*/

add_action( 'plugins_loaded', 'init_ap_plugin' );

/**
 * Init plugin.
 *
 */
function init_ap_plugin() {
	if ( is_admin() ) {
		new Current_Date_Post_Attachment();
	}
}

/**
 * Class Current_Date_Post_Attachment
 */
class Current_Date_Post_Attachment {
	/**
	 * Current_Date_Post_Attachment constructor.
	 */
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
		if ( ! isset( $_POST['action'] ) && $_POST['action'] !== 'upload-attachment' ) {
			return $params;
		}

		$params['subdir'] = '/' . date( 'Y' ) . '/' . date( 'm' );
		$params['path']   = $params['basedir'] . $params['subdir'];
		$params['url']    = $params['baseurl'] . $params['subdir'];


		return $params;
	}
}