<?php 
	include('header.php');	
?>
  <body>
	<?php include('menu.php'); ?>
  <?php //include('home_slide.php'); ?>
  <!-- container -->
  <section id="contents">
  
   <div class="container label-sort">
      <h2>เลือกจากตัวอักษร</h2>
      <?php 
      $a = explode(',',"A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z");
      ?>
        <ul>
        <li><a <?=(isset($letter)?"":"class=\"selected\"")?> href="<?=base_url('/movie')?>" title="ทั้งหมด">ทั้งหมด</a></li>
        <?php foreach ($a as $value) {?>
          <li><a <?=(isset($letter)&&$letter==$value)?"class=\"selected\"":""?> href="<?=base_url('/movie/letter/'.$value)?>" title="<?=$value?>"><?=$value?></a></li>
        <?php }?>
        </ul>
   </div>
   <div class="container bx-all-movies">
      <h2><a href="<?=home_url()?>" title="หนัง/ซีรีส์ทั้งหมด">หนัง/ซีรีส์ทั้งหมด <i class="icon-double-angle-right"></i></a>
      <?php if(isset($search)){ ?>
        ผลการค้นหา <span class="txt-red">"<?=$search?>"</span> พบทั้งหหมด <span class="txt-red"><?=$movies['pageing']['allItem']?></span> เรื่อง
      <?php }elseif($this->uri->segment(2)=='hot'){ ?>
        <a href="<?=base_url('/movie/hot')?>" title="หนัง/ซีรี่ส์ยอดนิยม 20 อันดับ">หนัง/ซีรี่ส์ยอดนิยม  <span class="txt-red">20 อันดับ</span> <i class="icon-double-angle-right"></i></a>
      <?php }elseif($this->uri->segment(2)=='letter'){ ?>
          <a href="<?=base_url('/letter/'.$this->uri->segment(3))?>" title="หนังหมวดอักษร <?=$this->uri->segment(3)?>">หนังหมวดอักษร "<span class="txt-red"><?=$this->uri->segment(3)?></span>"</a>
      <?php }elseif($this->uri->segment(2)=='series'){ ?>
          <a href="<?=base_url('/movie/series/')?>" title="ซีรี่ส์">ซีรี่ส์</a>
      <?php }elseif($this->uri->segment(2)=='cate'){ ?>
          <a href="<?=base_url('/movie/cate/'.$this->uri->segment(3))?>" title="หมวด">หมวด "<span class="txt-red"></span>"</a>
          <script type="text/javascript">
          $('.flexslider h2 a span:last').html($('#scroll-cat li').find('a[href$="/<?=$this->uri->segment(3)?>"]').attr('title'));
          </script>
      <?php } ?>
      </h2>
      <ul class="thm-mv is-pageing">

      <?php 
        $isLogin = (isset($memberLogin)&&$memberLogin)?'':' class="lb-popup" rel="#popup-login" ';
        foreach ($movies['items'] as $movie) {
          $popup = ($movie['is_18']=='YES')?' class="lb-popup'.($isLogin?' withlogin ':'').'" rel="#popup-age" ':$isLogin;
      ?>
        <li>
          <article>
              <a title="<?=$movie['title']?>" <?=$popup?> href="<?=base_url('/movie/'.$movie['movie_id'])?>">
                  <img alt="<?=$movie['title_en']?>" class="lazy" src="img/blank.gif" data-src="<?=static_url($movie['cover'])?>"  >
                  <h3><?=$movie['title']?></h3>
                  <?php if($movie['is_soon']=='YES'){?>
                  <span class="type soon">coming soon</span>
                  <?php }elseif($movie['is_free']=='YES'){?>
                  <span class="type free">Free</span>
                  <?php }elseif($movie['is_hd']=='YES'){?>
                  <span class="type HD">HD</span>
                  <?php }?>
              </a>
              <footer>
                <p class="sm"><a href="javascript:;" > <?=$movie['summary']?></a></p>
                <p class="rating"><i class="icon-star<?=$movie['score']>0?"":" drop"?>"></i><i class="icon-star<?=$movie['score']>1?"":" drop"?>"></i><i class="icon-star<?=$movie['score']>2?"":" drop"?>"></i><i class="icon-star<?=$movie['score']>3?"":" drop"?>"></i><i class="icon-star<?=$movie['score']>4?"":" drop"?>"></i></p>
                <p class="fv hid"><a href="javascript:;" class="movie<?=$movie['movie_id']?>" data-movie-id="<?=$movie['movie_id']?>" title="เพิ่ม รายการโปรด"><i class="icon-heart-empty"></i> รายการโปรด</a></p>
              </footer>
          </article>
        </li>
      <?php }?>
      </ul>
      <?php if($movies['pageing']['page']<$movies['pageing']['maxPage']){ ?>
        <div class="ctrl-page">
          <a class="load-more" onclick="return nextpage();" href="<?=base_url($this->uri->uri_string().'?'.(isset($search)?'q='.$search.'&':'').'more=1&page='.($movies['pageing']['page']+1).'&limit='.$movies['pageing']['itemPerPage'])?>" title="โหลดข้อมูลเพิ่ม">โหลดข้อมูลเพิ่ม <i class="icon-plus"></i></a>
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