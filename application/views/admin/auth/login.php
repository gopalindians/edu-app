<div class="row justify-content-md-center">

    <div class="col-lg-12 col-lg-12-offset"></div>


	<?= form_open( 'admin/auth/login', [ 'method' => 'post', 'class' => 'col-lg-4 col-lg-8-offset' ] ) ?>
	<?php var_dump( validation_errors() ); ?>
	<?php if ( validation_errors() !== '' ): ?>
        <div class="alert alert-danger" role="alert">
			<?= validation_errors(); ?>
        </div>
	<?php endif; ?>

    <div class="form-group">
        <label for="admin_email">Email address</label>
        <input type="email" class="form-control" id="admin_email" aria-describedby="emailHelp"
               name="admin_email"
               value="<?= set_value( 'admin_email' ); ?>"
               placeholder="Enter email">
    </div>
    <div class="form-group">
        <label for="pass">Password</label>
        <input type="password" class="form-control" id="pass" placeholder="Password"
               name="pass"
               value="<?= set_value( 'pass' ); ?>">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button> <a href="/admin/auth/register" style="float: right" class=" btn btn-primary">Register</a>


	<?= form_close() ?>
</div>