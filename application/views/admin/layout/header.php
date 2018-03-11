<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );
?><!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a href="/" class="navbar-brand">NavBar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
				<?php if ( $this->session->has_userdata( 'AE' ) ): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
							<?php echo $this->session->userdata()['AE']; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">Profile</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="/admin/auth/logout">Logout</a>
                        </div>
                    </li>
				<?php else: ?>

					<?php if ( $this->uri->segment( 2 ) === 'login' ): ?>
                        <li class="nav-item active">
                            <a class="nav-link" href="/admin/auth/login"> Login</a>
                        </li>
					<?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/auth/login"> Login</a>
                        </li>
					<?php endif; ?>
				<?php endif; ?>

            </ul>
        </div>
    </nav>

    <br>
    <div class="alert alert-danger" role="alert">
        You are inside admin mode! Take care
    </div>


    <a class="btn btn-default" href="/admin" role="button">Dashboard</a>
	<?php if ( $this->uri->segment( 2 ) == 'reports' ): ?>
        <a class="btn btn-primary" href="/admin/reports" role="button">Reports</a>
	<?php else: ?>
        <a class="btn btn-default" href="/admin/reports" role="button">Reports</a>
	<?php endif; ?>


	<?php if ( $this->uri->segment( 2 ) == 'questions' ): ?>
        <a class="btn btn-primary" href="/admin/questions" role="button">Questions</a>
	<?php else: ?>
        <a class="btn btn-default" href="/admin/questions" role="button">Questions</a>
	<?php endif; ?>

	<?php if ( $this->uri->segment( 2 ) == 'tags' ): ?>
        <a class="btn btn-primary" href="/admin/tags" role="button">Tags</a>
	<?php else: ?>
        <a class="btn btn-default" href="/admin/tags" role="button">Tags</a>
	<?php endif; ?>


    <a class="btn btn-default" href="/admin/users" role="button">Users</a>
    <br>