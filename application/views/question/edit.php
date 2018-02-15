<?php
/**
 * Project: edu_app
 * Author: gopalindians <$USER_EMAIL>
 * Date: 15-02-2018
 * Time: 08:35
 * Link:
 */
?>


    </br>

    <div class="card text-center">
        <!--<div class="card-header">
			Featured
		</div>-->
        <div class="card-body">
            <h5 class="card-title">Special title treatment</h5>
            <!--<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>-->
            <a href="/question/add" class="btn btn-primary">Add new question</a>
        </div>
        <!--<div class="card-footer text-muted">
			2 days ago
		</div>-->
    </div>
    </br>
    <!--<div class="card" style="width: 48rem;margin-top: 5px">-->
    <!--<div class="card-body">-->
    <!--<h5 class="card-title">Card title</h5>-->

<?= form_open( '/question/edit/' . $question[0]->question_id . '/' . $question[0]->question_slug, [
	'method' => 'post',
	'class'  => 'col-lg-8 col-lg-8-offset'
] ) ?>
    <h6 class="card-subtitle mb-2 text-muted"></h6>
    <div class="form-group">
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com"
               value="<?= $question[0]->question_text; ?>">
    </div>

    <div class="form-group">
        <!--<label for="exampleFormControlInput1">Email address</label>-->
        <textarea class="form-control" id="exampleFormControlInput1"
                  placeholder="name@example.com"><?= $question[0]->question_description; ?>
		    </textarea>
    </div>
    <p class="card-text">
        <button class="btn btn-normal btn-primary" type="submit">Update</button>
    </p>
    <!--<a href="#" class="card-link small">Card link</a>-->
    <!--</div>
	</div>-->

<?= form_close() ?>