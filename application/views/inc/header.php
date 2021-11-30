<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en"><!--<![endif]-->
	<head>
		<meta charset="utf-8">
        <meta name="robots" content="<?=$robots;?>">
		<title><?=ucwords($title);?> | <?=site_name();?></title>
		<meta name="description" content="<?=$description;?>">
		<meta name="author" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="shortcut icon" href="<?=theme_uri("images/favicon.png")?>">
		<link rel="canonical" href="<?=canonical_segment( base_url() );?>">

        <link rel="preload" href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Montserrat:wght@500;700&display=swap"  as="font" type="font/woff2" crossorigin>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous" async></script>


		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-106331225-1"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'UA-106331225-1');
		</script>


		<style>
			/* advertisement box */
			.ads-container
			{
				border: 1px solid #ddd;
				text-align: center;
				padding: 0px;
				margin-bottom: 1px;
				height: 100px;
				display: flex;
				margin: 0 auto;
				flex-direction: column;
				justify-content: center;
			}

		</style>
        
    </head>

	<body>
		<div id="header-wrap">
		    <div class="container">


                <div class="row">

                    <div class="col-sm-4">
                        <a class="navbar-brand" href="<?=base_url();?>">
                            <img src="<?=theme_uri("images/logo.png");?>" width="135" height="70" alt="Logo of <?=site_name();?>">
                        </a>
                    </div>

                    <div class="col-sm-8" align="center">
<?php $this->load->view('inc/adsense-header'); ?>
            		</div>
                </div>

                
		    </div>
		</div>
