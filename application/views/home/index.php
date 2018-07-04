</br>
<?php if ( $this->session->flashdata( 'response' ) != null ):
	$response = $this->session->flashdata( 'response' );
	if ( isset( $response[0] ) ) { ?>
        <br>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
			<?php
			echo 'Your question \'' . $response[0] . '\' posted successfully! '; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
	<?php }endif; ?>

<?php if ( $this->session->flashdata( 'response' ) != null ):
	$response = $this->session->flashdata( 'response' );
	if ( isset( $response['type'] ) ) { ?>
        <br>
        <div class="alert alert-<?= $response['type'] ?> alert-dismissible fade show" role="alert">
			<?= $response['message'] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
	<?php }endif; ?>


<div class="row">
    <div class="col-lg-12    col-md-12 col-sm-12">
		<?php foreach ( $questions as $question ): ?>
            <div class="card" style="margin-top: 5px">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted">
                        <a href="/question/<?= $question->question_id; ?>/<?= $question->question_slug; ?>"><?= $question->question_text; ?></a>
                        <input type="hidden" id="hidden_question_id" value="<?= $question->question_id; ?>">
                    </h6>
                    <small id="<?= $question->question_id; ?>_updated_at">
                        <?=  $question->question_updated_at; ?>
                        <script>
                            document.addEventListener("DOMContentLoaded", function(event) {
                                var moment_<?=$question->question_id; ?> = moment('<?= $question->question_updated_at;?>').fromNow();
                                document.getElementById('<?= $question->question_id;?>_updated_at').innerHTML = moment_<?=$question->question_id; ?>;

                                var title_<?=$question->question_id; ?> = moment('<?= $question->question_updated_at;?>').format('MMMM Do YYYY, h:mm:ss a');
                                document.getElementById('<?= $question->question_id;?>_updated_at').setAttribute('title', title_<?=$question->question_id; ?>);
                            });
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
</div>

<br>
<?= $pagination; ?>