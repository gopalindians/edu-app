<div class="card text-center" style="margin-top: 5px;">
	<?php if ( isset( $response ) && ( $response !== '' ) ): ?>
        <div class="alert alert-<?= $response['type']; ?> alert-dismissible fade show" role="alert">
			<?= $response['data']; ?>
        </div>
	<?php endif; ?>
    <div class="card-body">
		<?= form_open( '', [
			'method'  => 'post',
			'enctype' => 'multipart/form-data'
		] ) ?>
        <div class="form-group row">
            <label for="first_name" class="col-sm-2 col-form-label">First name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="first_name" placeholder="First name"
                       name="first_name"
                       value="<?= isset( $user_meta_info[0] ) ? $user_meta_info[0]->first_name : ''; ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="last_name" class="col-sm-2 col-form-label">Last name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="last_name" placeholder="Last name"
                       name="last_name"
                       value="<?= isset( $user_meta_info[0] ) ? $user_meta_info[0]->last_name : ''; ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="text" class="form-control-plaintext" id="email" placeholder="Email"
                       name="email" readonly
                       value="<?= isset( $user_info[0] ) ? $user_info[0]->email : ''; ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="about" class="col-sm-2 col-form-label">About</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="about" placeholder="I am computer science graduate"
                       name="about"
                       value="<?= isset( $user_meta_info[0] ) ? $user_meta_info[0]->about : ''; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="hobbies" class="col-sm-2 col-form-label">Hobbies</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="hobbies" placeholder="Yoga, music, book reading"
                       name="hobbies"
                       value="<?= isset( $user_meta_info[0] ) ? $user_meta_info[0]->hobbies : ''; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Profile Pic</label>
            <div class="col-sm-10">
				<?php if ( isset( $user_info[0] ) & $user_info[0]->profile_image != '' ): ?>

					<?php if ( filter_var( $user_info[0]->profile_image, FILTER_VALIDATE_URL ) !== false ): ?>
                        <img src="<?= $user_info[0]->profile_image ?>"
                             style="max-width: 150px;max-height: 150px;"
                             onerror="this.onerror=null;this.src='//placehold.it/150';"
                             class="mx-auto img-fluid img-circle d-block" alt="avatar">
					<?php else: ?>
                        <img src="<?= base_url() . 'uploads/' . $user_info[0]->profile_image ?>"
                             style="max-width: 150px;max-height: 150px;"
                             onerror="this.onerror=null;this.src='//placehold.it/150';"
                             class="mx-auto img-fluid img-circle d-block" alt="avatar">
					<?php endif; ?>
				<?php else: ?>
                    <img src="//placehold.it/150" class="mx-auto img-fluid img-circle d-block" alt="avatar">
				<?php endif; ?>
                <br>
                <div class="custom-file col-sm-4" style="cursor: pointer;">
                    <input type="file" class="" id="customFile" accept="image/*" name="profile_image">
                </div>
            </div>
        </div>

        <div class="form-group row float-right">
            <div class="col-sm-10 ">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
		<?= form_close() ?>
    </div>
</div>