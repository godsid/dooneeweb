<!DOCTYPE html>
<html lang="th">
  <!-- Top Head -->
  <head>
	<meta charset="utf-8">
	<meta name="description" content="DooneeTV ดูนี่ทีวี ">
	<meta name="author" content="DooneeTV ดูนี่ทีวี">
	<meta name="keywords" content="DooneeTV, ดูนี่ทีวี"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link rel="shortcut icon" href="<?=static_url('/img/ico/favicon.ico')?>">
	<title>DooneeTV ดูนี่ทีวี</title>
	<!-- Custom styles for this template -->
	<link href="<?=static_url('/fonts/fontface.css')?>" rel="stylesheet">
	<!-- http://fortawesome.github.io/Font-Awesome/3.2.1/icons/ -->
	<link href="<?=static_url('/css/font-awesome.min.css')?>" rel="stylesheet">
	<!--<link href="<?=static_url('/css/jquery.fancybox.css?v=2.1.5')?>" rel="stylesheet">-->
	<link href="<?=static_url('/css/flexslider.css')?>" rel="stylesheet">
	<link href="<?=static_url('/css/themes.css')?>" rel="stylesheet">
	<script src="<?=static_url('/js/jquery-1.10.1.min.js')?>"></script>
	<script src="<?=static_url('/js/jquery.tools.min.js')?>"></script>
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!--[if lt IE 9]>
	  <script src="<?=static_url('/js/html5shiv.js')?>"></script>
	  <script src="<?=static_url('/js/respond.min.js')?>"></script>
	<![endif]-->
	<!--[if lt IE 8]>
	<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE7.js"></script>
	<![endif]-->
	</head>
  <!-- /Top Head -->

  <!-- Header -->
  	<header id="header" class="nav-down" data-size="big">
		<div class="container">
			<div class="bar-login">
		    	<div class="bx-login _sf-col-sm-push-2-xs-10">
		        	<p class="btn"><a href="#" title="เข้าสู่ระบบ">เข้าสู่ระบบ</a> | <a href="#" title="สมัครสมาชิก">สมัครสมาชิก</a> <a class="icon-facebook-sign" href="#" title="Facebook login">Facebook login</a></p>
		            <form action="<?=base_url('/login')?>" method="post">
		            <fieldset>
		                <legend class="hid">เข้าสู่ระบบ</legend>
		                <p>
		                	<label for="uname" class="hid">Username</label><input type="text" onblur="$(this).parent().removeClass('active')" placeholder="Username" name="uname" id="uname" class="_sf-col-xs-12-sm-4 txt-box">
		                	<label for="pword" class="hid">Password</label><input type="password" onblur="$(this).parent().removeClass('active')" placeholder="Password" name="pword" id="pword" class="_sf-col-xs-12-sm-4 txt-box">
		                 	<button type="submit" value="Login" class="ui-btn btn-login" id="signin" onclick="$('#show-login').toggleClass('hid'); $('#btn-login').toggleClass('hid');">Login</button>  
		                 </p>
		                <p class="_sf-col-sm-push-4 ml2"><input type="checkbox" name="auto-log" id="auto-log" /> <label for="auto-log">เข้าสู่ระบบอัตโนมัติ</label> <a title="Sign up now" href="#">ลืมรหัสผ่าน</a></p>
		            </fieldset>
		            </form>
		        </div>
		    </div>
		    <h1 class="logo" itemscope itemtype="http://schema.org/Organization">
		        <a href="<?=base_url('/')?>" itemprop="url">DooneeTV</a>
		        <img src="<?=static_url('/img/logo.png')?>" itemprop="logo">
		    </h1>
		    
		    <div class="tools _cd-col-xs-4">
		    	<div class="zone-login _sf-col-xs-1">
		        	<a href="javascript:;" title="Login" onclick="$(body).toggleClass('expand-login'); $('.bar-login').slideToggle(200);">
		            <div id="btn-login"><i class="icon-long-arrow-up"></i> LOGIN</div>
		            <div id="show-login" class="hid">User name <span>ดูหนังได้อีก <em>15 <small>วัน</small></em></span></div>
		            </a>
		        </div>
		        <ul id="sl-cat" class="select-cat">
		        	<li>
		            	<a href="javascript:;" title="เลือกประเภทหนัง">เลือกประเภทหนัง <i class="icon-chevron-down"></i></a>
		                <ul class="sub-cat js-v-scroll _sf-col-xs-12">
		                    <li><a class="selected" href="#" title="Inter Series">Inter Series <span>540</span></a></li>
		                    <li><a href="#" title="Asian Series">Asian Series <span>1250</span></a></li>
		                    <li><a href="#" title="Asian Movies">Asian Movies <span>360</span></a></li>
		                    <li><a href="#" title="Hollywood Cinema">Hollywood Cinema <span>236</span></a></li>
		                    <li><a href="#" title="Hollywood Series">Hollywood Series <span>540</span></a></li>
		                    <li><a href="#" title="Hollywood independent">Hollywood independent <span>360</span></a></li>
		                    <li><a href="#" title="Latin Series">Latin Series <span>1250</span></a></li>
		                    <li><a href="#" title="Documentaries">Documentaries <span>360</span></a></li>
		                    <li><a href="#" title="Kids Program">Kids Program <span>236</span></a></li>
		                    <li><a href="#" title="Talkshow Program">Talkshow Program <span>1250</span></a></li>
		                    <li><a href="#" title="Variety Program">Variety Program <span>236</span></a></li>
		                    <li><a href="#" title="Crime scene Program">Crime scene Program <span>540</span></a></li>
		                    <li><a href="#" title="Sports Program">Sports Program <span>360</span></a></li>
		                    <li><a href="#" title="Paranormal Program">Paranormal Program <span>236</span></a></li>
		                    <li><a href="#" title="Travel &amp; Adventure Program">Travel &amp; Adventure Program <span>1250</span></a></li>
		                    <li><a href="#" title="Factual Program">Factual Program <span>360</span></a></li>
		                    <li><a href="#" title="Sci – Tech Program">Sci – Tech Program <span>540</span></a></li>
		                </ul>
		            </li>
		        </ul>
		        <div id="searcharea">
		            <form action="<?=base_url('/movie/search')?>" method="get" id="searchForm">
		                <input type="text" class="txt-box _sf-col-xs-12" placeholder="ค้นหา หนัง/ซีรี่ย์" id="terms" name="q">
		                <button class="btn-srh icon-search" id="btn-search" type="submit"></button>
		            </form>							
		        </div>
		    </div>
		    
		    <nav id="navigation" class="top-nav">
		        <ul id="nav-drop">
		              <li><a href="index.php">หน้าแรก</a></li>
		              <li><a href="movie.php">ดูหนัง</a></li>
		              <li><a href="promotion.php">โปรโมชั่น</a></li>
		              <li><a href="wallet.php">เติมเงิน</a></li>
		              <li><a href="help.php">วิธีการดูหนัง</a></li>    
		              <li><a href="contactus.php">เกี่ยวกับเรา</a></li>                                                                
		          </ul>
		                    
		          <span class="btn-nv-m">
		          	  <a class="b-ex" onclick="$(this).toggleClass('active'); $('#header').toggleClass('expand');" href="javascript:;" title="Expand">Expand Nav</a>
		              <!--<a class="b-ex" href="#navigation" title="Expand">Expand Nav</a>
		              <a class="b-close" href="#" title="Close">Close Nav</a>-->
		          </span>
		      </nav>
		      
		</div>
		</header>
  <!-- /Header -->










