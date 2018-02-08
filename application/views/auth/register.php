<div class="row justify-content-md-center">
	<?php if ( $this->session->flashdata( 'response' ) != null ): ?>
        <div class="alert alert-success" role="alert">
			<?php
			$response = $this->session->flashdata( 'response' );
			echo 'Hello, ' . $response['user'] . ', ' . $response['message'];
			?>
        </div>
	<?php else: ?>
		<?= form_open( 'auth/register', [ 'method' => 'post', 'class' => 'col-lg-4 col-lg-8-offset' ] ) ?>

		<?php if ( validation_errors() !== '' ): ?>
            <div class="alert alert-danger" role="alert">
				<?= validation_errors(); ?>
            </div>
		<?php endif; ?>


        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                   placeholder="Enter email"
                   autocomplete="off"
                   name="email" <?= set_value( 'email' ); ?>>
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password" name="password"
                   autocomplete="off"
                   value="<?= set_value( 'password' ); ?>">
        </div>

        <div class="form-group">
            <label for="password-confirm">Password confirm</label>
            <input type="password" class="form-control" id="password-confirm" placeholder="Confirm Password"
                   name="confirm_password" value="<?= set_value( 'confirm_password' ); ?>">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
		<?= form_close() ?>
	<?php endif; ?>
</div>
