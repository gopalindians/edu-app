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
                <th scope="col">User</th>
                <th scope="col">Report type</th>
                <th scope="col">Created on</th>
                <th scope="col">Updated on</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
			<?php foreach ( $reports as $report ): ?>
                <tr>
                    <th scope="row"><?= $report->fq_id; ?></th>
                    <td><a href="/admin/report/<?= $report->question_id; ?>"> <?= $report->question_id; ?></a></td>
                    <td><?= $report->user_id; ?></td>
                    <td><?= $report->report_type; ?></td>
                    <td><?= $report->created_at; ?></td>
                    <td><?= $report->updated_at; ?></td>
                    <td><?= $report->status; ?></td>
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