<div class="row justify-content-md-center">

    <div class="col-lg-12 col-lg-12-offset"></div>


	<?= form_open( 'auth/login', [ 'method' => 'post', 'class' => 'col-lg-4 col-lg-8-offset' ] ) ?>
	<?php if ( validation_errors() !== '' ): ?>
        <div class="alert alert-danger" role="alert">
			<?= validation_errors(); ?>
        </div>
	<?php endif; ?>

    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
               name="email"
               value="<?php echo set_value( 'email' ); ?>"
               placeholder="Enter email">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" placeholder="Password"
               name="password"
               value="<?php echo set_value( 'password' ); ?>">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>


	<?= form_close() ?>
</div>