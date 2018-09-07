<?php
/**
 * Project: edu_app
 * Author: gopalindians <$USER_EMAIL>
 * Date: 07-09-2018
 * Time: 21:49
 * Link:
 */

class Feedback_model extends CI_Model {


	/**
	 * @var string email
	 */
	private $email;

	/**
	 * @var string $feedback
	 */
	private $feedback;

	/**
	 * @var string ref
	 */
	private $ref;

	/**
	 * @var string ip
	 */
	private $ip;

	/**
	 * @var string $created_at
	 */
	private $created_at;

	/**
	 * @var string user agent
	 */
	private $ua;

	public function __construct() {
		parent::__construct();
		$this->created_at = new DateTime();
	}

	public function save_feedback( $email, $feedback, $ref, $ip, $ua ) {
		$this->email      = $email;
		$this->feedback   = $feedback;
		$this->ref        = $ref;
		$this->created_at = $this->created_at->format( 'c' );
		$this->ua         = $ua;

		$data = [
			'email'      => $this->email,
			'feedback'   => $this->feedback,
			'ref'        => $this->ref,
			'created_at' => $this->created_at,
			'ua'         => $this->ua
		];

		$this->db->insert( 'feedbacks', $data );

		return true;
	}
}