<?php if ( ! defined( 'BASEPATH' ) ) {
	exit( 'No direct script access allowed' );
}
$config['seo_title']  = getenv( 'APP_NAME' );
$config['seo_desc']   = getenv( 'APP_DESCRIPTION' );
$config['seo_imgurl'] = getenv( 'APP_IMAGE_URL' );