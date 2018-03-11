<?php
/**
 * Project: edu_app
 * Author: gopalindians <$USER_EMAIL>
 * Date: 10-03-2018
 * Time: 17:54
 * Link:
 */

class Question_model extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->date = new DateTime();
	}

	public function get_questions( $limit, $offset ) {
		$this->db->limit( $limit );
		$this->db->offset( $offset );
		$this->db->order_by( 'created_at', 'DESC' );
		$query = $this->db->get( 'questions' );

		return $query->result();

	}
}