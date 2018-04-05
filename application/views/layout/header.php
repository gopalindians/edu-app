    <?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );
?><!DOCTYPE html>
<html lang="en">
<head>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer',<?= '\''.getenv('GTM_ID').'\'' ?>);</script>
    <!-- End Google Tag Manager -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= getenv( 'APP_NAME' ) ?></title>

    <meta name='csrfName' content="<?= $this->security->get_csrf_token_name(); ?>">
    <meta name='csrfHash' content="<?= $this->security->get_csrf_hash(); ?>">

    <meta name='keywords' content="<?= $keywords ?? ''; ?>">
    <meta name='description' content="<?= $description ?? ''; ?>">
    <meta name='language' content='EN'>
    <meta name='robots' content='index,follow'>
    <meta name='url' content='<?= getenv( 'APP_URL' ) ?>'>
    <meta name='rating' content='General'>
    <meta name='target' content='all'>
    <meta name='HandheldFriendly' content='True'>
    <meta name='MobileOptimized' content='320'>
    <link rel="apple-touch-icon" sizes="57x57" href="/assets/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/assets/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/assets/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/assets/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/assets/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/assets/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/assets/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/assets/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/assets/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon-16x16.png">
    <link rel="manifest" href="/assets/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/assets/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js"></script>
</head>
<body>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?= getenv('GTM_ID') ?>"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div class="container col-lg-8">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a href="/" class="navbar-brand"><?= getenv( 'APP_NAME' ) ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
				<?php if ( $this->session->has_userdata( getenv( 'SESSION_USER_SAFE_EMAIL' ) ) ): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
							<?= $this->session->userdata()[ getenv( 'SESSION_USER_SAFE_EMAIL' ) ]; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item"
                               href="/profile/<?= $this->session->userdata()[ getenv( 'SESSION_UID' ) ] . '/' . explode( '@', $this->session->userdata()['UE'] )[0]; ?>">Profile</a>
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