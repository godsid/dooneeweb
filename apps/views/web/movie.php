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
      $a=["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
      ?>
        <ul>
        <li><a <?=(isset($letter)?"":"class=\"selected\"")?> href="<?=base_url('/movie')?>" title="All">All</a></li>
        <?php foreach ($a as $value) {?>
          <li><a <?=(isset($letter)&&$letter==$value)?"class=\"selected\"":""?> href="<?=base_url('/movie/letter/'.$value)?>" title="<?=$value?>"><?=$value?></a></li>
        <?php }?>
        </ul>
   </div>
   <div class="container flexslider">
      <?php if(isset($search)){ ?>
        <h2>ผลการค้นหา "<?=$search?>" พบทั้งหหมด <?=$movies['pageing']['allItem']?></h2>
      <?php }else{ ?>
        <h2><a href="<?=home_url()?>" title="ดูหนังทั้งหมด">ดูหนังทั้งหมด <i class="icon-double-angle-right"></i></a></h2>
      <?php } ?>
      <ul class="thm-mv">
      <?php foreach ($movies['items'] as $movie) {?>
        <li>
          <article>
              <a title="<?=$movie['title']?>" href="<?=base_url('/movie/'.$movie['movie_id'])?>">
                  <img alt="<?=$movie['title_en']?>" src="<?=static_url($movie['cover'])?>">
                  <h3><?=$movie['title']?></h3>
                  <span class="type <?=$movie['is_free']?"free":""; ?>"><?=$movie['is_free']?"free":($movie['is_hd']?"HD":"");?></span>
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
          <a class="load-more" href="<?=base_url('/movie?page='.($movies['pageing']['page']+1).'&limit='.$movies['pageing']['itemPerPage'])?>" title="โหลดข้อมูลเพิ่ม">โหลดข้อมูลเพิ่ม <i class="icon-plus"></i></a>
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