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
	private $question_id;
	private $question_text;
	private $question_slug;
	private $question_description;
	private $date;
	private $offset;
	private $created_at;
	private $updated_at;

	public function __construct() {
		parent::__construct();
		$this->date = new DateTime();
	}

	public function save_new_question( $question_posted_by, $question_text, $question_slug, $question_description = '' ) {
		$this->question_text = $question_text;
		$this->question_slug = $question_slug;
		if ( $question_description !== '' ) {
			$this->question_description = $question_description;
		}
		$this->question_posted_by = $question_posted_by;
		$this->created_at         = $this->date->format( 'c' );
		$this->updated_at         = $this->date->format( 'c' );

		$data = [
			'question_text'        => $question_text,
			'question_slug'        => $question_slug,
			'question_description' => $question_description,
			'created_at'           => $this->created_at,
			'updated_at'           => $this->updated_at,
			'question_posted_by'   => (int) $this->question_posted_by
		];
		$this->db->insert( 'questions', $data );

		return [ $this->question_text, $this->question_description ];
	}


	public function get_questions( $limit, $offset = '', $user_id = '' ) {

		$this->offset = $offset;
		if ( $user_id == '' ) {
			$this->db->select( '
			questions.question_id,questions.question_text,questions.question_description,question_slug,
			questions.created_at as question_created_at,
			questions.updated_at as question_updated_at,
			
			users.email as user_email,
			users.id    as user_id' );
			$this->db->limit( $limit );
			$this->db->offset( $this->offset );
			$this->db->order_by( 'questions.updated_at', 'DESC' );
			$this->db->join( 'users', 'users.id = questions.question_posted_by' );

			$query = $this->db->get( 'questions' );

			foreach ( $query->result() as $item ) {
				[ $item->safe_user_email ] = explode( '@', $item->user_email );
				$this->db->select( '*' );
				$this->db->from( 'question_comments' );
				$this->db->where( 'question_id', $item->question_id );
				$q                             = $this->db->get();
				$item->question_total_comments = $q->num_rows();
			}

			return [
				'all_questions' => $query->result(),
			];

		} else {
			$this->db->select( '
			questions.question_id, questions.question_text,questions.question_description,question_slug,
			questions.created_at as question_created_at,
			questions.updated_at as question_updated_at,
			
			users.email as user_email,
			users.id    as user_id' );
			$this->db->where( 'questions.question_posted_by', $user_id );
			$this->db->limit( $limit );
			$this->db->offset( $this->offset );
			$this->db->order_by( 'questions.updated_at', 'DESC' );
			$this->db->join( 'users', 'users.id = questions.question_posted_by' );

			$query = $this->db->get( 'questions' );

			foreach ( $query->result() as $item ) {
				[ $item->safe_user_email ] = explode( '@', $item->user_email );
				$this->db->select( '*' );
				$this->db->from( 'question_comments' );
				$this->db->where( 'question_id', $item->question_id );
				$q                             = $this->db->get();
				$item->question_total_comments = $q->num_rows();
			}


			return [
				'all_questions'   => $query->result(),
				'current_offset'  => $this->offset + $limit,
				'total_questions' => $this->num_rows( $user_id ),
			];
		}
	}

	public function get_question_by_id( $question_id ) {

		$this->db->select(
			'questions.question_id, questions.question_text,questions.question_description,question_slug,
			questions.created_at as question_created_at,
			questions.updated_at as question_updated_at,
			
			users.id as user_id,
			users.email as user_email,
			users.profile_image as user_profile_image,
			users.created_at as user_created_at,
			users.updated_at as user_updated_at' );
		$this->db->from( 'questions' );
		$this->db->where( 'question_id', $question_id );
		$this->db->join( 'users', 'users.id = questions.question_posted_by' );
		$query = $this->db->get();

		foreach ( $query->result() as $item ) {
			[ $item->safe_user_email ] = explode( '@', $item->user_email );
		}

		return $query->result();
	}

	public function num_rows( $user_id = '' ) {
		if ( $user_id === '' ) {
			$this->db->select( 'users.id, questions.question_id' );
			$this->db->from( 'questions' );
			$this->db->join( 'users', 'users.id = questions.question_posted_by' );
			$this->db->order_by( 'questions.updated_at', 'DESC' );
			$query = $this->db->get();
		} else {
			$this->db->select( 'users.id, questions.question_id' );
			$this->db->from( 'questions' );
			$this->db->join( 'users', 'users.id = questions.question_posted_by' );
			$this->db->where( 'questions.question_posted_by', $user_id );
			$this->db->order_by( 'questions.updated_at', 'DESC' );
			$query = $this->db->get();
		}

		return $query->num_rows();
	}

	public function update_question( $user_id, $question_id, $question_text, $question_description, $question_slug = '' ): bool {
		$this->question_id          = $question_id;
		$this->question_posted_by   = $user_id;
		$this->question_text        = $question_text;
		$this->question_description = $question_description;
		$this->question_slug        = $question_slug;
		$this->updated_at           = $this->date->format( 'c' );

		$this->db->set( 'question_text', $this->question_text );
		$this->db->set( 'question_description', $this->question_description );
		$this->db->set( 'question_slug', $this->question_slug );
		$this->db->set( 'updated_at', $this->updated_at );
		$this->db->where( 'question_posted_by', $user_id );
		$this->db->where( 'question_id', $this->question_id );
		$this->db->update( 'questions' );

		return true;
	}

}