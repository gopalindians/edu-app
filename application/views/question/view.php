<?php
/**
 * Project: edu_app
 * Author: gopalindians <$USER_EMAIL>
 * Date: 07-02-2018
 * Time: 00:40
 * Link:
 */
?>

</br>

<?php if ( $this->session->flashdata( 'response' ) != null ):
	$response = $this->session->flashdata( 'response' ); ?>
    <div class="alert alert-<?= $response['type']; ?> alert-dismissible fade show" role="alert">
		<?= $response['message']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<div class="card text-center">
    <!--<div class="card-header">
		Featured
	</div>-->
    <div class="card-body">
        <!--<h5 class="card-title">Special title treatment</h5>-->
        <!--<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>-->
        <a href="/question/add" class="btn btn-primary">Add new question</a>
    </div>
    <!--<div class="card-footer text-muted">
		2 days ago
	</div>-->
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card" style="margin-top: 5px">
            <div class="card-body">
                <!--<h5 class="card-title">Card title</h5>-->
                <h6 class="card-subtitle mb-2 text-muted"><?= $question[0]->question_text; ?></h6>
                <p class="card-text"><?= $question[0]->question_description; ?></p>

                <div class="float-right">
                    <!--<span class="text-secondary">Posted by</span>
                    <br>-->
                    <span>
                    <a href="/profile/<?= $question[0]->user_id . '/' . $question[0]->safe_user_email ?>"
                       class="card-link small float-right" title="<?= $question[0]->user_email ?>">
						<?= $question[0]->safe_user_email; ?>
                    </a>
                        </span>
                    <br>
                    <span class="font-weight-light">
                        <small><?= date( 'F jS, Y', strtotime( $question[0]->question_created_at ) ); ?></small>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: 5px">
            <!--<div class="card-body">-->
			<?= form_open( '/question/' . $question[0]->question_id . '/' . $question[0]->question_slug,
				[ 'method' => 'POST' ] ) ?>
            <input type="hidden" name="question_id" value="<?= $question[0]->question_id ?>">

            <div class="row">
                <textarea class="form-control" style="min-height100px;width: 100%;" name="question_comment"></textarea>
                <div class="float-right" style="margin-top: 2px;">
                    <button type="submit" class=" btn btn-sm btn-primary float-right">Post</button>
                </div>
            </div>
			<?= form_close() ?>
            <!--</div>-->
        </div>
        <input type="hidden" name="comment_offset" value="<?= $comments['current_offset'] ?>">
        <input type="hidden" name="total_comments" value="<?= $comments['total_comments'] ?>">
        <div id="question_comments">
			<?php foreach ( $comments['result'] as $comment ): ?>
                <div class="card" style="margin-top: 5px">
                    <div class="card-body">
                        <!--<h5 class="card-title">Card title</h5>
                    <h8 class="card-subtitle mb-2 text-muted"><? /*= $question[0]->question_text; */ ?></h8>-->
                        <p class="card-text"><?= $comment->question_comment_body; ?></p>
                        <div class="float-right">
                            <a href="/profile/<?= $comment->user_id . '/' . $comment->safe_user_email ?>"
                               class="card-link small float-right"><?= $comment->safe_user_email; ?></a>
                            <br>
                            <small><?= date( 'F jS, Y', strtotime( $comment->question_comment_updated_at ) ); ?></small>
                        </div>
                    </div>
                </div>
			<?php endforeach; ?>
        </div>

		<?php if ( $comments['current_offset'] < $comments['total_comments'] ): ?>
            <a href="javascript:void(0);" class="btn btn-primary" id="question_comments_load_more">Show more</a>
		<?php endif; ?>
    </div>
    <!--<div class="col-lg-4 hidden-md hidden-sm">
        <div class="alert alert-success">Hello</div>
    </div>-->
</div>