<?php
session_start();
if (!empty($_SESSION['username'])){
  header("location:admin.php?menu=home");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="bootstrap-4/css/bootstrap.min.css">
	<title>Belajar Web Programming</title>
	<link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" />
	
</head>
<body>

<div class="container">
	<h4 class="text-center">Halaman Login</h4>
	<div class="row">
		<div class="col-sm-4">&nbsp;</div>
		<div class="col-sm-4">
			<form method="POST">
			  <div class="form-group">
				<label for="username">Username</label>
				<input type="text" class="form-control" id="username" name="username">
			  </div>
			  <div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control" id="password" name="password">
			  </div>
			  <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
				<?php if(isset($_GET['login'])=="gagal"){?>
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Login Gagal</strong> Cek Kembali Username dan Passwordmu
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php } ?>
			</form>
		</div>
		<div class="col-sm-4">&nbsp;</div>
	</div><!-- end row -->
</div> <!-- end container -->
<?php 
include "koneksi.php";
if(isset($_POST['login'])){ //jika tombol submit di klik
	$username = $_POST['username'];
	$pass     = md5($_POST['password']);
	$login=mysqli_query($koneksi,"SELECT * FROM tbl_login WHERE username='$username' AND password='$pass' ");
	//utk mengetahui jumlah baris dari $login
	$ketemu=mysqli_num_rows($login);
	$r=mysqli_fetch_array($login);
	// Apabila username dan password ditemukan
	if ($ketemu > 0){  
	  $_SESSION['username']     = $r['username'];
	  $_SESSION['nama_lengkap']  = $r['nama_lengkap'];
	  
	  header("location:admin.php?menu=home");
	}else{
	  header("location:index.php?login=gagal");
	}
	
}
?>






    <script src="bootstrap-4/js/jquery-3.3.1.slim.min.js"></script>
    <script src="bootstrap-4/js/popper.min.js"></script>
    <script src="bootstrap-4/js/bootstrap.min.js"></script>
</body>
</html>