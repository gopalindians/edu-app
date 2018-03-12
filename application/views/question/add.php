<?php
/**
 * Project: edu_app
 * Author: gopalindians <$USER_EMAIL>
 * Date: 07-02-2018
 * Time: 00:46
 * Link:
 */
?>
    </br>
<?= form_open( 'question/add', [ 'method' => 'post', 'class' => 'col-lg-12 col-lg-12' ] ) ?>
<?php if ( validation_errors() !== '' ): ?>
    <div class="alert alert-danger" role="alert">
		<?= validation_errors(); ?>
    </div>
<?php endif; ?>

    <div class="form-group">
        <label for="formGroupExampleInput">Question title</label>
        <input type="text" class="form-control" required name="question_text" placeholder="">
    </div>
    <div class="form-group">
        <label for="formGroupExampleInput2">Question description</label>
        <input type="text" class="form-control" required name="question_description" placeholder="">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
<?= form_close() ?>