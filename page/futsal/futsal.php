<?php
include "koneksi.php";
$action=isset($_GET['submenu'])? $_GET['submenu'] :'';
switch($action){
default:
?>
<h1 class="text-center" style="margin-top:60px;"> Halaman Futsal</h1>
<hr/>
<div class="row">
	<div class="col-sm-8">
	  <h4>Data Sepak Bola 2</h4>
	  
	  <form method="POST" action="">
		<div class="input-group mb-3">
		  <div class="input-group-prepend">
			<a href="?menu=football2&submenu=tambah" class="btn btn-success ">Tambah Data</a>
		  </div>
		  <input type="text" name="kata" class="form-control" placeholder="Cari Nama" autocomplete="off">
		  <div class="input-group-append">
			<button class="btn btn-success btn-sm" type="submit" name="cari">Go</button>
		  </div>
		</div>
	  </form>
	 <div class="table-responsive ">
	 <table class="table table-hover">
	  <thead class="thead-dark">
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Negara</th>
			<th>Klub</th>
			<th>Usia</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
	  </thead>
	  <tbody>
	<?php 
	if(isset($_POST['cari'])){
		$kata = $_POST['kata'];
		$query=mysqli_query($koneksi, "SELECT * FROM footballer WHERE nama LIKE '%$kata%' ORDER BY nama asc");
	}else{
		$query=mysqli_query($koneksi, "SELECT * FROM footballer ORDER BY nama asc");
	}
	
	$no=1;
	while($d=mysqli_fetch_assoc($query)){ 
	//ini menghasilkan array associative
	?>
		<tr>
			<td><?= $no; ?></td>
			<td><?= $d['nama']; ?></td>
			<td><?= strtolower($d['negara']); ?></td>
			<td><?= $d['klub']; ?></td>
			<td><?= $d['usia']; ?></td>
			<td><a href="?menu=football2&submenu=edit&id=<?= $d['id_footballer'];?>">Edit</a></td>
			<td>
				<a href="?menu=football2&submenu=hapus&id=<?= $d['id_footballer'];?>" 
				onClick="return confirm('Yakin mau di hapus?');">Delete</a>
			</td>
		</tr>
	<?php 
	$no++;
	} 
	?>
	  </tbody>
	 </table>
	 </div> <!-- end div responsive -->
	</div>
	<div class="col-sm-4">
	<?php $status=isset($_GET['status'])?$_GET['status']:"";?>
	<?php if($status=="sukses"){ ?>
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>Tambah Data Sukses</strong> Data Telah Berhasil Di Tambahkan
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	<?php } else if($status=="gagal"){ ?>
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong>Tambah Data Gagal</strong> Data Gagal Di Tambahkan
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	<?php } else if(empty($status)){ ?>
	
	<?php }?>
		
		<!-- alerts 2-->
		  <div class="alert alert-success" role="alert">
			<h4 class="alert-heading">Well done!</h4>
			<p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
			<hr>
			<p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
		  </div>
	</div>
  </div> <!-- end row -->
<?php 
break;

case "tambah":
?>
<h1 class="text-center" style="margin-top:60px;"> Tambah Halaman Football 2</h1>
<hr/>
<div class="row">
	<div class="col-sm-4">
		<form method="POST">
			<div class="form-group">
				<label for="nama">Nama</label><br/>
				<input type="text" class="form-control" name="nama" id="nama" required placeholder="tulis nama" autocomplete="off" />
			</div>
			<div class="form-group">
				<label for="negara">Negara</label><br/>
				<input type="text" class="form-control"  name="negara" id="negara"/>
			</div>
			<div class="form-group">
				<label for="klub">Klub</label><br/>
				<input type="text" class="form-control"  name="klub" id="klub"/>
			</div>
			<div class="form-group">
				<label for="usia">Usia</label><br/>
				<input type="number" class="form-control" name="usia" id="usia" value="1" min="1" max="100" required autocomplete="off"/>
			</div>
			
			
			<button type="submit" name="submit" class="btn btn-primary">Tambah Data</button>
			<a href="?menu=football2" class="btn btn-info">Kembali</a>
		</form>
	</div>
</div> <!-- end row -->
<?php 
if(isset($_POST['submit'])){ //jika tombol submit di klik
	//ambil data dari form input
	//mengabaikan tanda petik
	//$nama=mysqli_real_escape_string($koneksi, $_POST['nama']); 
	$nama=$_POST['nama']; 
	$negara=htmlspecialchars($_POST['negara']); //mengabaikan tag html; 
	$klub=htmlspecialchars($_POST['klub']);
	$usia=$_POST['usia'];
	$query=mysqli_query($koneksi, 
		"INSERT INTO footballer VALUES 
		('','$nama','$negara','$klub','$usia')
		");
	$sukses=mysqli_affected_rows($koneksi);
	if($sukses > 0){
		echo "<script>
			window.location.href='?menu=football2&status=sukses';
		</script>";
	}else{
		echo "<script>
			window.location.href='?menu=football2&status=gagal';
		</script>"; 
	}
}
?>
<?php 
break;
case "edit":
	$id=$_GET['id'];
    $edit=mysqli_query($koneksi,"SELECT * FROM footballer WHERE id_footballer='$id'");
    $d=mysqli_fetch_array($edit);
?>
<h1 class="text-center" style="margin-top:60px;"> Edit Halaman Football</h1>
<hr/>
<div class="row">
	<div class="col-sm-4">
		<form method="POST">
			<input type="hidden" name="id" value="<?=$d['id_footballer'];?>" />
			<div class="form-group">
				<label for="nama">Nama</label><br/>
				<input type="text" class="form-control" name="nama" id="nama" value="<?=$d['nama'];?>" required placeholder="tulis nama" autocomplete="off" />
			</div>
			<div class="form-group">
				<label for="negara">Negara</label><br/>
				<input type="text" class="form-control"  name="negara" id="negara" value="<?=$d['negara'];?>"/>
			</div>
			<div class="form-group">
				<label for="klub">Klub</label><br/>
				<input type="text" class="form-control"  name="klub" id="klub" value="<?=$d['klub'];?>"/>
			</div>
			<div class="form-group">
				<label for="usia">Usia</label><br/>
				<input type="number" class="form-control" name="usia" id="usia" value="<?=$d['usia'];?>" min="1" max="100" required autocomplete="off"/>
			</div>
			
			
			<button type="submit" name="submit" class="btn btn-primary">Edi Data</button>
			<a href="?menu=football" class="btn btn-info">Kembali</a>
		</form>
	</div>
</div> <!-- end row -->
<?php 
if(isset($_POST['submit'])){ //jika tombol submit di klik
	//ambil data dari form input
	$id=$_POST['id'];
	$nama=mysqli_real_escape_string($koneksi, $_POST['nama']); //mengabaikan tanda petik
	$negara=htmlspecialchars($_POST['negara']); //mengabaikan tag html;
	$klub=$_POST['klub'];
	$usia=$_POST['usia'];
	$query=mysqli_query($koneksi, "UPDATE footballer SET 
	nama='$nama', negara='$negara', klub='$klub', usia='$usia'
	WHERE id_footballer='$id' ");
	$sukses=mysqli_affected_rows($koneksi);
	if($sukses > 0){
		echo "<script>alert('Data Berhasil di UBAH');
			window.location.href='?menu=football2';
		</script>";
	}else{
		echo "<script>alert('Data GAGAL di UBAH');
			window.location.href='?menu=football2';
		</script>"; 
	}
}
break;
case "hapus":
  $query=mysqli_query($koneksi,"select id_footballer from footballer where id_footballer='$_GET[id]'");
  $cek=mysqli_num_rows($query);
  if($cek == 0){
	echo "<script>alert('Hapus Data Gagal, Data Tidak Ditemukan');
      window.location=('?menu=football')</script>";
  }else{
	$hapus=mysqli_query($koneksi,"DELETE FROM footballer WHERE id_footballer='$_GET[id]'");
	if($hapus){
      echo "<script>
      window.location=('?menu=football2')</script>";
    }else{
      echo "<script>alert('Hapus Data Gagal');
      window.location=('?menu=football2')</script>";
    }
  } 
break;
}