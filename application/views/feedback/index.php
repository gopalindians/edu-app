<div class="row justify-content-md-center">
    <div class="col-lg-12 col-lg-12-offset"></div>
	<?= form_open( getenv( 'APP_URL' ) . '/feedback', [
		'method'       => 'post',
		'class'        => 'col-lg-4 col-lg-8-offset',
		'autocomplete' => 'off'
	] ) ?>

	<?php if ( $this->session->flashdata( 'response' ) != null ):
		$response = $this->session->flashdata( 'response' ); ?>
        <div class="alert alert-<?= $response['type']; ?> alert-dismissible show" role="alert">
			<?= $response['message']; ?>
        </div>
	<?php endif; ?>
	<?php echo validation_errors(); ?>
	<?php if ( validation_errors() !== '' ): ?>
        <div class="alert alert-danger" role="alert">
			<?= validation_errors(); ?>
        </div>
	<?php endif; ?>

    <div class="form-group">
        <label for="email">Email</label>
		<?php if ( set_value( 'email' ) != '' ): ?>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                   name="email" autocomplete="off" required
                   value="<?= set_value( 'email' ); ?>"
                   placeholder="Add your email here">
		<?php elseif ( $this->session->has_userdata( getenv( 'SESSION_USER_SAFE_EMAIL' ) ) ): ?>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                   name="email" autocomplete="off" required
                   value="<?= $_SESSION[ getenv( 'SESSION_USER_EMAIL' ) ]; ?>"
                   placeholder="Add your email here">
		<?php else: ?>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                   name="email" autocomplete="off" required
                   value="<?= set_value( 'email' ); ?>"
                   placeholder="Add your email here">
		<?php endif; ?>
    </div>
    <div class="form-group">
        <label for="feedback">Feedback</label>
        <textarea class="form-control" id="feedback"
                  name="feedback" autocomplete="off" required
                  placeholder="Add your suggestions here"><?= set_value( 'feedback' ); ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Send</button>

    <hr>
	<?= form_close() ?>
</div>