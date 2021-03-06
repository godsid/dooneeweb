<?php 
	include('header.php');	
?>
  <body>
  <?php include('menu.php'); ?>
  <?php include('home_slide.php');?>
  <!-- container -->
  <section id="contents">
    <div class="container bx-mv-slide flexslider">
        <h2><a href="<?=base_url('/movie/hot')?>" title="หนังยอดนิยม 20 อันดับ">หนังยอดนิยม <span class="txt-red">20 อันดับ</span> <i class="icon-double-angle-right"></i></a></h2>
        <ul class="slides thm-mv">
          <?php 
          $isLogin = (isset($memberLogin)&&$memberLogin)?'':' class="lb-popup" rel="#popup-login" ';
          foreach ($moviesHot as $key => $movie) { 
            $popup = ($movie['is_18']=='YES')?' class="lb-popup'.($isLogin?' withlogin ':'').'" rel="#popup-age" ':$isLogin;
          ?>
          <li>
              <article>
                  <a title="<?=$movie['title']?>" <?=$popup?> href="<?=base_url('/movie/'.$movie['movie_id'])?>">
                      <img alt="<?=$movie['title_en']?>" src="<?=static_url($movie['cover'])?>">
                      <h3><?=$movie['title']?></h3>
                      <?php if($movie['is_soon']=='YES'){?>
                      <span class="type soon">coming soon</span>
                      <?php }elseif($movie['is_free']=='YES'){?>
                      <span class="type free">free</span>
                      <?php }elseif($movie['is_hd']=='YES'){?>
                      <span class="type HD">HD</span>
                      <?php }?>
                  </a>
                  <footer>
                    <p class="sm"><a href="javascript:;" title="รายการโปรด"> <?=$movie['summary']?></a></p>
                    <p class="rating"><i class="icon-star<?=$movie['score']>0?"":" drop"?>"></i><i class="icon-star<?=$movie['score']>1?"":" drop"?>"></i><i class="icon-star<?=$movie['score']>2?"":" drop"?>"></i><i class="icon-star<?=$movie['score']>3?"":" drop"?>"></i><i class="icon-star<?=$movie['score']>4?"":" drop"?>"></i></p>
                    <p class="fv hid"><a href="javascript:;" class="movie<?=$movie['movie_id']?>" data-movie-id="<?=$movie['movie_id']?>" title="เพิ่ม รายการโปรด"><i class="icon-heart-empty"></i> รายการโปรด</a></p>
                  </footer>
              </article>
          </li>
          <?php } ?>
        </ul>
      </div>

      <div class="container bx-all-movies">
        <h2><a href="<?=base_url('/movie')?>" title="หนังทั้งหมด">หนังทั้งหมด <i class="icon-double-angle-right"></i></a></h2>
        <ul class="thm-mv is-pageing">
        <?php foreach ($movies['items'] as $key => $movie) { 
            $popup = ($movie['is_18']=='YES')?' class="lb-popup'.($isLogin?' withlogin ':'').'" rel="#popup-age" ':$isLogin;
          ?>
          <li>
            <article>
                <a title="<?=$movie['title']?>" <?=$popup?> href="<?=base_url('/movie/'.$movie['movie_id'])?>">
                <?php if($key<5){ ?>
                  <img alt="<?=$movie['title_en']?>" src="<?=static_url($movie['cover'])?>">
                <?php }else{?>
                  <img alt="<?=$movie['title_en']?>" class="lazy" src="img/blank.gif" data-src="<?=static_url($movie['cover'])?>">
                <?php } ?>
                    
                    <h3><?=$movie['title']?></h3>
                    <?php if($movie['is_soon']=='YES'){?>
                    <span class="type soon">coming soon</span>
                    <?php }elseif($movie['is_free']=='YES'){?>
                    <span class="type free">free</span>
                    <?php }elseif($movie['is_hd']=='YES'){?>
                    <span class="type HD">HD</span>
                    <?php }?>
                    
                </a>
                <footer>
                  <p class="sm"><a href="javascript:;" title="เพิ่ม รายการโปรด"> <?=$movie['summary']?></a></p>
                  <p class="rating"><i class="icon-star<?=$movie['score']>0?"":" drop"?>"></i><i class="icon-star<?=$movie['score']>1?"":" drop"?>"></i><i class="icon-star<?=$movie['score']>2?"":" drop"?>"></i><i class="icon-star<?=$movie['score']>3?"":" drop"?>"></i><i class="icon-star<?=$movie['score']>4?"":" drop"?>"></i></p>
                  <p class="fv hid"><a href="javascript:;" class="movie<?=$movie['movie_id']?>" data-movie-id="<?=$movie['movie_id']?>" title="เพิ่ม รายการโปรด"><i class="icon-heart-empty"></i> รายการโปรด</a></p>
                </footer>
            </article>
          </li>  
        <?php }?>
      </ul>
      <?php if($movies['pageing']['page']<$movies['pageing']['maxPage']){?>
        <div class="ctrl-page">
          <a class="load-more" onclick="return nextpage();" href="<?=base_url('/movie?more=1&page='.($movies['pageing']['page']+1).'&limit='.$movies['pageing']['itemPerPage'])?>" title="โหลดข้อมูลเพิ่ม">โหลดข้อมูลเพิ่ม <i class="icon-plus"></i></a>
        </div>
      <?php }?>
    </div>
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