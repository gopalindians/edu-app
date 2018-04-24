<?php
/**
 * Project: edu_app
 * Author: gopalindians <$USER_EMAIL>
 * Date: 10-03-2018
 * Time: 17:54
 * Link:
 */

class User_model extends CI_Model {

	private $date;

	public function __construct() {
		parent::__construct();
		/*$this->date = new DateTime();*/
	}

	public function get_users( $limit, $offset ) {
		$this->db->limit( $limit );
		$this->db->offset( $offset );
		$this->db->order_by( 'created_at', 'DESC' );
		$query = $this->db->get( 'users' );

		return $query->result();

	}
}