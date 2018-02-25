<div class="row justify-content-md-center">
	<?php if ( $this->session->flashdata( 'response' ) != null ): ?>
        <div class="alert alert-success" role="alert">
			<?php
			$response = $this->session->flashdata( 'response' );
			echo 'Hello, ' . $response['admin'] . ', ' . $response['message'];
			?>
        </div>
	<?php else: ?>
		<?= form_open( '/admin/auth/register', [ 'method' => 'post', 'class' => 'col-lg-4 col-lg-8-offset' ] ) ?>
		<?php if ( validation_errors() !== '' ): ?>
            <div class="alert alert-danger" role="alert">
				<?= validation_errors(); ?>
            </div>
		<?php endif; ?>


        <div class="form-group">
            <label for="admin_email">Email address</label>
            <input type="email" class="form-control" id="admin_email" aria-describedby="emailHelp"
                   placeholder="Enter email" autocomplete="off" name="admin_email"
                   value="<?= set_value( 'admin_email' ); ?>">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="pass">Password</label>
            <input type="password" class="form-control" id="pass" placeholder="Password" name="pass"
                   autocomplete="off"
                   value="<?= set_value( 'pass' ); ?>">
        </div>

        <div class="form-group">
            <label for="password-confirm">Password confirm</label>
            <input type="password" class="form-control" id="password-confirm" placeholder="Confirm Password"
                   name="confirm_pass" value="<?= set_value( 'confirm_pass' ); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button> <a href="/admin/auth/login" style="float: right"
                                                                         class=" btn btn-primary">Login</a>
		<?= form_close() ?>
	<?php endif; ?>
</div>
