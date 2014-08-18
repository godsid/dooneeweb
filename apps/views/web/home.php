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
          foreach ($moviesHot as $key => $movie) { ?>
          <li>
              <article>
                  <a title="<?=$movie['title']?>" <?=$isLogin?> href="<?=base_url('/movie/'.$movie['movie_id'])?>">
                      <img alt="<?=$movie['title_en']?>" src="<?=static_url($movie['cover'])?>">
                      <h3><?=$movie['title']?></h3>
                      <?php if($movie['is_free']=='YES'){?>
                      <span class="type free">free</span>
                      <?php }elseif($movie['is_hd']=='YES'){?>
                      <span class="type HD">HD</span>
                      <?php }?>
                  </a>
                  <footer>
                    <p class="rating"><i class="icon-star<?=$movie['score']>1?"":" drop"?>"></i><i class="icon-star<?=$movie['score']>2?"":" drop"?>"></i><i class="icon-star<?=$movie['score']>3?"":" drop"?>"></i><i class="icon-star<?=$movie['score']>4?"":" drop"?>"></i><i class="icon-star<?=$movie['score']>5?"":"drop"?>"></i></p>
                    <p class="fv"><a href="javascript:;" title="รายการโปรด"><i class="icon-heart-empty"></i> รายการโปรด</a></p>
                  </footer>
              </article>
          </li>
          <?php } ?>
        </ul>
      </div>

      <div class="container bx-all-movies">
        <h2><a href="<?=base_url('/movie')?>" title="หนังทั้งหมด">หนังทั้งหมด <i class="icon-double-angle-right"></i></a></h2>
        <ul class="thm-mv">
        <?php foreach ($movies['items'] as $key => $movie) { ?>
          <li>
            <article>
                <a title="<?=$movie['title']?>" <?=$isLogin?> href="<?=base_url('/movie/'.$movie['movie_id'])?>">
                    <img alt="<?=$movie['title_en']?>" src="<?=static_url($movie['cover'])?>">
                    <h3><?=$movie['title']?></h3>
                    <?php if($movie['is_free']=='YES'){?>
                    <span class="type free">free</span>
                    <?php }elseif($movie['is_hd']=='YES'){?>
                    <span class="type HD">HD</span>
                    <?php }?>
                    
                </a>
                <footer>
                  <p class="rating"><i class="icon-star<?=$movie['score']>1?"":" drop"?>"></i><i class="icon-star<?=$movie['score']>2?"":" drop"?>"></i><i class="icon-star<?=$movie['score']>3?"":" drop"?>"></i><i class="icon-star<?=$movie['score']>4?"":" drop"?>"></i><i class="icon-star<?=$movie['score']>5?"":"drop"?>"></i></p>
                  <p class="fv"><a href="javascript:;" title="รายการโปรด"><i class="icon-heart-empty"></i> รายการโปรด</a></p>
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