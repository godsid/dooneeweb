<!-- Header -->
    <header id="header" class="nav-down" data-size="big">
    <div class="container">
      <div class="bar-login">
          <div class="bx-login _sf-col-sm-push-2-xs-10">
              <p class="btn"><a class="lb-popup" href="javascript:;" rel="#popup-login" title="เข้าสู่ระบบ">เข้าสู่ระบบ</a> | <a href="<?=base_url('/register')?>" title="สมัครสมาชิก">สมัครสมาชิก</a> <a title="เข้าสู่ระบบผ่าน Facebook " href="javascript:;" class="fb-signin"><i class="icon-facebook"></i> Login <span>with</span> Facebook</a><!--<a class="icon-facebook-sign" href="#" title="Facebook login">Facebook login</a>--></p>
                <form action="<?=base_url('/login')?>" class="formLogin" method="post">
                <fieldset>
                    <legend class="hid">เข้าสู่ระบบ</legend>
                    <p>
                      <label for="uname" class="hid">Email</label><input type="text" onblur="$(this).parent().removeClass('active')" placeholder="อีเมลย์" name="email" id="uname" class="_sf-col-xs-12-sm-4 txt-box">
                      <label for="pword" class="hid">Password</label><input type="password" onblur="$(this).parent().removeClass('active')" placeholder="รหัสผ่านของคุณ" name="password" id="pword" class="_sf-col-xs-12-sm-4 txt-box">
                      <button type="submit" value="เข้าสู่ระบบ" class="ui-btn btn-login" id="signin" onclick="$('#show-login').toggleClass('hid'); $('#btn-login').toggleClass('hid');">เข้าสู่ระบบ</button>  
                     </p>
                    <p class="_sf-col-sm-push-4 ml2"><input type="checkbox" name="remember" value="yes" id="auto-log" /> <label for="auto-log">เข้าสู่ระบบอัตโนมัติ</label> <a title="Sign up now" href="<?=base_url('/member/forgotpassword')?>">ลืมรหัสผ่าน</a></p>
                </fieldset>
                </form>
            </div>
        </div>
        <h1 class="logo" itemscope itemtype="http://schema.org/Organization">
            <a href="<?=home_url()?>" itemprop="url">DooneeTV</a>
            <img src="<?=static_url('/img/logo.png')?>" itemprop="logo">
        </h1>
        
        <div class="tools _cd-col-xs-4">
          <div class="zone-login _sf-col-xs-1">
            <?php 
            if(isset($memberLogin)&&$memberLogin){ ?>

              <a href="javascript:;" title="<?=$memberLogin['firstname']?> <?=$memberLogin['lastname']?>">
                <div id="show-login"><?=$memberLogin['firstname']?> <span>ดูหนังได้อีก <em><?=$memberLogin['dayLeft']?> <small>วัน</small></em></span></div>
              </a>
            <?php }else{?>
              <a href="javascript:;" title="Login" onclick="$(body).toggleClass('expand-login'); $('.bar-login').slideToggle(200);">
                    <div id="btn-login"><i class="icon-user"></i> เข้าสู่ระบบ</div>
                  </a>
            <?php }?>
            </div>
            <ul id="sl-cat" class="select-cat">
              <li>
                  <a href="javascript:;" title="เลือกประเภทหนัง">เลือกประเภทหนัง <i class="icon-chevron-down"></i></a>
                    <ul id="scroll-cat" class="sub-cat _sf-col-xs-12">

                    <?php if(is_array($categories)&&count($categories)){
                      foreach ($categories as $key => $category) { ?>
                      <?php if($category['movie_item']){?>
                        <li><a <?=(isset($category_id) && $category_id==$category['category_id'])?"class=\"selected\"":""?> href="<?=base_url('/movie/cate/'.$category['category_id'])?>" title="<?=$category['title']?>"><?=($category['parent_id']==0?"":" - ")?><?=$category['title']?> <span><?=$category['movie_item']?></span></a></li>  
                      <?php }?>
                    <?php }
                       }
                      ?>
                    </ul>
                </li>
            </ul>
            <div id="searcharea">
                <form action="<?=base_url('/movie/search')?>" method="get" id="searchForm">
                    <input type="text" class="txt-box _sf-col-xs-12" placeholder="ค้นหา หนัง/ซีรี่ย์" id="searchbox" name="q" autocomplete="off">
                    <button class="btn-srh icon-search" id="btn-search" type="submit"></button>
                    <ul id="results" class="js-v-scroll"><li class="hid">results</li></ul>
                </form>
                <!-- data search -->
                <ul id="data-articles" class="hid">
                  <li class="articlelink"><a href="<?=base_url('/movie/')?>"><img alt="" src="<?=static_url('/files/movie_default.jpg')?>">
                  <strong>หนังเข้าใหม่<?=date('Y')?></strong>
                  </a></li>
                </ul>
                <script>
          $(function() {
            $("#searchbox").on("keyup", function() {
              var search = $(this).val().toLowerCase();
              console.log(search);
              $("#results").empty().show();
              if (search.trim().length>=3) {
                $.get('<?=base_url("/movie/suggestion")?>',{q:search,page:1,limit:1},function(resp){
                  if(resp.items.length){
                    $("#results").append('<li class="articlelink"><a href="javascript:$(\'#searchForm\').submit();">ผลการค้นหาพบทั้งหมด '+resp.allItem+' เรื่อง</a></li>');
                    resp = resp.items;
                    for(i=0,j=resp.length;i<j;i++){
                      item = $('#data-articles .articlelink').clone();
                      $(item).find('a').attr('href','<?=base_url("/movie/")?>/'+resp[i].movie_id);
                      $(item).find('strong').html(resp[i].title+"<br/>"+resp[i].title_en);
                      $(item).find('img').attr('src',resp[i].cover);
                      $("#results").append(item);
                    }
                    
                  }else{
                    $("#results").append("<li>No results!</li>");   
                  }       
                },"json");
              }
            });
          });
          </script> 
                <!-- /data search -->
            </div>
        </div>
        
        <nav id="navigation" class="top-nav">
            <ul id="nav-drop">
              <li><a href="<?=home_url()?>" title="หน้าแรก">หน้าแรก</a></li>
              <li><a href="<?=base_url('/movie/series')?>" title="ดูซีรี่ย์">ดูซีรี่ย์</a></li>
              <li><a href="<?=base_url('/news')?>" title="ข่าว/โปรโมชั่น">ข่าว/โปรโมชั่น</a></li>
              <li><a href="<?=base_url('/package')?>" title="เติมเงิน / ซื้อแพ็กเกจ">เติมเงิน / ซื้อแพ็กเกจ</a></li>
              <li><a href="<?=base_url('/help')?>" title="วิธีการดูหนัง">วิธีการดูหนัง</a></li>    
              <li><a href="<?=base_url('/aboutus')?>" title="เกี่ยวกับเรา">เกี่ยวกับเรา</a></li>
            </ul>
              <span class="btn-nv-m">
                  <a class="b-ex" onclick="$(this).toggleClass('active'); $('#header').toggleClass('expand');" href="javascript:;" title="Expand">Expand Nav</a>
                  <!--<a class="b-ex" href="#navigation" title="Expand">Expand Nav</a>
                  <a class="b-close" href="#" title="Close">Close Nav</a>-->
              </span>
          </nav>
          
    </div>
    </header>
  <script type="text/javascript">
   $(document).ready(function(){
       $("#nav-drop li a").removeClass("selected");
       $('#nav-drop>li').find('a[href*="<?=$this->uri->segment(1)?>"]').addClass('selected');
       if(!$('#nav-drop>li>a.selected').length){
          $("#nav-drop li a:first").addClass("selected");
       }
       loginUrl = $('#formLogin').attr('action')+'?reurl='+encodeURI(window.location);
       $('#formLogin').attr('action',loginUrl);
  });
  </script>
  <!-- /Header -->