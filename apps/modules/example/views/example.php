<!DOCTYPE html>
<html>
  <head>
    <title>Codeigneter 2.0 Example</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet" media="screen">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <h1>Codeigneter 2.0 Example</h1>
	<div class="container">
		<div class="row">
			<div class="sideleft span3">
				<ul class="nav nav-pills nav-stacked">
					<li><a href="<?php echo base_url('/example/bootstrap')?>" title="Bootstrap">Bootstrap</a></li>
					<li><a href="<?php echo base_url('/example/angularjs')?>" title="Angularjs">Angularjs</a></li>
				</ul>
			</div>
			<div class="sideright span9">
				<p>sideright</p>
			</div>
			
		</div>


	</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url('/assets/js/jquery.min.js')?>"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url('/assets/js/bootstrap.min.js')?>"></script>
  </body>
</html>