<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

/**
 * Project: edu_app
 * Author: gopalindians <gopalindians@gmail.com>
 * Date: 26-02-2018
 * Time: 01:23
 * Link:
 */
class Report extends CI_Controller {

	private $question_id;
	private $report_type;
	private $user_id;

	public function __construct() {
		parent::__construct();
		$this->load->library( [ 'session' ] );
		$this->load->model( 'report_model' );
	}

	public function index(): void {
		$this->question_id = $this->input->post( 'question_id' );
		$this->report_type = $this->input->post( 'type' );
		$this->user_id     = $this->session->userdata( 'UE' );

		$this->report_model->save_new_report( $this->question_id, $this->report_type, $this->user_id );

		$this->output
			->set_content_type( 'application/json' )
			->set_output( json_encode( [
				'status_code' => 201,
				'message'     => 'Report submitted successfully!',
			] ) );
	}



}