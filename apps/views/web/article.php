<?php 
  include('header.php');  
?>
  <body>
  <?php include('menu.php'); ?>
      <!-- container -->
      <section id="contents">
          <div class="container bx-all-pro">
            <?php
          if($this->uri->segment(1)=='news'){?>
            <h2 class="big"><a href="<?=base_url('/'.$this->uri->segment(1))?>" title="ข่าว/โปรโมชั่น">ข่าว/<span class="txt-red">โปรโมชั่น</span> <i class="icon-double-angle-right"></i></a></h2>
          <?php }else{ ?>
            <h2 class="big"><a href="<?=base_url('/'.$this->uri->segment(1))?>" title="วิธีการรับชม">ข่าว/<span class="txt-red">วิธีการรับชม</span></a></h2>
          <?php }
          ?>
            <div class="thm-news _cd-col-xs-6-sm-4-md-3">
                <?php for($i=0,$j=count($article['items']);$i<$j;$i++){ ?>
                    <article>
                        <a title="<?=$article['items'][$i]['title']?>" href="<?=base_url('/'.$this->uri->segment(1).'/'.$article['items'][$i]['article_id'])?>">
                            <img alt="" class="lazy" src="img/blank.gif" data-src="<?=static_url($article['items'][$i]['cover'])?>">
                            <h3><?=$article['items'][$i]['title']?></h3>
                        </a>
                    </article>
                <?php } ?>
              </div>
              <?php if($article['pageing']['page']<$article['pageing']['maxPage']){ ?>
              <div class="ctrl-page">
                <a class="load-more" href="<?=base_url('/'.$this->uri->segment(1).'/?page='.($article['pageing']['page']+1).'&limit='.$article['pageing']['itemPerPage'])?>" title="โหลดข้อมูลเพิ่ม">โหลดข้อมูลเพิ่ม <i class="icon-plus"></i></a>
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