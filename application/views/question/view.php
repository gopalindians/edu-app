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

<?php if ( $this->uri->segment( 1 ) !== 'question' ): ?>
    <div class="card text-center">
        <div class="card-body">
            <a href="/question/add" class="btn btn-primary">Add a new question</a>
        </div>
    </div>

<?php endif; ?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card" style="margin-top: 5px">
            <div class="card-body">
				<?php if ( $this->session->has_userdata( getenv( 'SESSION_UID' ) ) ): ?>
					<?php if ( $question[0]->user_id == $this->session->get_userdata()[ getenv( 'SESSION_UID' ) ] ): ?>
                        <div class="float-right"><a href="<?= get_full_url(); ?>/edit">Edit</a></div>
					<?php endif; ?>
				<?php endif; ?>
                <h6 class="card-subtitle mb-2 text-muted"><?= $question[0]->question_text; ?></h6>
                <p class="card-text"><?= $question[0]->question_description; ?></p>

                <div class="cont" style="display: none;">
                    <span id="tags" class="tags"></span>
                    <input id="search-tags" class="search-tags" type="text" placeholder="enter tags (max of five)"/>X
                    <span id="tags-after" class="tags"></span>


                    <div id="tag-picker" style="display: none;">
                    </div>
                    <div id="error"></div>
                </div>
                <a class="<?= isset( $tags ) ? 'hidden-lg hidden-sm hidden-xm hidden-md' : '' ?>"
                   href="javascript:void(0);" id="add_tags">Add tags</a>


                <div class="float-right">
                    <span>
                    <a href="/profile/<?= $question[0]->user_id . '/' . $question[0]->safe_user_email ?>"
                       class="card-link small float-right" title="<?= $question[0]->user_email ?>">
						<?= $question[0]->safe_user_email; ?>
                    </a>
                        </span>
                    <br>
                    <span class="font-weight-light">
                        <small id="question_updated_at_<?= $question[0]->user_id ?>">
                            <script>
                                document.addEventListener("DOMContentLoaded", function (event) {
                                    var moment_<?=$question[0]->user_id; ?> = moment('<?= $question[0]->question_updated_at;?>').fromNow();
                                    document.getElementById('question_updated_at_<?= $question[0]->user_id;?>').innerHTML = moment_<?=$question[0]->user_id; ?>;
                                    var title_<?=$question[0]->question_id; ?> = moment('<?= $question[0]->question_updated_at;?>').format('MMMM Do YYYY, h:mm:ss a');
                                    document.getElementById('question_updated_at_<?= $question[0]->user_id;?>').setAttribute('title', title_<?=$question[0]->question_id; ?>)
                                });
                            </script>
                        </small>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: 5px">
			<?= form_open( '/question/' . $question[0]->question_id . '/' . $question[0]->question_slug, [ 'method' => 'POST' ] ) ?>
            <input type="hidden" name="question_id" value="<?= $question[0]->question_id ?>">
            <div class="row">
                <textarea class="form-control" style="min-height100px;width: 100%;" name="question_comment"></textarea>
                <div class="float-right" style="margin-top: 2px;">
                    <button type="submit" class=" btn btn-sm btn-primary float-right">Post</button>
                </div>
            </div>
			<?= form_close() ?>
        </div>
        <input type="hidden" name="comment_offset" value="<?= $comments['current_offset'] ?>">
        <input type="hidden" name="total_comments" value="<?= $comments['total_comments'] ?>">
        <div id="question_comments" itemscope="" itemtype="http://schema.org/Answer">
			<?php foreach ( $comments['result'] as $comment ): ?>
                <div class="card" style="margin-top: 5px">
                    <div class="card-body">
                        <p class="card-text"><?= $comment->question_comment_body; ?></p>
                        <div class="float-right">
                            <a href="/profile/<?= $comment->user_id . '/' . $comment->safe_user_email ?>"
                               class="card-link small float-right"><?= $comment->safe_user_email; ?></a>
                            <br>
                            <small id="question_comment_<?= $comment->question_comment_id ?>">
                                <script>
                                    document.addEventListener("DOMContentLoaded", function (event) {
                                        var moment_<?= $comment->question_comment_id ?> = moment('<?= $comment->question_comment_updated_at;?>').fromNow();
                                        document.getElementById('question_comment_<?= $comment->question_comment_id ?>').innerHTML = moment_<?= $comment->question_comment_id ?>;
                                        var title_<?=$question[0]->question_id; ?> = moment('<?= $comment->question_comment_updated_at;?>').format('MMMM Do YYYY, h:mm:ss a');
                                        document.getElementById('question_comment_<?= $comment->question_comment_id ?>').setAttribute('title', title_<?=$question[0]->question_id; ?>)
                                    });
                                </script>
                            </small>
                        </div>
                    </div>
                </div>
			<?php endforeach; ?>
        </div>
		<?php if ( $comments['current_offset'] < $comments['total_comments'] ): ?>
            <a href="javascript:void(0);" class="btn btn-primary" id="question_comments_load_more">Show more</a>
		<?php endif; ?>
    </div>
</div>
<script>
    new Vue({
        el: '#tags',
        mode:'development',
        config:{
            devtools:true
        },
        data: {
            message: 'Hello Vue.js!'
        }
    })
</script>