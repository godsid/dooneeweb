<?php 
  include('header.php');  
?>
  <body>
  <?php include('menu.php'); ?>
      <!-- container -->
      <section id="contents">
          <div class="container bx-all-pro">
            <h2 class="big"><a href="<?=base_url('/news')?>" title="ข่าว/โปรโมชั่น">ข่าว/<span class="txt-red">โปรโมชั่น</span> <i class="icon-double-angle-right"></i></a></h2>
            <div id="toc" class="mask-col">
                <article class="contents-auto reader">
                  <figure><img src="<?=static_url($news['cover'])?>" alt=""><figcaption class="hid"><?=$news['title']?></figcaption></figure>
                  <h1><?=$news['title']?></h1>
                    <?=nl2br($news['description'])?>
                </article>
                <!--
                <aside id="aside" class="aside">
                  <div class="ads_300x250">
                      <img src="img/ads_300x250.jpg" alt="ADs">
                    </div>
                    <div class="sr-related">
                      <h3><a href="#" title="โปรโมชั่นอื่นๆ">โปรโมชั่นอื่นๆ</a></h3>
                        <div class="thm-news">
                        <article>
                          <a title="" href="promotion-detail.php">
                            <img alt="" src="/image/dsd">
                            <h3>Title</h3>
                          </a>
                        </article>            
                        </div>
                        <a class="more" href="#" title="ดูทั้งหมด &raquo;">ดูทั้งหมด &raquo;</a>
                    </div>
                </aside>
                -->
            </div>
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