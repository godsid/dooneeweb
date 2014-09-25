<!DOCTYPE html>
<html lang="en">
<head>
	<!--
		Charisma v1.0.0

		Copyright 2012 Muhammad Usman
		Licensed under the Apache License v2.0
		http://www.apache.org/licenses/LICENSE-2.0

		http://usman.it
		http://twitter.com/halalit_usman
	-->
	<meta charset="utf-8">
	<title>Doonee.TV Backoffice</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="Banpot Srihawong">

	<!-- The styles -->
	<link id="bs-css" href="<?=static_url('/backoffice/css/bootstrap-cerulean.css')?>" rel="stylesheet">
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	</style>
	<link href="<?=static_url('/backoffice/css/bootstrap-responsive.css')?>" rel="stylesheet">
	<link href="<?=static_url('/backoffice/css/charisma-app.css')?>" rel="stylesheet">
	<link href="<?=static_url('/backoffice/css/jquery-ui-1.8.21.custom.css')?>" rel="stylesheet">
	<link href="<?=static_url('/backoffice/css/fullcalendar.css')?>" rel='stylesheet'>
	<link href="<?=static_url('/backoffice/css/fullcalendar.print.css')?>" rel='stylesheet'  media='print'>
	<link href="<?=static_url('/backoffice/css/chosen.css')?>" rel='stylesheet'>
	<link href="<?=static_url('/backoffice/css/uniform.default.css')?>" rel='stylesheet'>
	<link href="<?=static_url('/backoffice/css/colorbox.css')?>" rel='stylesheet'>
	<link href="<?=static_url('/backoffice/css/jquery.cleditor.css')?>" rel='stylesheet'>
	<link href="<?=static_url('/backoffice/css/jquery.noty.css')?>" rel='stylesheet'>
	<link href="<?=static_url('/backoffice/css/noty_theme_default.css')?>" rel='stylesheet'>
	<link href="<?=static_url('/backoffice/css/elfinder.min.css')?>" rel='stylesheet'>
	<link href="<?=static_url('/backoffice/css/elfinder.theme.css')?>" rel='stylesheet'>
	<link href="<?=static_url('/backoffice/css/jquery.iphone.toggle.css')?>" rel='stylesheet'>
	<link href="<?=static_url('/backoffice/css/opa-icons.css')?>" rel='stylesheet'>
	<link href="<?=static_url('/backoffice/css/uploadify.css')?>" rel='stylesheet'>

	<!-- <?=backoffice_url('/docs/The')?>5 shim, for IE6-8 support <?=backoffice_url('/docs/of')?>5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/<?=backoffice_url('/docs/trunk')?>5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- jQuery -->
	<script src="<?=static_url('/backoffice/js/jquery-1.7.2.min.js')?>"></script>		
</head>

<body>
	<?php if(!isset($no_visible_elements) || !$no_visible_elements)	{ ?>
	<!-- topbar starts -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="<?=backoffice_url('/home')?>"> <img alt="Doonee Logo" src="<?=static_url('/backoffice/img/logo20.png')?>" /> <span>Doonee.TV</span></a>
				
				<!-- theme selector starts -->
				<?php /*<div class="btn-group pull-right theme-container" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-tint"></i><span class="hidden-phone"> Change Theme / Skin</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" id="themes">
						<li><a data-value="classic" href="#"><i class="icon-blank"></i> Classic</a></li>
						<li><a data-value="cerulean" href="#"><i class="icon-blank"></i> Cerulean</a></li>
						<li><a data-value="cyborg" href="#"><i class="icon-blank"></i> Cyborg</a></li>
						<li><a data-value="redy" href="#"><i class="icon-blank"></i> Redy</a></li>
						<li><a data-value="journal" href="#"><i class="icon-blank"></i> Journal</a></li>
						<li><a data-value="simplex" href="#"><i class="icon-blank"></i> Simplex</a></li>
						<li><a data-value="slate" href="#"><i class="icon-blank"></i> Slate</a></li>
						<li><a data-value="spacelab" href="#"><i class="icon-blank"></i> Spacelab</a></li>
						<li><a data-value="united" href="#"><i class="icon-blank"></i> United</a></li>
					</ul>
				</div>
				*/ ?>
				<!-- theme selector ends -->
				
				<!-- user dropdown starts -->
				<div class="btn-group pull-right" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i><span class="hidden-phone"> Admin</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="<?=backoffice_url('/member/edit/me')?>">Profile</a></li>
						<li class="divider"></li>
						<li><a href="<?=backoffice_url('/user/logout')?>">Logout</a></li>
					</ul>
				</div>
				<!-- user dropdown ends -->
				
				<?php /*<div class="top-nav nav-collapse">
					<ul class="nav">
						<li><a href="#">Visit Site</a></li>
						<li>
							<form class="navbar-search pull-left">
								<input placeholder="Search" class="search-query span2" name="query" type="text">
							</form>
						</li>
					</ul>
				</div><!--/.nav-collapse -->
				*/?>
			</div>
		</div>
	</div>
	<!-- topbar ends -->
	<?php } ?>
	<div class="container-fluid">
		<div class="row-fluid">
		<?php if(!isset($no_visible_elements) || !$no_visible_elements) { ?>
		
			<!-- left menu starts -->
			<div class="span2 main-menu-span">
				<div class="well nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li class="nav-header hidden-tablet">Main</li>
						<li><a class="ajax-link" href="<?=backoffice_url('/dashboard')?>"><i class="icon-home"></i><span class="hidden-tablet"> Dashboard</span></a></li>
						<li><a class="ajax-link" href="<?=backoffice_url('/member')?>"><i class="icon-eye-open"></i><span class="hidden-tablet"> Members</span></a></li>
						<li><a class="ajax-link" href="<?=backoffice_url('/movie')?>"><i class="icon-eye-open"></i><span class="hidden-tablet"> Movies</span></a></li>
						<li><a class="ajax-link" href="<?=backoffice_url('/package')?>"><i class="icon-eye-open"></i><span class="hidden-tablet"> Packages</span></a></li>
						<li><a class="ajax-link" href="<?=backoffice_url('/banner')?>"><i class="icon-eye-open"></i><span class="hidden-tablet"> Banners</span></a></li>
						<li><a class="ajax-link" href="<?=backoffice_url('/category')?>"><i class="icon-eye-open"></i><span class="hidden-tablet"> Category</span></a></li>
						<li><a class="ajax-link" href="<?=backoffice_url('/article/news')?>"><i class="icon-eye-open"></i><span class="hidden-tablet"> ข่าว/โปรโมชั่น</span></a></li>
						<li><a class="ajax-link" href="<?=backoffice_url('/article/help')?>"><i class="icon-eye-open"></i><span class="hidden-tablet"> วิธีการรับชม</span></a></li>
						<li><a class="ajax-link" href="<?=backoffice_url('/page/form/privacy')?>"><i class="icon-eye-open"></i><span class="hidden-tablet"> นโยบายส่วนตัว</span></a></li>
						<li><a class="ajax-link" href="<?=backoffice_url('/page/form/condition')?>"><i class="icon-eye-open"></i><span class="hidden-tablet"> ข้อกำหนดและเงื่อนไข</span></a></li>
						<li><a class="ajax-link" href="<?=backoffice_url('/page/form/help')?>"><i class="icon-eye-open"></i><span class="hidden-tablet"> วิธีการดูหนัง</span></a></li>
						<li><a class="ajax-link" href="<?=backoffice_url('/page/form/aboutus')?>"><i class="icon-eye-open"></i><span class="hidden-tablet"> เกี่ยวกับเรา</span></a></li>
						<li><a class="ajax-link" href="<?=backoffice_url('/user/logout')?>"><i class="icon-eye-open"></i><span class="hidden-tablet"> Logout</span></a></li>

						<?php /*
						<li class="nav-header hidden-tablet">Document Section</li>
						<li><a class="ajax-link" href="<?=backoffice_url('/docs/ui')?>"><i class="icon-eye-open"></i><span class="hidden-tablet"> UI Features</span></a></li>
						<li><a class="ajax-link" href="<?=backoffice_url('/docs/form')?>"><i class="icon-edit"></i><span class="hidden-tablet"> Forms</span></a></li>
						<li><a class="ajax-link" href="<?=backoffice_url('/docs/chart')?>"><i class="icon-list-alt"></i><span class="hidden-tablet"> Charts</span></a></li>
						<li><a class="ajax-link" href="<?=backoffice_url('/docs/typography')?>"><i class="icon-font"></i><span class="hidden-tablet"> Typography</span></a></li>
						<li><a class="ajax-link" href="<?=backoffice_url('/docs/gallery')?>"><i class="icon-picture"></i><span class="hidden-tablet"> Gallery</span></a></li>
						<li class="nav-header hidden-tablet">Sample Section</li>
						<li><a class="ajax-link" href="<?=backoffice_url('/docs/table')?>"><i class="icon-align-justify"></i><span class="hidden-tablet"> Tables</span></a></li>
						<li><a class="ajax-link" href="<?=backoffice_url('/docs/calendar')?>"><i class="icon-calendar"></i><span class="hidden-tablet"> Calendar</span></a></li>
						<li><a class="ajax-link" href="<?=backoffice_url('/docs/grid')?>"><i class="icon-th"></i><span class="hidden-tablet"> Grid</span></a></li>
						<li><a class="ajax-link" href="file-<?=backoffice_url('/docs/manager')?>"><i class="icon-folder-open"></i><span class="hidden-tablet"> File Manager</span></a></li>
						<li><a href="<?=backoffice_url('/docs/tour')?>"><i class="icon-globe"></i><span class="hidden-tablet"> Tour</span></a></li>
						<li><a class="ajax-link" href="<?=backoffice_url('/docs/icon')?>"><i class="icon-star"></i><span class="hidden-tablet"> Icons</span></a></li>
						<li><a href="<?=backoffice_url('/docs/error')?>"><i class="icon-ban-circle"></i><span class="hidden-tablet"> Error Page</span></a></li>
						<li><a href="<?=backoffice_url('/docs/login')?>"><i class="icon-lock"></i><span class="hidden-tablet"> Login Page</span></a></li>
						*/ ?>
					</ul>
					
				</div><!--/.well -->
			</div><!--/span-->
			<!-- left menu ends -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">
			<!-- content starts -->
			<?php } ?>
