<?php
/**
 * Project: edu_app
 * Author: gopalindians <$USER_EMAIL>
 * Date: 24-02-2018
 * Time: 17:37
 * Link:
 */

class Admin_model extends CI_Model {
	public $admin_id;
	public $admin_email;
	public $admin_pass;
	public $created_at;
	public $updated_at;

	private $date;

	public function __construct() {
		parent::__construct();
		$this->date = new DateTime();
	}


	public function save_new_admin( $admin_email, $pass ) {
		$this->admin_email = $admin_email;
		$this->admin_pass  = password_hash( $pass, PASSWORD_DEFAULT );
		$this->created_at  = $this->date->format( 'c' );
		$this->updated_at  = $this->date->format( 'c' );

		$this->db->insert( 'admins', $this );
		$this->admin_id = $this->db->insert_id();
		unset( $this->pass );

		return $this->admin_email;
	}

	public function check_if_email_already_exists( $email ) {
		$result = $this->db->get_where( 'admins', [ 'admin_email' => $email ] );

		return $result->num_rows();
	}


	public function check_if_admin_email_and_admin_pass_matches( $admin_email, $admin_pass ) {
		$result = $this->db->get_where( 'admins', [
			'admin_email' => $admin_email,
		] );
		if ( password_verify( $admin_pass, $result->result()[0]->admin_pass ) ) {
			return true;
		} else {
			return false;
		}
	}
}