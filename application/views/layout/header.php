<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );
?><!DOCTYPE html>
<html lang="en">
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= getenv('APP_NAME') ?></title>

    <meta name='csrfName' content="<?= $this->security->get_csrf_token_name(); ?>">
    <meta name='csrfHash' content="<?= $this->security->get_csrf_hash(); ?>">

    <meta name='keywords' content="<?= $keywords ?? ''; ?>">                <!--tags,hello,hi-->
    <meta name='description' content="<?= $description ?? ''; ?>">          <!--150 words-->
    <meta name='language' content='EN'>
    <meta name='robots' content='index,follow'>
    <meta name='url' content='<?= getenv( 'APP_URL' ) ?>'>
    <meta name='rating' content='General'>
    <meta name='target' content='all'>
    <meta name='HandheldFriendly' content='True'>
    <meta name='MobileOptimized' content='320'>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="container col-lg-8">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a href="/" class="navbar-brand"><?= getenv('APP_NAME') ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-t+oggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <!--<li class="nav-item">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>-->
				<?php if ( $this->session->has_userdata( 'U_SAFE_E' ) ): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
							<?= $this->session->userdata()['U_SAFE_E']; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <!--<a class="dropdown-item"
                               href="/profile/<?/*= $this->session->userdata()['UID'] . '/' . explode( '@', $this->session->userdata()['UE'] )[0]; */?>">Profile</a>-->
                            <a class="dropdown-item" href="/auth/logout">Logout</a>
                        </div>
                    </li>
				<?php else: ?>

					<?php if ( $this->uri->segment( 2 ) === 'login' ): ?>
                        <li class="nav-item active">
                            <a class="nav-link" href="/auth/login"> Login</a>
                        </li>
					<?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/auth/login"> Login</a>
                        </li>
					<?php endif; ?>
				<?php endif; ?>

            </ul>
        </div>
    </nav>