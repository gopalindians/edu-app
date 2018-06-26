<div class="row justify-content-md-center">
	<?php if ( $this->session->flashdata( 'response' ) != null ):
		$response = $this->session->flashdata( 'response' ); ?>
        <div class="alert alert-<?= $response['type'] ?>" role="alert">
			<?= 'Hello, ' . $response['user'] . ', ' . $response['message']; ?>
        </div>
	<?php else: ?>
		<?= form_open( getenv('APP_URL').'/auth/register', [ 'method' => 'post', 'class' => 'col-lg-4 col-lg-8-offset' ] ) ?>

		<?php if ( validation_errors() !== '' ): ?>
            <div class="alert alert-danger" role="alert">
				<?= validation_errors(); ?>
            </div>
		<?php endif; ?>


        <div class="form-group">
            <label for="email"><?= $this->lang->line( 'text_label_email_address' ); ?></label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                   placeholder="<?= $this->lang->line( 'text_placeholder_email_address' ); ?>"
                   autocomplete="off"
                   name="email" value="<?= set_value( 'email' ); ?>">
            <small id="emailHelp" class="form-text text-muted"><?= $this->lang->line( 'text_email_help' ); ?></small>
        </div>
        <div class="form-group">
            <label for="password"><?= $this->lang->line( 'text_label_password' ); ?></label>
            <input type="password" class="form-control" id="password"
                   placeholder="<?= $this->lang->line( 'text_placeholder_password' ); ?>" name="password"
                   autocomplete="off"
                   value="<?= set_value( 'password' ); ?>">
        </div>

        <div class="form-group">
            <label for="password-confirm"><?= $this->lang->line( 'text_label_password_confirm' ); ?></label>

            <input type="password" class="form-control" id="password-confirm"
                   autocomplete="new_password"
                   placeholder="<?= $this->lang->line( 'text_placeholder_password_confirm' ); ?>"
                   name="confirm_password" value="<?= set_value( 'confirm_password' ); ?>">
        </div>
        <button type="submit" class="btn btn-primary"><?= $this->lang->line( 'text_btn_submit' ); ?></button>
        <a href="/auth/login" style="float: right" class=" btn btn-primary"><?= $this->lang->line( 'text_btn_login' ); ?></a>
        <hr>

        <a href="<?= htmlspecialchars( $loginUrl ) ?>"><?= $this->lang->line( 'text_link_login_with_facebook' ); ?></a>

		<?= form_close() ?>
	<?php endif; ?>
</div>
