<?php

class User_model extends CI_Model {

	public $id;
	public $email;
	public $pass;
	public $created_at;
	public $updated_at;


	private $date;

	public function __construct() {
		parent::__construct();
		$this->date = new DateTime();
	}

	public function save_new_user( $email, $pass ) {
		$this->email      = $email; // please read the below note
		$this->pass       = password_hash( $pass, PASSWORD_DEFAULT );
		$this->created_at = $this->date->format( 'c' );
		$this->updated_at = $this->date->format( 'c' );

		$this->db->insert( 'users', $this );
		$this->id = $this->db->insert_id();
		unset( $this->pass );

		return $this->email;
	}


	public function check_if_email_already_exists( $email ) {
		$result = $this->db->get_where( 'users', [ 'email' => $email ] );

		return $result->num_rows();
	}

	public function get_data_by_email( $email ) {
		$query = $this->db->get_where( 'users', [ 'email' => $email ] );
		return $query->result();
	}


}
