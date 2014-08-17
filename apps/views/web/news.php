<?php 
  include('header.php');  
?>
  <body>
  <?php include('menu.php'); ?>
      <!-- container -->
      <section id="contents">
          <div class="container bx-all-pro">
            <h2 class="big"><a href="<?=base_url("/news")?>" title="ข่าว/โปรโมชั่น">ข่าว/<span class="txt-red">โปรโมชั่น</span> <i class="icon-double-angle-right"></i></a></h2>
            <div class="thm-news _cd-col-xs-6-sm-4-md-3">
                <?php for($i=0,$j=count($news['items']);$i<$j;$i++){ ?>
                    <article>
                        <a title="<?=$news['items'][$i]['title']?>" href="<?=base_url('/news/'.$news['items'][$i]['news_id'])?>">
                            <img alt="" src="<?=static_url($news['items'][$i]['cover'])?>">
                            <h3><?=$news['items'][$i]['title']?></h3>
                        </a>
                    </article>
                <?php } ?>
              </div>
              <?php if($news['pageing']['page']<$news['pageing']['maxPage']){ ?>
              <div class="ctrl-page">
                <a class="load-more" href="<?=base_url('/news/?page='.($news['pageing']['page']+1).'&limit='.$news['pageing']['itemPerPage'])?>" title="โหลดข้อมูลเพิ่ม">โหลดข้อมูลเพิ่ม <i class="icon-plus"></i></a>
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