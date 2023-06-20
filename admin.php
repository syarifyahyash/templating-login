<?php
session_start();
if (empty($_SESSION['username'])){
  header("location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="bootstrap-4/css/bootstrap.min.css">
	<link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" />
	<title>Web App</title>
  
</head>
<body class="mt-5">

<?php 
include "menu.php";
?>

<div class="container">
  <?php 
  include "tengah.php";
  ?>
</div> <!-- container -->

<div class="mt-5"></div>

<!-- Footer -->
<footer>
  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    © <?php echo date("Y"); ?> Copyright:
    <a class="text-reset fw-bold" href="https://unira.ac.id/">INFORMATIKA UNIRA</a>
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->





    <script src="bootstrap-4/js/jquery-3.3.1.slim.min.js"></script>
    <script src="bootstrap-4/js/popper.min.js"></script>
    <script src="bootstrap-4/js/bootstrap.min.js"></script>
</body>
</html>