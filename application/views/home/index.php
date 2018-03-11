</br>
<!--<div class="card text-center">-->
    <!--<div class="card-header">
        Featured
    </div>-->
    <!--<div class="card-body">-->
    <!--    <h5 class="card-title">Special title treatment</h5>-->
        <!--<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>-->
        <!--<a href="#" class="btn btn-primary">Go somewhere</a>-->
<!--    </div>-->
    <!--<div class="card-footer text-muted">
        2 days ago
    </div>-->
<!--</div>-->

<?php if ( $this->session->flashdata( 'response' ) != null ): ?>
    <br>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
		<?php
		$response = $this->session->flashdata( 'response' );
		echo 'Your question \'' . $response[0] . '\' posted successfully! ';
		?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<div class="row">
    <div class="col-lg-12    col-md-12 col-sm-12">
		<?php foreach ( $questions as $question ): ?>
            <div class="card" style="margin-top: 5px">
                <div class="card-body">
                    <!--<h5 class="card-title">Card title</h5>-->
                    <h6 class="card-subtitle mb-2 text-muted"><a
                                href="/question/<?= $question->question_id; ?>/<?= $question->question_slug; ?>"><?= $question->question_text; ?></a>
                        <input type="hidden" id="hidden_question_id" value="<?= $question->question_id; ?>">
                        <div class="dropdown" style="float: right;">
                        <span class="dropdown-toggle" style="cursor: pointer;" id="dropdownMenuButton"
                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </span>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="javascript:" data-toggle="modal"
                                   data-question-id="<?= $question->question_id; ?>"
                                   data-target="#reportModal">Report</a>
                                <a class="dropdown-item" href="javascript:" data-toggle="modal"
                                   data-target="#bookmarkModal">Bookmark</a>
                                <a class="dropdown-item" href="javascript:" data-toggle="modal"
                                   data-target="#addToListModal">Add
                                    to
                                    list</a>
                            </div>
                        </div>
                    </h6>
                    <!--<p class="card-text"><?/*= $question->question_description */?></p>-->
                    <small ><?= date( 'F jS, Y', strtotime( $question->question_created_at ) ); ?></small>
                    |
                    <small> Comments</small>
                    <small class="badge badge-secondary"><?= $question->question_total_comments; ?></small>
                    |
                    <small> By
                        <a href="/profile/<?= $question->user_id ?>/<?= $question->safe_user_email?>" class="card-link">
							<?= $question->safe_user_email; ?>
                        </a>
                    </small>

                </div>
            </div>
		<?php endforeach; ?>
    </div>
    <!--<div class="col-lg-2 hidden-md hidden-sm">Hello</div>-->
</div>

<br>
<?= $pagination; ?>

<!-- Modal -->
<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Report question below</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="radio" name="report" id="report_spam" value="spam"><label
                            for="report_spam">Spam</label>
                    <input type="radio" name="report" id="report_nudity" value="nudity"><label for="report_nudity">Nudity</label>
                    <input type="radio" name="report" id="report_racism" value="racism"><label for="report_racism">Racism</label>
                    <input type="radio" name="report" id="report_hate" value="hate"><label
                            for="report_hate">Hate</label>
                    <input type="radio" name="report" id="report_other" value="other"><label
                            for="report_other">Other</label>
                    <input type="hidden" name="report" id="report_question_id" value="">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="report_send_btn">Send Report</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="bookmarkModal" tabindex="-1" role="dialog" aria-labelledby="bookmarkModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addToListModal" tabindex="-1" role="dialog" aria-labelledby="addToListModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>