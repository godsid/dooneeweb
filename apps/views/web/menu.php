 <!-- Header -->
<header id="header" class="nav-down" data-size="big">
<div class="container">
	<div class="bar-login">
    	<div class="bx-login _sf-col-sm-push-2-xs-10">
        	<p class="btn"><a href="#" title="เข้าสู่ระบบ">เข้าสู่ระบบ</a> | <a href="<?=base_url('/register')?>" title="สมัครสมาชิก">สมัครสมาชิก</a> <a class="icon-facebook-sign" href="#" title="Facebook login">Facebook login</a></p>
            <form action="<?=base_url('/login')?>" method="post">
            <fieldset>
                <legend class="hid">เข้าสู่ระบบ</legend>
                <p>
                	<label for="email" class="hid">Email</label><input type="text" onblur="$(this).parent().removeClass('active')" placeholder="Email" name="email" id="email" class="_sf-col-xs-12-sm-4 txt-box">
                	<label for="password" class="hid">Password</label><input type="password" onblur="$(this).parent().removeClass('active')" placeholder="Password" name="password" id="password" class="_sf-col-xs-12-sm-4 txt-box">
                 	<button type="submit" value="Login" class="ui-btn btn-login" id="signin" onclick="$('#show-login').toggleClass('hid'); $('#btn-login').toggleClass('hid');">Login</button>  
                 </p>
                <p class="_sf-col-sm-push-4 ml2"><input type="checkbox" name="auto-log" id="auto-log" /> <label for="auto-log">เข้าสู่ระบบอัตโนมัติ</label> <a title="Sign up now" href="<?=base_url('/member/forgotpassword')?>">ลืมรหัสผ่าน</a></p>
            </fieldset>
            </form>
        </div>
    </div>
    <h1 class="logo" itemscope itemtype="http://schema.org/Organization">
        <a href="index.php" itemprop="url">DooneeTV</a>
        <img src="<?=static_url('/img/logo.png')?>" itemprop="logo">
    </h1>
    
    <div class="tools _cd-col-xs-4">
    	<div class="zone-login _sf-col-xs-1">
        	<a href="javascript:;" title="Login" onclick="$(body).toggleClass('expand-login'); $('.bar-login').slideToggle(200);">
            <?php if(isset($memberLogin)&&$memberLogin){ ?>
              <div id="show-login" ><?=preg_replace('/@.*/','',$memberLogin['email'])?> <span>ดูหนังได้อีก <em><?=$memberLogin['dayLeft']?> <small>วัน</small></em></span></div>
            <?php }else{?>
              <div id="btn-login"><i class="icon-long-arrow-up"></i> LOGIN</div>
            <?php }?>
          </a>
        </div>
        <ul id="sl-cat" class="select-cat">
        	<li>
            	<a href="javascript:;" title="เลือกประเภทหนัง">เลือกประเภทหนัง <i class="icon-chevron-down"></i></a>
                <ul class="sub-cat js-v-scroll _sf-col-xs-12">
                    <?php foreach ($categories as $key => $category) { ?>
                      <li><a <?=(isset($category_id) && $category_id==$category['category_id'])?"class=\"selected\"":""?> href="<?=base_url('/movie/cate/'.$category['category_id'])?>" title="<?=$category['title']?>"><?=($category['parent_id']==0?"":" - ")?><?=$category['title']?> <span><?=$category['movie_item']?></span></a></li>  
                    <?php }
                    ?>
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
              <li><a href="<?=base_url('/home')?>">หน้าแรก</a></li>
              <li><a href="<?=base_url('/home')?>">ดูหนัง</a></li>
              <li><a href="base_url('/promotion')">โปรโมชั่น</a></li>
              <li><a href="wallet.php">เติมเงิน</a></li>
              <li><a href="<?=base_url('/help')?>">วิธีการดูหนัง</a></li>
              <li><a href="<?=base_url('/contactus')?>">เกี่ยวกับเรา</a></li>                                                                
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