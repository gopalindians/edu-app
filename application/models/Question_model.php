<?php
/**
 * Project: edu_app
 * Author: gopalindians <$USER_EMAIL>
 * Date: 09-02-2018
 * Time: 00:05
 * Link:
 */

class Question_model extends CI_Model {

	private $question_posted_by;
	private $question_text;
	private $question_description;
	private $date;
	private $created_at;
	private $updated_at;

	public function __construct() {
		parent::__construct();
		$this->date = new DateTime();
	}

	public function save_new_question( $question_posted_by, $question_text, $question_description = '' ) {
		$this->question_text = $question_text;
		if ( $question_description !== '' ) {
			$this->question_description = $question_description;
		}
		$this->question_posted_by = $question_posted_by;
		$this->created_at         = $this->date->format( 'c' );
		$this->updated_at         = $this->date->format( 'c' );

		$data = [
			'question_text'        => $question_text,
			'question_slug'        => strtolower( str_replace( ' ', '-', $question_text ) ),
			'question_description' => $question_description,
			'created_at'           => $this->created_at,
			'updated_at'           => $this->updated_at,
			'question_posted_by'   => (int) $this->question_posted_by
		];
		$this->db->insert( 'questions', $data );

		return [ $this->question_text, $this->question_description ];
	}


	public function get_questions() {
		$this->db->order_by( 'created_at', 'DESC' );
		$query = $this->db->get( 'questions' );

		return $query->result();
	}

	public function get_question_by_id( $question_id ) {

		$this->db->select( '*' );
		$this->db->from( 'questions' );
		$this->db->where( 'question_id', $question_id );
		$query = $this->db->get();

		return $query->result();
	}

}