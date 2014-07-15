<!doctype html>
<html ng-app>
  <head>
    <script src="<?php echo base_url()?>/assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url()?>/assets/js/angular.min.js"></script>
  </head>
  <body>
    <div>
      <label>Name:</label>
      <input type="text" ng-model="yourName" placeholder="Enter a name here">
      <hr>
      <h1>Hello {{yourName}}!</h1>
    </div>
  </body>
</html>