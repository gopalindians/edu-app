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
<?= form_open( get_full_url(), [ 'method' => 'post', 'class' => 'col-lg-12' ] ) ?>
<?php if ( validation_errors() !== '' ): ?>
    <div class="alert alert-danger" role="alert">
		<?= validation_errors(); ?>
    </div>
<?php endif; ?>
    <div class="form-group">
        <input type="text" class="form-control" name="question_text"
               placeholder="Question text"
               value="<?= trim( $question[0]->question_text ); ?>">
    </div>
    <div class="form-group">
        <textarea class="form-control" name="question_description"
                  placeholder="Question description"> <?= trim( $question[0]->question_description ); ?></textarea>
    </div>
    <p class="card-text">
        <button class="btn btn-normal btn-primary" type="submit">Update</button>
    </p>
<?= form_close() ?>