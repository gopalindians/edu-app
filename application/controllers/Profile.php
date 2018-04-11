<?php
/**
 * Project: edu_app
 * Author: gopalindians <$USER_EMAIL>
 * Date: 11-03-2018
 * Time: 01:21
 * Link:
 */

class Profile extends CI_Controller {

	private $first_name;
	private $last_name;
	private $about;
	private $hobbies;

	private $user_id;
	private $limit;
	private $offset;

	public function __construct() {
		parent::__construct();
		$this->load->helper( [ 'form', 'url', 'file', 'app' ] );
		$this->load->library( [ 'form_validation', 'session', 'pagination', 'upload', 'minify' ] );
		$this->load->model( 'user_model' );
		$this->load->model( 'user_meta_model' );
		$this->load->model( 'question_model' );
	}

	public function view( $profile_id, $safe_email ): void {
		//$config['per_page']          = self::PER_PAGE;
		$config['base_url'] = base_url() . '/home/index/';
		//$config['total_rows']        = $this->question_model->record_count();

		$config['user_page_numbers'] = true;
		$config['full_tag_open']     = '<div class="pagging text-center"><nav><ul class="pagination">';
		$config['full_tag_close']    = '</ul></nav></div>';

		$config['num_tag_open']  = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close'] = '</span></li>';

		$config['cur_tag_open']  = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';

		$config['next_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close'] = '<span aria-hidden="true">Next</span></span></li>';

		$config['prev_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close'] = '</span></li>';

		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';

		$config['last_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close'] = '</span></li>';
		$config['per_page']        = 5;

		if ( $this->input->get( 'offset' ) ) {
			$offset = $this->input->get( 'offset' );
		} else {
			$offset = 0;
		}
		$total_questions = $this->question_model->num_rows( $profile_id );
		$questions       = $this->question_model->get_questions( $config['per_page'], $offset, $profile_id );
		$user_info       = $this->user_model->get_data_by_id( $this->uri->segment( 2 ) );

		if ( isset( $user_info[0]->id ) ) {
			$user_meta_info = $this->user_meta_model->get_data_by_user_id( $user_info[0]->id );
		} else {
			$user_meta_info = '';
		}
		foreach ( $questions['all_questions'] as $question ) {
			$question->question_description = ( strlen( $question->question_description ) > 40 ) ? substr( $question->question_description, 0, 41 ) . '...' : $question->question_description;
		}

		$this->pagination->initialize( $config );
		$pagination = $this->pagination->create_links();

		$this->load->view( 'layout/header' );
		$this->load->view( 'profile/view', [
			'total_questions'          => $total_questions,
			'questions'                => $questions['all_questions'],
			'questions_current_offset' => $questions['current_offset'],
			'pagination'               => $pagination,
			'user_info'                => $user_info,
			'user_meta_info'           => $user_meta_info,
		] );
		$this->load->view( 'layout/footer' );
	}

	public function edit( $profile_id, $safe_email ): void {

		if ( checkAuth( $this ) ) {

			$user_info      = $this->user_model->get_data_by_id( $this->uri->segment( 2 ) );
			$user_meta_info = $this->user_meta_model->get_data_by_user_id( $this->uri->segment( 2 ) );
			$this->load->view( 'layout/header' );
			$this->load->view( 'profile/edit', [
				'user_info'      => $user_info,
				'user_meta_info' => $user_meta_info,
			] );
			$this->load->view( 'layout/footer' );
		} else {
			redirect( base_url( '/auth/login' ) );
		}
	}

	public function edit_post( $profile_id, $safe_email ): void {
		$this->first_name = $this->input->post( 'first_name' );
		$this->last_name  = $this->input->post( 'last_name' );
		$this->about      = $this->input->post( 'about' );
		$this->hobbies    = $this->input->post( 'hobbies' );


		$this->load->view( 'layout/header' );
		$user_data = $this->user_model->get_data_by_id( $profile_id );
		if ( isset( $_FILES['profile_image'] ) && ! empty( $_FILES['profile_image']['name'] ) ) {
			$config['upload_path']   = 'uploads';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
			$config['max_size']      = 300;
			$config['max_width']     = 1024;
			$config['max_height']    = 768;
			$config['encrypt_name']  = true;
			$new_name                = time() . $_FILES['profile_image']['name'];
			$config['file_name']     = $new_name;
			$this->upload->initialize( $config );

			if ( ! $this->upload->do_upload( 'profile_image' ) ) {
				$errors              = $this->upload->display_errors();
				$response['message'] = 'Unable to update profile';
				$response['type']    = 'warning';
				$response['data']    = $errors;
				$this->user_meta_model->update_user_meta_info( $this->uri->segment( 2 ), $this->first_name, $this->last_name, $this->about, $this->hobbies );
				$user_info      = $this->user_model->get_data_by_id( $this->uri->segment( 2 ) );
				$user_meta_info = $this->user_meta_model->get_data_by_user_id( $this->uri->segment( 2 ) );

				$this->load->view( 'profile/edit', [
					'user_info'      => $user_info,
					'user_meta_info' => $user_meta_info,
					'response'       => $response
				] );

			} else {
				$success             = $this->upload->data();
				$response['message'] = 'Profile updated successfully';
				$response['type']    = 'success';
				$response['data']    = 'Profile updated successfully';

				$this->user_model->update_user_profile_image( $this->uri->segment( 2 ), $success['file_name'] );
				$this->user_meta_model->update_user_meta_info( $this->uri->segment( 2 ), $this->first_name, $this->last_name, $this->about, $this->hobbies );
				$user_info      = $this->user_model->get_data_by_id( $this->uri->segment( 2 ) );
				$user_meta_info = $this->user_meta_model->get_data_by_user_id( $this->uri->segment( 2 ) );


				//delete previous image from the uploads folder if the image is not a URL
				if ( isset( $user_data[0]->profile_image ) && filter_var( $user_data[0]->profile_image, FILTER_VALIDATE_URL ) == false && file_exists( 'uploads/' . $user_data[0]->profile_image ) ):
					try {
						unlink( 'uploads/' . $user_data[0]->profile_image );
					} catch ( Exception $exception ) {

					}
				endif;

				$this->load->view( 'profile/edit', [
					'user_info'      => $user_info,
					'user_meta_info' => $user_meta_info,
					'response'       => $response
				] );
			}
		} else {
			$this->user_meta_model->update_user_meta_info( $this->uri->segment( 2 ), $this->first_name, $this->last_name, $this->about, $this->hobbies );
			$response['message'] = 'Profile updated successfully';
			$response['type']    = 'success';
			$response['data']    = 'Profile updated successfully';
			$user_info           = $this->user_model->get_data_by_id( $this->uri->segment( 2 ) );
			$user_meta_info      = $this->user_meta_model->get_data_by_user_id( $this->uri->segment( 2 ) );
			$this->load->view( 'profile/edit', [
				'user_info'      => $user_info,
				'user_meta_info' => $user_meta_info,
				'response'       => $response
			] );
		}
		$this->load->view( 'layout/footer' );
	}

	public function get_more_questions(): void {
		/*$question_id, $limit, $offset*/
		$this->user_id = $this->input->post( 'user_id' );
		$this->limit   = $this->input->post( 'limit' );
		$this->offset  = $this->input->post( 'offset' );

		$more_questions = $this->question_model->get_questions( $this->limit, $this->offset, $this->user_id );

		$this->output
			->set_content_type( 'application/json' )
			->set_output( json_encode( [
				'result' => $more_questions,
				'csrf'   => $this->security->get_csrf_hash(),
			] ) );
	}
}