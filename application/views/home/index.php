</br>
<div class="card text-center">
    <!--<div class="card-header">
        Featured
    </div>-->
    <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
    <!--<div class="card-footer text-muted">
        2 days ago
    </div>-->
</div>

<?php if ( $this->session->flashdata( 'response' ) != null ): ?>
    <br>
    <div class="alert alert-success" role="alert">
		<?php
		$response = $this->session->flashdata( 'response' );
		echo 'Your question \'' . $response[0] . '\' posted successfully! ';
		?>
    </div>
<?php endif; ?>

<?php
foreach ( $questions as $question ):
	?>

    <div class="card" style="width: 48rem;margin-top: 5px">
        <div class="card-body">
            <!--<h5 class="card-title">Card title</h5>-->
            <h6 class="card-subtitle mb-2 text-muted"><a
                        href="/question/<?= $question->question_id; ?>/<?= $question->question_slug; ?>"><?= $question->question_text; ?></a>
            </h6>
            <p class="card-text"><?= $question->question_description ?></p>
            <a href="#" class="card-link small">Card link</a>
        </div>
    </div>
<?php endforeach; ?>
