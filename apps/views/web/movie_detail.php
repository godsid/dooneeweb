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
                          <?php if(strpos($movie['audio'], 'TH')!==false){ ?>
                          <a class="ui-btn btn-profile" onclick="window.open(this.href);return false;" href="<?=base_url('/movie/player/'.$movie['movie_id'].(isset($thisEpisode)?'/'.$thisEpisode['episode_id']:''))?>?lang=th&autoplay=1" title="เริ่มเล่นพากษ์ไทย">เริ่มเล่นพากษ์ไทย</a>
                          <?php } ?>
                          <?php if(strpos($movie['audio'], 'EN')!==false){ ?>
                          <a class="ui-btn btn-profile" onclick="window.open(this.href);return false;" href="<?=base_url('/movie/player/'.$movie['movie_id'].(isset($thisEpisode)?'/'.$thisEpisode['episode_id']:''))?>?lang=en&autoplay=1" title="Soundtrack">Soundtrack</a>
                          <?php }?>
                          <?php if(isset($memberLogin['is_favorite'])){ ?>
                            <a class="ui-btn-red btn-fv" onclick="deleteFavorite(this);return false;" data-fav-id="<?=$memberLogin['is_favorite']['favorite_id']?>" data-movie-id="<?=$movie['movie_id']?>" href="javascript:;" title="ลบ รายการโปรด"><i class="icon-heart"></i> รายการโปรด</a>
                          <?php }else{ ?>
                            <a class="ui-btn-grey btn-fv" onclick="addFavorite(this);return false;" data-movie-id="<?=$movie['movie_id']?>" href="javascript:;" title="รายการโปรด"><i class="icon-heart-empty"></i> รายการโปรด</a>
                          <?php }?>
                        <?php }else{ /* Not Login Member */ ?>
                            <a class="ui-btn-red btn-fill" href="<?=base_url('/package')?>" title="เติมเงินดูหนัง"><i class="icon-credit-card"></i> เติมเงินดูหนัง</a>
                        <?php }?>
                        
                        
                      <?php }else{?>
                          <a class="ui-btn btn-profile" href="<?=base_url('/login')?>" title="เข้าสู่ระบบ">เข้าสู่ระบบ</a>  
                      <?php } ?>
                    
                </p>
            </div>
            <div class="detai">
              <h1>ดูหนังออนไลน์ <?=$movie['title']?> </h1>
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
                    <a class="btn-share fb" onclick="window.open(this.href);return false;" href="https://www.facebook.com/sharer/sharer.php?u=<?=urlencode(base_url('/movie/'.$movie['movie_id']))?>"><i class="icon-facebook"></i></a>
                    <a class="btn-share tw" onclick="window.open(this.href);return false;" href="https://twitter.com/home?status=<?=urlencode("ดูหนังออนไลน์ ".$movie['title']."\r\n".base_url('/movie/'.$movie['movie_id']))?>"><i class="icon-twitter"></i></a>
                    <a class="btn-share gg" onclick="window.open(this.href);return false;" href="https://plus.google.com/share?url=<?=urlencode(base_url('/movie/'.$movie['movie_id']))?>"><i class="icon-google-plus"></i></a>
                    <!--<div class="socialshare-mini"></div>-->
                </div>
            </div>
          </article>

          <div class="ctrl-player container">
              <h2>ดูหนังออนไลน์ <?=$movie['title']?> <?=$thisEpisode['title']?> <?=($movie['is_soon']=='YES')?'<br/>Coming Soon':''?></h2>
              <?php if($movie['is_soon']=='NO'){ ?> 
                <div class="trailer" style="position:relative;">
                    <iframe width="984" height="560" frameborder="0" allowfullscreen="" src="<?=base_url('/movie/player/'.$movie['movie_id'].(isset($thisEpisode)?'/'.$thisEpisode['episode_id']:''))?>" class="mp4downloader_embedButtonInitialized mp4downloader_tagChecked "></iframe>
                    <?php 
                    if(isset($memberLogin)&&$memberLogin){
                      if(isset($memberLogin['canwatch'])&&$memberLogin['canwatch']){ ?>
                      <?php }else{ ?>
                        <a href="<?=base_url('/package')?>"><div style="width:100%;height:100%;background-color:red;position:absolute;top:0px;opacity:0;">&nbsp;</div></a>
                      <?php }?>
                    <?php }else{?>
                        <a href="<?=base_url('/login')?>"><div style="width:100%;height:100%;background-color:red;position:absolute;top:0px;opacity:0;">&nbsp;</div></a>
                    <?php }?>
                </div>
                <?php } ?>
          </div>
          <div class="frame-fb container mb2">
              <div id="fb-root"></div>
              <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&appId=<?=$this->config->item('facebook_appid')?>&version=v2.0";
                fjs.parentNode.insertBefore(js, fjs);
              }(document, 'script', 'facebook-jssdk'));</script>
              <div class="fb-comments" data-href="<?=base_url('/movie/'.$movie['movie_id'])?>" data-width="1170" data-numposts="5" data-colorscheme="light"></div>
           
          
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
                        <span class="type <?=$movie['is_free']=='YES'?"Free":""; ?>"><?=$movie['is_free']=='YES'?"Free":($movie['is_hd']=='YES'?"HD":"");?></span>
                    </a>
                    <footer>
                        <p class="sm"><a href="javascript:;" title=""> <?=$episode['title']?></a></p>
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

              foreach($relates as $relate){ 
                $popup = ($relate['is_18']=='YES')?' class="lb-popup'.($isLogin?' withlogin ':'').'" rel="#popup-age" ':$isLogin;
              ?>
              <li>
                <article>
                    <a title="<?=$relate['title']?>" <?=$popup?> href="<?=base_url('/movie/'.$relate['movie_id'])?>">
                        <img alt="<?=$relate['title_en']?>" src="<?=static_url($relate['cover'])?>">
                        <h3><?=$relate['title']?></h3>
                        <?php if($relate['is_soon']=='YES'){?>
                        <span class="type soon">coming soon</span>
                        <?php }elseif($relate['is_free']=='YES'){?>
                        <span class="type free">Free</span>
                        <?php }elseif($relate['is_hd']=='YES'){?>
                        <span class="type HD">HD</span>
                        <?php }?>
                    </a>
                    <footer>
                        <p class="sm"><a href="javascript:;" title=""> <?=$relate['summary']?></a></p>
                        <p class="rating"><i class="icon-star<?=$relate['score']>1?"":" drop"?>"></i><i class="icon-star<?=$relate['score']>2?"":" drop"?>"></i><i class="icon-star<?=$relate['score']>3?"":" drop"?>"></i><i class="icon-star<?=$relate['score']>4?"":" drop"?>"></i><i class="icon-star<?=$relate['score']>5?"":"drop"?>"></i></p>
                        <p class="fv hid"><a href="javascript:;" class="movie<?=$relate['movie_id']?>" data-movie-id="<?=$relate['movie_id']?>" title="เพิ่ม รายการโปรด"><i class="icon-heart-empty"></i> รายการโปรด</a></p>
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