<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );
?><!DOCTYPE html>
<html lang="<?= check_lang(); ?>">
<head>

    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer',<?= '\'' . getenv( 'GTM_ID' ) . '\'' ?>);</script>
    <!-- End Google Tag Manager -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="google-site-verification" content="<?= getenv( 'GOOGLE_SITE_VERIFICATION_ID' ) ?>"/>
	<?php if ( isset( $title ) ): ?>
        <title><?= $title . ' - ' ?><?= getenv( 'APP_NAME' ) ?></title>
	<?php else: ?>
        <title><?= getenv( 'APP_NAME' ) ?></title>
	<?php endif; ?>

    <meta name='csrfName' content="<?= $this->security->get_csrf_token_name(); ?>">
    <meta name='csrfHash' content="<?= $this->security->get_csrf_hash(); ?>">
    <meta name='keywords' content="<?= $keywords ?? ''; ?>">
    <link rel="alternate" href="<?= getenv( 'APP_URL' ) ?>"
          hreflang="x-default"/>

	<?php if ( isset( $question ) ): ?>
        <meta itemprop="datePublished" content="<?= $question[0]->question_created_at ?>"/>
        <meta itemprop="dateModified" content="<?= $question[0]->question_updated_at ?>"/>

        <!--        <script type="application/ld+json">
				{
				"@context": "http://schema.org",
				"@type": "NewsArticle",
				"mainEntityOfPage": {
				"@type": "WebPage",
		"@id": "https://google.com/article"
		  },
		  "headline": "Article headline",
		  "image": [
			"https://example.com/photos/1x1/photo.jpg",
			"https://example.com/photos/4x3/photo.jpg",
			"https://example.com/photos/16x9/photo.jpg"
		   ],
		  "datePublished": "2015-02-05T08:00:00+08:00",
		  "dateModified": "2015-02-05T09:20:00+08:00",
		  "author": {
			"@type": "Person",
			"name": "John Doe"
		  },
		   "publisher": {
			"@type": "Organization",
			"name": "Google",
			"logo": {
			  "@type": "ImageObject",
			  "url": "https://google.com/logo.jpg"
			}
		  },
		  "description": "A most wonderful article"
		}
		</script>-->
	<?php endif; ?>
	<?php if ( $this->uri->segment( 1 ) === 'profile' ): ?>
        <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Person",
      "email": "mailto:<?= $user_info[0]->email ?? '' ?>",
      "image": "<?= ( getenv( 'APP_URL' ) . '/uploads/' . $user_info[0]->profile_image ) ?? '' ?>",
      "name": "<?= $user_meta_info[0]->first_name ?? ' ' . $user_meta_info[0]->last_name ?? '' ?>"
    }

        </script>
	<?php endif; ?>
	<?php

	$e = [
		'general' => true, //description
		'og'      => true,
		'twitter' => true,
		'robot'   => true
	];
	meta_tags( $e, $description ?? '', $description ?? '' ); ?>
    <meta name='language' content='<?= check_lang(); ?>'>

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
    <link rel="icon" type="image/png" sizes="192x192" href="/assets/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/assets/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon-16x16.png">
    <!--<link rel="manifest" href="/assets/manifest.json">-->
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/assets/ms-icon-144x144.png">
    <meta name="theme-color" content="#007bff">
    <link rel="manifest" href="/manifest.json">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" async></script>
    <!--<script src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/latest.js?config=TeX-MML-AM_CHTML' async></script>-->
	<?php
	/*if ( isset( $this->minify ) ) {
		$this->minify->add_css( [ 'tags.css' ] );
		echo $this->minify->deploy_css( true, 'auto' );
	}*/
	?>

    <!-- production version, optimized for size and speed -->
    <!--<script src="//cdn.jsdelivr.net/npm/vue"></script>-->
    <!--<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>-->

</head>
<body>

<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=<?= getenv( 'GTM_ID' ) ?>"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
<div class="container col-lg-8">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a href="/" class="navbar-brand"><?= getenv( 'APP_NAME' ) ?>
			<?php if ( getenv( 'STATE' ) !== null ): ?>
				<?php if ( getenv( 'STATE' ) === 'alpha' ): ?>
                    <small title="<?= $this->lang->line( 'text_message_state' ); ?>">
                        (<?= getenv( 'STATE' ) ?>)
                    </small>
				<?php endif; ?>
			<?php endif; ?>
        </a>
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
					<?php if ( $this->uri->segment( 2 ) !== 'login'  && $this->uri->segment( 2 ) !== 'register' ): ?>
                        <li class="nav-item active">
                            <a class="nav-link" href="/auth/login"> Login</a>
                        </li>
					<?php endif; ?>
				<?php endif; ?>
            </ul>
        </div>

        <?php if ( $this->uri->segment( 2 ) !== 'login'   && $this->uri->segment( 2 ) !== 'register' ): ?>
        <ul class="nav nav-pills">
            <li class="nav-item">
                <!--<a class="nav-link" href="#fat">@fat</a>-->
                <a href="/question/add" class=" mr-sm-2 btn btn-primary">Add new question</a>

            </li>
            <!--<li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#one">one</a>
                    <div role="separator" class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#three">three</a>
                </div>
            </li>-->
        </ul>

        <?php  endif; ?>
    </nav>