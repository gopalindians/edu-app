<?php
/**
 * Project: edu_app
 * Author: gopalindians <gopalindians@gmail.com>
 * Date: 07-05-2018
 * Time: 00:27
 * Link:
 */

defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Tag extends CI_Controller {

	private $tag_search_term;

	public function __construct() {
		parent::__construct();
		$this->load->model( 'tag_model' );
	}

	public function search(): void {
		$this->tag_search_term = $this->input->post( 'term' );

		$this->output
			->set_content_type( 'application/json' )
			->set_output( json_encode( [
				'csrf'        => $this->security->get_csrf_hash(),
				'suggestions' => $this->tag_model->fetch_similar_tags( $this->tag_search_term )
			] ) );
	}
}