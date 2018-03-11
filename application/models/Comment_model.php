<?php
/**
 * Project: edu_app
 * Author: gopalindians <$USER_EMAIL>
 * Date: 10-03-2018
 * Time: 19:15
 * Link:
 */

class Comment_model extends CI_Model {

	private $date;
	private $comment_body;
	private $question_id;
	private $comment_posted_by;
	private $created_at;
	private $updated_at;

	public function __construct() {
		parent::__construct();
		$this->date = new DateTime();
	}


	public function save_new_comment( $comment_posted_by, $comment_body, $question_id ) {

		$this->comment_body      = $comment_body;
		$this->question_id       = $question_id;
		$this->comment_posted_by = $comment_posted_by;
		$this->created_at        = $this->date->format( 'c' );
		$this->updated_at        = $this->date->format( 'c' );

		$data = [
			'question_id'  => $this->question_id,
			'user_id'      => $this->comment_posted_by,
			'created_at'   => $this->created_at,
			'updated_at'   => $this->updated_at,
			'comment_body' => $this->comment_body
		];
		$this->db->insert( 'question_comments', $data );

		return [ $this->comment_body ];
	}


	public function get_comments_by_question_id( $question_id, $limit, $offset ) {

		$this->db->select( '
		question_comments.qc_id as question_comment_id,
		question_comments.question_id,
		question_comments.comment_body as question_comment_body,
			question_comments.created_at as question_comment_created_at,
			question_comments.updated_at as question_comment_updated_at,
			
			users.id as user_id,
			users.email as user_email,
			users.profile_image as user_profile_image,
			users.created_at as user_created_at,
			users.updated_at as user_updated_at' );

		$this->db->limit( $limit );
		$this->db->offset( $offset );
		$this->db->from( 'question_comments' );

		$this->db->where( 'question_comments.question_id', $question_id );
		$this->db->order_by( 'question_comments.created_at', 'DESC' );
		$this->db->join( 'users', 'users.id = question_comments.user_id' );
		$query = $this->db->get();
		if ( $query->num_rows() > 0 ) {
			$response['result'] = $query->result();
			if ( isset( $response['result'] ) && ( $response['result'] !== '' ) ) {
				foreach ( $response['result'] as $item ) {
					[ $item->safe_user_email ] = explode( '@', $item->user_email );
					$item->question_comment_updated_at = date( 'F jS, Y', strtotime( $item->question_comment_updated_at ) );
				}
			}
		} else {
			$response['result'] = [];
		}

		// to get all row count
		$this->db->select( '*' );
		$this->db->from( 'question_comments' );
		$this->db->where( 'question_comments.question_id', $question_id );
		$response['total_comments'] = $this->db->get()->num_rows();
		$response['current_offset'] = $offset + $limit;

		return $response;
	}
}