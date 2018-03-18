<?php

class User_meta_model extends CI_Model {

	private $user_id;
	private $first_name;
	private $last_name;
	private $age;
	private $location;
	private $facebook_url;
	private $twitter_url;
	private $instagram_url;
	private $created_at;
	private $updated_at;
	private $about;
	private $hobbies;


	private $date;

	public function __construct() {
		parent::__construct();
		$this->date = new DateTime();
	}

	public function save_new_user_meta( $user_id, $first_name = '', $last_name = '' ) {
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

	public function get_data_by_user_id( $user_id ) {
		$query = $this->db->get_where( 'users_meta_info', [ 'user_id' => $user_id ] );

		return $query->result();
	}

	public function check_if_email_and_pass_matches( $user_email, $user_pass ) {
		$result = $this->db->get_where( 'users', [
			'email' => $user_email,
		] );
		if ( password_verify( $user_pass, $result->result()[0]->pass ) ) {
			return true;
		}

		return false;
	}


	public function update_user_meta_info( $user_id, $first_name = '', $last_name = '', $about = '', $hobbies = '' ) {
		if ( empty( $this->get_data_by_user_id( $user_id ) ) ) {
			$this->user_id    = $user_id;
			$this->first_name = $first_name;
			$this->last_name  = $last_name;
			$this->created_at = $this->date->format( 'c' );
			$this->updated_at = $this->date->format( 'c' );

			$this->db->insert( 'users_meta_info', $this );

			/*$this->db->set( 'first_name', $first_name );
			$this->db->set( 'last_name', $last_name );
			$this->db->where( 'user_id', $user_id );
			$this->db->update( 'users_meta_info' );*/
		} else {
			$this->db->set( 'first_name', $first_name );
			$this->db->set( 'last_name', $last_name );
			$this->db->set( 'about', $about );
			$this->db->set( 'hobbies', $hobbies );
			$this->db->set( 'updated_at', $this->date->format( 'c' ) );
			$this->db->where( 'user_id', $user_id );
			$this->db->update( 'users_meta_info' );
		}

		return true;
	}
}
