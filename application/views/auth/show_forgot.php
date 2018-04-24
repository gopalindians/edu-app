<?php
/**
 * Project: edu_app
 * Author: gopalindians <gopalindians@gmail.com>
 * Date: 17-04-2018
 * Time: 22:23
 * Link:
 */
?>

<div class="row justify-content-md-center">

    <div class="col-lg-12 col-lg-12-offset"></div>
	<?= form_open( '', [ 'method' => 'post', 'class' => 'col-lg-4 col-lg-8-offset', 'autocomplete' => 'off' ] ) ?>

	<?php if ( $this->session->flashdata( 'response' ) != null ):
		$response = $this->session->flashdata( 'response' ); ?>
        <div class="alert alert-<?= $response['type']; ?> alert-dismissible fade show" role="alert">
			<?= $response['message']; ?>
        </div>
	<?php endif; ?>

	<?php if ( validation_errors() !== '' ): ?>
        <div class="alert alert-danger" role="alert">
			<?= validation_errors(); ?>
        </div>
	<?php endif; ?>

    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
               name="email" autocomplete="off" required
               value="<?= set_value( 'email' ); ?>"
               placeholder="Enter email">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="/auth/register" style="float: right" class=" btn btn-primary">Register</a>

    <hr>
    <a href="<?= htmlspecialchars( $loginUrl ) ?>">Log in with Facebook!</a>
	<?= form_close() ?>
</div>
