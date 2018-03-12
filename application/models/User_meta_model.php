<?php

class User_meta_model extends CI_Model {

	public $user_id;
	public $first_name;
	public $last_name;
	public $age;
	public $location;
	public $facebook_url;
	public $twitter_url;
	public $instagram_url;
	public $created_at;
	public $updated_at;


	private $date;

	public function __construct() {
		parent::__construct();
		$this->date = new DateTime();
	}

	public function save_new_user_meta( $user_id, $first_name, $last_name ) {
		$this->user_id    = $user_id;
		$this->first_name = $first_name;
		$this->last_name  = $last_name;
		$this->created_at = $this->date->format( 'c' );
		$this->updated_at = $this->date->format( 'c' );

		$this->db->insert( 'users_meta_info', $this );

		return $this;
	}


	public function check_if_email_already_exists( $email ) {
		$result = $this->db->get_where( 'users', [ 'email' => $email ] );

		return $result->num_rows();
	}

	public function get_data_by_email( $email ) {
		$query = $this->db->get_where( 'users', [ 'email' => $email ] );

		return $query->result();
	}

	public function check_if_email_and_pass_matches( $user_email, $user_pass ) {
		$result = $this->db->get_where( 'users', [
			'email' => $user_email,
		] );
		if ( password_verify( $user_pass, $result->result()[0]->pass ) ) {
			return true;
		} else {
			return false;
		}
	}
}
