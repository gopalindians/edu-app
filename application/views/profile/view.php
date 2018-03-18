<div class="card text-center border-light" style="margin-top: 5px;">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
				<?php if ( $this->input->get( 'tab' ) === null ): ?>
                    <a class="nav-link active" href="<?= base_url() . $this->uri->uri_string(); ?>">Overview</a>
				<?php else: ?>
                    <a class="nav-link" href="<?= base_url() . $this->uri->uri_string(); ?>">Overview</a>
				<?php endif; ?>
            </li>
            <li class="nav-item">
				<?php if ( $this->input->get( 'tab' ) === 'questions' ): ?>
                    <a class="nav-link active" href="<?= base_url() . $this->uri->uri_string() ?>?tab=questions">Questions</a>
				<?php else: ?>
                    <a class="nav-link" href="<?= base_url() . $this->uri->uri_string() ?>?tab=questions">Questions</a>
				<?php endif; ?>
            </li>
            <li class="nav-item">
				<?php if ( $this->input->get( 'tab' ) === 'about' ): ?>
                    <a class="nav-link active" href="<?= base_url() . $this->uri->uri_string() ?>?tab=about">About</a>
				<?php else: ?>
                    <a class="nav-link" href="<?= base_url() . $this->uri->uri_string() ?>?tab=about">About</a>
				<?php endif; ?>
            </li>

        </ul>
    </div>
    <div class="card-body">
		<?php if ( $this->input->get( 'tab' ) === null ): ?>
            <div class="card border-light mb-5" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Total questions posted</h5>
                    <p class="card-text"><?= $total_questions; ?></p>
                </div>
            </div>
		<?php endif; ?>
		<?php if ( $this->input->get( 'tab' ) === 'questions' ): ?>
            <div id="profile_questions">
				<?php foreach ( $questions as $question ): ?>
                    <div class="card" style="margin-top: 5px">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted"><a
                                        href="/question/<?= $question->question_id; ?>/<?= $question->question_slug; ?>"><?= $question->question_text; ?></a>
                                <input type="hidden" id="hidden_question_id" value="<?= $question->question_id; ?>">
                            </h6>
                            <small id="question_<?= $question->question_id; ?>">
                                <script>
                                    var moment_<?= $question->question_id; ?> = moment('<?= $question->question_updated_at;?>').fromNow();
                                    document.getElementById('question_<?= $question->question_id;?>').innerHTML = moment_<?= $question->question_id; ?>;
                                    var title_<?= $question->question_id; ?> = moment('<?= $question->question_updated_at;?>').format('MMMM Do YYYY, h:mm:ss a');
                                    document.getElementById('question_<?= $question->question_id;?>').setAttribute('title', title_<?= $question->question_id; ?>)
                                </script>
                            </small>
                            |
                            <small> Comments</small>
                            <small class="badge badge-secondary"><?= $question->question_total_comments; ?></small>
                            |
                            <small> By
                                <a href="/profile/<?= $question->user_id ?>/<?= $question->safe_user_email ?>"
                                   class="card-link">
									<?= $question->safe_user_email; ?>
                                </a>
                            </small>
                        </div>
                    </div>
				<?php endforeach; ?>
            </div>

			<?php if ( $questions_current_offset < $total_questions ): ?>
                <input type="hidden" id="profile_user_id" value="<?= $user_info[0]->id; ?>">
                <input type="hidden" id="profile_question_offset" value="<?= $questions_current_offset; ?>">
                <a href="javascript:void(0);" class="btn btn-primary" id="profile_questions_load_more">Load more</a>
			<?php endif; ?>
		<?php endif; ?>



		<?php if ( $this->input->get( 'tab' ) === 'about' ): ?>
			<?php if ( $this->session->has_userdata( 'U_SAFE_E' ) ): ?>
				<?php if ( $this->session->userdata()['U_SAFE_E'] === $this->uri->segment( 3 ) ): ?>
                    <div class="row float-right">
                        <a class="btn btn-sm btn-outline-primary"
                           href="<?= base_url() . $this->uri->uri_string() ?>/edit">Edit</a>
                    </div>
				<?php endif; ?>
			<?php endif; ?>
            <div class="row my-2">

                <div class="col-lg-8 order-lg-2">
                    <div class=" py-4">
                        <div class="row">
                            <div class="col-md-12">
                                <h6>About</h6>
                                <p>
									<?php if ( isset( $user_meta_info[0] ) && $user_meta_info[0]->about != '' ): ?>
										<?= $user_meta_info[0]->about; ?>
									<?php else: ?>
                                        <span>No info</span>
									<?php endif; ?>
                                </p>
                                <h6>Hobbies</h6>
                                <p>
									<?php if ( isset( $user_meta_info[0] ) && $user_meta_info[0]->hobbies != '' ): ?>
										<?= $user_meta_info[0]->hobbies; ?>
									<?php else: ?>
                                        <span>No info</span>
									<?php endif; ?>
                                </p>
                                <h6>Member since</h6>
                                <p id="member_since">
									<?= $user_info[0]->created_at ?>
                                    <script>
                                        var moment_ = moment('<?= $user_info[0]->updated_at;?>').fromNow();
                                        document.getElementById('member_since').innerHTML = moment_;

                                        var title = moment('<?= $user_info[0]->updated_at;?>').format('MMMM Do YYYY, h:mm:ss a');
                                        document.getElementById('member_since').setAttribute('title', title);
                                    </script>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 order-lg-1 text-center">
					<?php if ( isset( $user_info[0]->profile_image ) ): ?>
						<?php if ( filter_var( $user_info[0]->profile_image, FILTER_VALIDATE_URL ) !== false ): ?>
                            <img src="<?= $user_info[0]->profile_image ?>"
                                 onerror="this.onerror=null;this.src='//placehold.it/150';"
                                 class="mx-auto img-fluid img-circle d-block" alt="avatar">
						<?php else: ?>
                            <img src="<?= base_url( '/uploads/' . $user_info[0]->profile_image ) ?>"
                                 onerror="this.onerror=null;this.src='//placehold.it/150';"
                                 class="mx-auto img-fluid img-circle d-block" alt="avatar">
						<?php endif; ?>
					<?php else: ?>
                        <img src="//placehold.it/150" class="mx-auto img-fluid img-circle d-block" alt="avatar">
					<?php endif; ?>
                </div>
            </div>

			<?php //if ( $comments['current_offset'] < $comments['total_comments'] ): ?>
            <!--<a href="javascript:void(0);" class="btn btn-primary" id="question_comments_load_more">Show more</a>-->
			<?php //endif; ?>

		<?php endif; ?>
        <br>
		<?= $pagination; ?>
    </div>
</div>