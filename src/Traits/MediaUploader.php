<?php


namespace ShippingAppointments\Traits;


Trait MediaUploader {

	public function uploadFile( $uploadedFile ) {

		if ( !function_exists( 'wp_handle_upload' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
		}

		$upload_overrides   = array( 'test_form' => false );
		$movedFile          = wp_handle_upload( $uploadedFile, $upload_overrides );


		if ( ! isset( $movedFile['error'] ) ) {

			$wp_filetype    = $movedFile['type'];
			$filename       = $movedFile['file'];
			$wp_upload_dir  = wp_upload_dir();

			$attachment = array(
				'guid'              => $wp_upload_dir['url'] . '/' . basename( $filename ),
				'post_mime_type'    => $wp_filetype,
				'post_title'        => preg_replace('/\.[^.]+$/', '', basename($filename)),
				'post_content'      => '',
				'post_status'       => 'inherit'
			);

			return wp_insert_attachment( $attachment, $filename);

		}

		return false;

	}

}
