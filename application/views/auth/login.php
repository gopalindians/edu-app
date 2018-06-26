<div class="row justify-content-md-center">

    <div class="col-lg-12 col-lg-12-offset"></div>
	<?= form_open( getenv('APP_URL').'/auth/login', [ 'method' => 'post', 'class' => 'col-lg-4 col-lg-8-offset', 'autocomplete' => 'off' ] ) ?>

	<?php if ( $this->session->flashdata( 'response' ) != null ):
		$response = $this->session->flashdata( 'response' ); ?>
        <div class="alert alert-<?= $response['type']; ?> alert-dismissible show" role="alert">
			<?= $response['message']; ?>
        </div>
	<?php endif; ?>

	<?php if ( validation_errors() !== '' ): ?>
        <div class="alert alert-danger" role="alert">
			<?= validation_errors(); ?>
        </div>
	<?php endif; ?>

    <div class="form-group">
        <label for="email"><?= $this->lang->line( 'text_label_email_address' ); ?></label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
               name="email" autocomplete="off" required
               value="<?= set_value( 'email' ); ?>"
               placeholder="<?= $this->lang->line( 'text_label_email_address' ); ?>">
    </div>
    <div class="form-group">
        <label for="password"><?= $this->lang->line( 'text_label_password' ); ?></label>
        <input type="password" class="form-control" id="password"
               name="password" autocomplete="off" required
               value="<?= set_value( 'password' ); ?>"
               placeholder="<?= $this->lang->line( 'text_placeholder_password' ); ?>">
    </div>
    <!--<div style="text-align: right;margin-bottom: 10px;">
        <a href="<?/*= getenv( 'APP_URL' ) */?>/auth/forgot-password"><?/*= $this->lang->line( 'text_link_forgot_password' ); */?></a>
    </div>-->
    <button type="submit" class="btn btn-primary"><?= $this->lang->line( 'text_btn_submit' ); ?></button>
    <a href="/auth/register" style="float: right"
       class=" btn btn-primary"><?= $this->lang->line( 'text_btn_register' ); ?></a>

    <hr>
    <a href="<?= htmlspecialchars( $loginUrl ) ?>"><?= $this->lang->line( 'text_link_login_with_facebook' ); ?></a>
	<?= form_close() ?>
</div>