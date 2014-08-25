<?php 
	include('header.php');	
?>
  <body>
	<?php include('menu.php'); ?>
  <!-- container -->
        <section id="contents" class="reader">
          <article class="container _cd-col-xs-12-sm-9">
            <div class="_sf-col-xs-12-sm-3">
              <img src="<?=static_url($movie['cover'])?>">
                <p class="_cd-col-xs-12">

                  <?php 
                      // Member Login
                      if(isset($memberLogin)&&$memberLogin){ 
                      // Member Can Watch
                        if(isset($memberLogin['canwatch'])&&$memberLogin['canwatch']){ ?>
                          <a class="ui-btn btn-profile" href="#" title="เริ่มเล่นทันที">เริ่มเล่นทันที</a>  
                        <?php }else{?>
                            <a class="ui-btn-red btn-fill" href="<?=base_url('/package')?>" title="เติมเงินดูหนัง"><i class="icon-credit-card"></i> เติมเงินดูหนัง</a>
                        <?php }?>
                        <a class="ui-btn-blue btn-fv" href="#" title="รายการโปรด"><i class="icon-heart-empty"></i> รายการโปรด</a>
                      <?php }else{?>
                          <a class="ui-btn btn-profile" href="<?=base_url('/login')?>" title="เข้าสู่ระบบ">เข้าสู่ระบบ</a>  
                      <?php } ?>
                    
                </p>
            </div>
            <div class="detai">
              <h1>ดูหนังออนไลน์ <?=$movie['title']?></h1>
                <p class="name-en"><?=$movie['title_en']?></p>
                
                <h2>เนื้อเรื่องภาพยนตร์ <?=$movie['title']?></h2>
                <p><?=nl2br($movie['description'])?></p>
                
                <p class="mt2"><b>คะแนน</b> : <span class="rating"><i class="icon-star<?=$movie['score']>0?"":" drop"?>"></i><i class="icon-star<?=$movie['score']>1?"":" drop"?>"></i><i class="icon-star<?=$movie['score']>2?"":" drop"?>"></i><i class="icon-star<?=$movie['score']>3?"":" drop"?>"></i><i class="icon-star<?=$movie['score']>4?"":" drop"?>"></i></span></p>
                <p><b>เรท</b> :  <?=$movie['rating']?> </p>
                
                <p class="mt2"><b>นักแสดง</b> : 
                <?php
                  echo $movie['cast'];
                  //$movie['cast'] = explode(",",$movie['cast']);
                  //foreach ($movie['cast'] as $cast) {
                ?>
                    <!-- <a href="<?=base_url('/tags/'.$cast)?>" title="<?=$cast?>"><?=$cast?></a>, -->
                <?php  //} ?>
                 </p>
                <p><b>ผู้กำกับ</b> : 
                <?php
                 echo $movie['director'];
                  //$movie['director'] = explode(",",$movie['director']);
                  //foreach ($movie['director'] as $director) {
                ?>
                <!--<a href="<?=base_url('/tags/'.$director)?>" title="<?=$director?>"><?=$director?></a>,-->
                <?php //} ?>
                </p>
                <p><!--<b>หมวดหมู่</b> : <a href="#">หนัง ระทึกขวัญ</a>, <a href="#" title="หนัง แอ๊กชั่น">หนัง แอ๊กชั่น</a>, <a href="#" title="หนัง ดราม่า">หนัง ดราม่า</a>-->
                  <b class="ml2">เสียง : </b> <?=$movie['audio']?>
                  <b class="ml2">บรรยาย : </b> <?=$movie['subtitle']?>
                </p>

                <p><b>ความยาว</b> : <?=($movie['length']/60)?> นาที  <b class="ml2">ปี : </b> <a href="<?=base_url('/movie/year/'.$movie['year'])?>" title="<?=$movie['year']?>"><?=$movie['year']?></a> </p>                  
                
                <div class="share mt2">
                  <b class="fL">แชร์หนังเรื่องนี้ : </b> 
                    <a class="btn-share fb" href="<?=base_url('/movie/'.$movie['movie_id'])?>"><i class="icon-facebook"></i></a>
                    <a class="btn-share tw" href="<?=base_url('/movie/'.$movie['movie_id'])?>"><i class="icon-twitter"></i></a>
                    <a class="btn-share gg" href="<?=base_url('/movie/'.$movie['movie_id'])?>"><i class="icon-google-plus"></i></a>
                    <!--<div class="socialshare-mini"></div>-->
                </div>
            </div>
          </article>
          
          <div class="ctrl-player container">
              <h2>ดูหนังออนไลน์ <?=$movie['title']?></h2>
                <div class="trailer" style="position:relative;">
                  <!--<video width="984" height="560" preload controls>
                      <source type="video/mp4" src="http://122.155.197.142:1935/vod/_definst_/mp4:movies/hawaii-five-o-s4-ep1.mp4/playlist.m3u8"></source>
                      <source type="video/mp4" src="rtsp://122.155.197.142:1935/vod/_definst_/movies/hawaii-five-o-s4-ep1.mp4"></source>
                      <source type="video/mp4" src="http://122.155.197.142:1935/vod/_definst_/mp4:movies/hawaii-five-o-s4-ep1.mp4/manifest.f4m"></source>
                      <source type="video/mp4" src="http://122.155.197.142:1935/vod/mp4:sample.mp4/manifest.mpd"></source>
                      Your browser does not support the video tag.
                    </video>-->
                    <iframe width="984" height="560" frameborder="0" allowfullscreen="" src="<?=base_url('/jwplayer.php?movie_id='.$movie['movie_id'])?>" class="mp4downloader_embedButtonInitialized mp4downloader_tagChecked "></iframe>
                    <?php 
                    if(isset($memberLogin)&&$memberLogin){
                      if(isset($memberLogin['canwatch'])&&$memberLogin['canwatch']){ 
                      }else{?>
                        <a href="<?=base_url('/package')?>"><div style="width:100%;height:100%;background-color:red;position:absolute;top:0px;opacity:0;">&nbsp;</div></a>
                      <?php }?>
                    <?php }else{?>
                        <a href="<?=base_url('/login')?>"><div style="width:100%;height:100%;background-color:red;position:absolute;top:0px;opacity:0;">&nbsp;</div></a>
                    <?php }?>
                </div>
          </div>
          
          <div class="frame-fb container mb2">
              <div id="fb-root"></div>
              <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.0";
                fjs.parentNode.insertBefore(js, fjs);
              }(document, 'script', 'facebook-jssdk'));</script>
              <div class="fb-comments" data-href="<?=base_url('/movie/'.$movie['movie_id'])?>" data-width="1170" data-numposts="5" data-colorscheme="light"></div>
           
          <!--iframe id="f2ad8bf703242e" name="f20f6d02f92de4" scrolling="no" style="border: medium none; overflow: hidden; height: 272px; width: 100%;" title="Facebook Social Plugin" class="fb_ltr" src="https://www.facebook.com/plugins/comments.php?api_key=533223390098647&amp;channel_url=http%3A%2F%2Fstatic.ak.facebook.com%2Fconnect%2Fxd_arbiter%2FDhmkJ2TR0QN.js%3Fversion%3D41%23cb%3Df30444a21fd4ca8%26domain%3Dvariety.horoworld.com%26origin%3Dhttp%253A%252F%252Fvariety.horoworld.com%252Ff29ddb32caefc86%26relation%3Dparent.parent&amp;colorscheme=light&amp;href=http%3A%2F%2Fvariety.horoworld.com%2F114547_%E0%B8%94%E0%B8%B9%E0%B8%94%E0%B8%A7%E0%B8%87-%E0%B9%81%E0%B8%97%E0%B8%84-%E0%B8%95%E0%B9%89%E0%B8%99%E0%B8%AB%E0%B8%AD%E0%B8%A1-%E0%B9%83%E0%B8%8A%E0%B9%88%E0%B8%AB%E0%B8%A3%E0%B8%B7%E0%B8%AD%E0%B8%A1%E0%B8%B1%E0%B9%88%E0%B8%A7%E0%B8%8A%E0%B8%B1%E0%B8%A7%E0%B8%A3%E0%B9%8C%E0%B8%AB%E0%B8%A3%E0%B8%B7%E0%B8%AD%E0%B9%84%E0%B8%A1%E0%B9%88&amp;locale=en_US&amp;numposts=10&amp;sdk=joey&amp;skin=light&amp;width=1170"></iframe-->
          
          </div>

          <?php if(isset($episodes)&&count($episodes)){ ?>
          <!-- Series Episode -->
          <div class="container bx-all-movies">
            <h2><a href="jaascript:;" title="<?=$movie['title']?>"><?=$movie['title']?> <i class="icon-double-angle-right"></i></a></h2>
            <ul class="thm-mv">
              <?php 
               $isLogin = (isset($memberLogin)&&$memberLogin)?'':' class="lb-popup" rel="#popup-login" '; 
              foreach($episodes as $episode){ ?>
              <li>
                <article>
                    <a title="<?=$episode['title']?>" <?=$isLogin?> href="<?=base_url('/movie/'.$episode['movie_id'].'/'.$episode['episode_id'])?>">
                        <img alt="<?=$movie['title_en']?>" src="<?=static_url($movie['cover'])?>">
                        <h3><?=$episode['title']?></h3>
                        <span class="type <?=$movie['is_free']?"free":""; ?>"><?=$movie['is_free']?"free":($movie['is_hd']?"HD":"");?></span>
                    </a>
                    <footer>
                        <p class="sm"><a href="javascript:;" title="รายการโปรด"> <?=$episode['title']?></a></p>
                    </footer>
                </article>
            </li>
              <?php  }?>
              </ul>
          </div>  
          <!-- /Series Episode -->
          <?php }?>
          <?php if(isset($relates)){ ?>
          <!-- Movie Relates-->
          <div class="container bx-all-movies">
            <h2><a href="jaascript:;" title="ดูหนังเรื่องอื่นที่เกี่ยวข้อง">ดูหนังเรื่องอื่นที่เกี่ยวข้อง <i class="icon-double-angle-right"></i></a></h2>
            <ul class="thm-mv">
              <?php 
               $isLogin = (isset($memberLogin)&&$memberLogin)?'':' class="lb-popup" rel="#popup-login" '; 
              foreach($relates as $relate){ ?>
              <li>
                <article>
                    <a title="<?=$relate['title']?>" <?=$isLogin?> href="<?=base_url('/movie/'.$relate['movie_id'])?>">
                        <img alt="<?=$relate['title_en']?>" src="<?=static_url($relate['cover'])?>">
                        <h3><?=$relate['title']?></h3>
                        <span class="type <?=$relate['is_free']?"free":""; ?>"><?=$relate['is_free']?"free":($relate['is_hd']?"HD":"");?></span>
                    </a>
                    <footer>
                        <p class="sm"><a href="javascript:;" title=""> <?=$movie['summary']?></a></p>
                        <p class="rating"><i class="icon-star<?=$relate['score']>1?"":" drop"?>"></i><i class="icon-star<?=$relate['score']>2?"":" drop"?>"></i><i class="icon-star<?=$relate['score']>3?"":" drop"?>"></i><i class="icon-star<?=$relate['score']>4?"":" drop"?>"></i><i class="icon-star<?=$relate['score']>5?"":"drop"?>"></i></p>
                        <p class="fv"><a href="javascript:;" title="รายการโปรด"><i class="icon-heart-empty"></i> รายการโปรด</a></p>
                    </footer>
                </article>
            </li>
              <?php  }?>
              </ul>
          </div>
          <!-- /Movie Relates-->
          <?php } ?>
      </section>
  <!-- /container -->
  <!-- footer -->
    <?php include('footer.php');?>
  <!-- /footer -->

  <!-- javascript -->
	<?php include('javascript.php');?>
  <!-- /javascript -->
  </body>
</html>