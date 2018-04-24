<?php

class User_model extends CI_Model {

	public $id;
	public $email;
	public $pass;
	public $profile_image;
	public $created_at;
	public $updated_at;


	private $date;

	public function __construct() {
		parent::__construct();
		$this->date = new DateTime();
	}

	public function save_new_user( $email, $pass, $profile_image = '' ): array {
		$data = [
			'email'         => $email,
			'pass'          => password_hash( $pass, PASSWORD_DEFAULT ),
			'profile_image' => $profile_image,
			'created_at'    => $this->date->format( 'c' ),
			'updated_at'    => $this->date->format( 'c' )
		];
		//$this->db->set( $data );
		$this->db->insert( 'users', $data );
		$this->id = $this->db->insert_id();


		return [ 'email' => $email, 'user_id' => $this->id ];
	}


	public function check_if_email_already_exists( $email ): int {
		$result = $this->db->get_where( 'users', [ 'email' => $email ] );

		return $result->num_rows();
	}

	public function get_data_by_email( $email ): array {
		$query = $this->db->get_where( 'users', [ 'email' => $email ] );

		return $query->result();
	}

	public function get_data_by_id( $user_id ): array {
		$query = $this->db->get_where( 'users', [ 'id' => $user_id ] );

		return $query->result();
	}

	public function check_if_email_and_pass_matches( $user_email, $user_pass ): ?bool {
		$result = $this->db->get_where( 'users', [
			'email' => $user_email,
		] );
		if ( password_verify( $user_pass, $result->result()[0]->pass ) ) {
			return TRUE;
		}
		return false;
	}

	/**
	 * @param int    $user_id            User id of the currently logged in user
	 * @param string $user_profile_image Profile image of user
	 *
	 * @return bool
	 */
	public function update_user_profile_image( $user_id, $user_profile_image = '' ): bool {
		$this->db->set( 'profile_image', $user_profile_image );
		$this->db->set( 'updated_at', $this->date->format( 'c' ) );
		$this->db->where( 'id', $user_id );
		$this->db->update( 'users' );

		return true;
	}
}
