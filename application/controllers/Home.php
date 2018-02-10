<?php
/**
 * Project: edu_app
 * Author: gopalindians <$USER_EMAIL>
 * Date: 07-01-2018
 * Time: 20:01
 * Link:
 */

defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );


class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper( [ 'form', 'url' ] );
		$this->load->library( [ 'form_validation', 'session', 'pagination' ] );
		$this->load->model( [ 'user_model', 'question_model' ] );

		$config['base_url']          = base_url() . 'index.php/home/index/';
		$config['per_page']          = 20;
		$config['user_page_numbers'] = true;
		$config['full_tag_open']     = '<div class="pagging text-center"><nav><ul class="pagination">';
		$config['full_tag_close']    = '</ul></nav></div>';
		$config['num_tag_open']      = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']     = '</span></li>';
		$config['cur_tag_open']      = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']     = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']   = '<span aria-hidden="true">Next</span></span></li>';
		$config['prev_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']   = '</span></li>';
		$config['first_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close']  = '</span></li>';
		$config['last_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']   = '</span></li>';
	}

	public function index() {
		$this->load->view( 'layout/header' );
		$this->load->view( 'layout/sidebar' );

		$questions = $this->question_model->get_questions();
		foreach ( $questions['all_questions'] as $question ) {
			$question->question_description = ( strlen( $question->question_description ) > 40 ) ? substr( $question->question_description, 0, 41 ) . '...' : $question->question_description;
		}

		$config['total_rows'] = $questions['total_questions'];
		$config['num_links']  = $questions['total_questions'];
		$this->pagination->initialize( $config );
		$pagination = $this->pagination->create_links();

		$this->load->view( 'home/index', [
			'questions'  => $questions['all_questions'],
			'pagination' => $pagination
		] );

		$this->load->view( 'layout/footer' );
	}
}