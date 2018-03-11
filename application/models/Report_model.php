<?php
/**
 * Project: edu_app
 * Author: gopalindians <$USER_EMAIL>
 * Date: 26-02-2018
 * Time: 01:57
 * Link:
 */

class Report_model extends CI_Model {
	private $fq_id;
	private $question_id;
	private $report_type;
	private $user_id;
	private $status;
	private $created_at;
	private $updated_at;


	private $date;

	private const NEW_FLAGGED_QUESTION = 0;

	public function __construct() {
		parent::__construct();
		$this->date = new DateTime();
	}

	public function save_new_report( $question_id, $report_type, $user_id ) {
		$d = [
			'question_id' => $question_id,
			'report_type' => $report_type,
			'user_id'     => $user_id ?? 0,
			'status'      => self::NEW_FLAGGED_QUESTION,
			'created_at'  => $this->date->format( 'c' ),
			'updated_at'  => $this->date->format( 'c' )
		];

		$this->db->set( $d );
		$this->db->insert( 'flagged_questions' );

		//$this->fq_id = $this->db->insert_id();

		return true;
	}

	public function get_all_reports() {
		$query = $this->db->get( 'flagged_questions' );

		return $query->result();
	}
}