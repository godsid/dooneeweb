<?php 
  include('header.php');  
?>
  <body>
  <?php include('menu.php'); ?>
      <!-- container -->
      <section id="contents">

          <div class="container bx-about">
          	<h2><a href="<?=base_url('/aboutus')?>" title="<?=$page['title']?>"><?=$page['title']?> <i class="icon-double-angle-right"></i></a></h2>
            <div class="inner">
			<?=$page['description']?>
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