<?php 
	include('header.php');	
?>

  <body>
  <script>
   $(document).ready(function(){
       $("#nav-drop li a").removeClass("selected");
       $('#nav-drop>li:nth-child(1)>a').addClass('selected');
  });
  </script>
	<?php include('menu.php'); ?>
  <!-- Highlight -->
  <!-- /Highlight --> 
  <!-- container -->
  <!-- /container -->
  <!-- footer -->
    <?php include('footer.php');?>
  <!-- /footer -->

  <!-- javascript -->
	<?php include('javascript.php');?>
  <!-- /javascript -->
  </body>
</html>