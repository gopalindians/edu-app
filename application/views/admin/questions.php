</br>

<?php if ( $this->session->flashdata( 'response' ) != null ): ?>
    <br>
    <div class="alert alert-success" role="alert">
		<?php
		$response = $this->session->flashdata( 'response' );
		echo 'Your question \'' . $response[0] . '\' posted successfully! ';
		?>
    </div>
<?php endif; ?>
<div class="row">
    <div class="col-lg-8 col-md-12 col-sm-12">
        <table class="table table-responsive table-dark">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Question</th>
                <th scope="col">Posted by</th>
                <th scope="col">Created on</th>
                <th scope="col">Updated on</th>
                <th scope="col">Disable/Hide</th>
            </tr>
            </thead>
            <tbody>
			<?php foreach ( $questions as $question ): ?>
                <tr>
                    <th scope="row"><?= $question->question_id; ?></th>
                    <td><a href="/admin/question/<?= $question->question_slug; ?>"> <?= $question->question_text; ?></a>
                    </td>
                    <td>
                        <a href="/admin/user/<?= $question->question_posted_by; ?>"> <?= $question->question_posted_by; ?></a>
                    </td>
                    <td><?= $question->created_at; ?></td>
                    <td><?= $question->updated_at; ?></td>
                    <td>
						<?php if ( $question->deleted_at === null || $question->deleted_at === 'null' || $question->deleted_at === '' ): ?>
                            <label for="">Enabled:</label>
                            <input type="radio" name="question_disabled_<?= $question->question_id ?>" checked>
                            <label for="">Disabled:</label>
                            <input type="radio" name="question_disabled_<?= $question->question_id ?>">
						<?php else: ?>
                            <label for="">Enabled:</label>
                            <input type="radio" name="question_disabled_<?= $question->question_id ?>">
                            <label for="">Disabled:</label>
                            <input type="radio" name="question_disabled_<?= $question->question_id ?>" checked>
						<?php endif; ?>
                    </td>

                </tr>
			<?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="col-lg-2 hidden-md hidden-sm">Hello</div>
</div>

<br>

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
                    <input type="radio" name="report" value="spam">Spam
                    <input type="radio" name="report" value="nudity">Nudity/
                    <input type="radio" name="report" value="racism">Racism
                    <input type="radio" name="report" value="hate">Hate
                    <input type="radio" name="report" value="other">Other
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send Report</button>
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