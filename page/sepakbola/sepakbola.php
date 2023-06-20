<?php
include "koneksi.php";
$action=isset($_GET['submenu'])? $_GET['submenu'] :'';
switch($action){
default:
?>
<h1 class="text-center" style="margin-top:60px;"> Halaman Sepak Bola</h1>
<hr/>
<div class="row">
	<div class="col-sm-8">
	  <h4>Data Sepak Bola</h4>
	  <a href="?menu=sepakbola&submenu=tambah" class="btn btn-primary mb-2">Tambah Data</a>
	 <div class="table-responsive ">
	 <table class="table table-hover">
	  <thead class="thead-dark">
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Klub</th>
			<th>Negara</th>
			<th>No. Punggung</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
	  </thead>
	  <tbody>
	<?php 
	
	$query=mysqli_query($koneksi, "SELECT * FROM sepakbola ORDER BY nama_orang asc");
	$no=1;
	while($d=mysqli_fetch_assoc($query)){ 
	//ini menghasilkan array associative
	?>
		<tr>
			<td><?= $no; ?></td>
			<td><?= $d['nama_orang']; ?></td>
			<td><?= $d['klubnya']; ?></td>
			<td><?= strtolower($d['negaranya']); ?></td>
			<td><?= $d['no_punggung']; ?></td>
			<td><a href="?menu=sepakbola&submenu=edit&id=<?= $d['id_sepakbola'];?>">Edit</a></td>
			<td>
				<a href="?menu=sepakbola&submenu=hapus&id=<?= $d['id_sepakbola'];?>" 
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
<h1 class="text-center" style="margin-top:60px;"> Tambah Halaman Sepakbola</h1>
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
				<label for="usia">No. Punggung</label><br/>
				<input type="number" class="form-control" name="nomorPunggung" id="nomorPunggung" value="1" min="1" max="100" required autocomplete="off"/>
			</div>
			
			
			<button type="submit" name="submit" class="btn btn-primary">Tambah Data</button>
			<a href="?menu=sepakbola" class="btn btn-info">Kembali</a>
		</form>
	</div>
</div> <!-- end row -->
<?php 
if(isset($_POST['submit'])){ //jika tombol submit di klik
	//ambil data dari form input
	//mengabaikan tanda petik
	$nama=mysqli_real_escape_string($koneksi, $_POST['nama']); 
	$negara=htmlspecialchars($_POST['negara']); //mengabaikan tag html; 
	$klub=htmlspecialchars($_POST['klub']);
	$nomorPunggung=$_POST['nomorPunggung'];
	$query=mysqli_query($koneksi, 
		"INSERT INTO sepakbola VALUES 
		('','$nama','$klub','$negara','$nomorPunggung')
		");
	$sukses=mysqli_affected_rows($koneksi);
	if($sukses > 0){
		echo "<script>alert('Data Berhasil di Tambah');
			window.location.href='?menu=sepakbola';
		</script>";
	}else{
		echo "<script>alert('Data GAGAL di Tambah');
			window.location.href='?menu=sepakbola';
		</script>"; 
	}
}
?>
<?php 
break;

case "edit":
	//mengambil id yang dikirim melalui URL..
	$id=$_GET['id'];
	//query ke tabel sesuai dengan ID yang ada di URL
    $edit=mysqli_query($koneksi,"SELECT * FROM sepakbola WHERE id_sepakbola='$id'");
    $d=mysqli_fetch_array($edit);
?>
<h1 class="text-center" style="margin-top:60px;"> Edit Halaman sepakbola</h1>
<hr/>
<div class="row">
	<div class="col-sm-4">
		<form method="POST">
			<input type="hidden" name="id" value="<?=$d['id_sepakbola'];?>" />
			<div class="form-group">
				<label for="nama">Nama</label><br/>
				<input type="text" class="form-control" name="nama" id="nama" value="<?=$d['nama_orang'];?>" required placeholder="tulis nama" autocomplete="off" />
			</div>
			<div class="form-group">
				<label for="klub">Klub</label><br/>
				<input type="text" class="form-control"  name="klub" id="klub" value="<?=$d['klubnya'];?>"/>
			</div>
			<div class="form-group">
				<label for="negara">Negara</label><br/>
				<input type="text" class="form-control"  name="negara" id="negara" value="<?=$d['negaranya'];?>"/>
			</div>
			<div class="form-group">
				<label for="usia">Nomor Punggung</label><br/>
				<input type="number" class="form-control" name="nomorPunggung" id="nomorPunggung" value="<?=$d['no_punggung'];?>" min="1" max="100" required autocomplete="off"/>
			</div>
			
			
			<button type="submit" name="submit" class="btn btn-primary">Edit Data</button>
			<a href="?menu=sepakbola" class="btn btn-info">Kembali</a>
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
	$nomorPunggung=$_POST['nomorPunggung'];
	$query=mysqli_query($koneksi, "UPDATE sepakbola SET 
	nama_orang='$nama', negaranya='$negara', klubnya='$klub', no_punggung='$nomorPunggung'
	WHERE id_sepakbola='$id' ");
	$sukses=mysqli_affected_rows($koneksi);
	if($sukses > 0){
		echo "<script>alert('Data Berhasil di UBAH');
			window.location.href='?menu=sepakbola';
		</script>";
	}else{
		echo "<script>alert('Data GAGAL di UBAH');
			window.location.href='?menu=sepakbola';
		</script>"; 
	}
}
break;
case "hapus":
  $query=mysqli_query($koneksi,"select id_sepakbola from sepakbola where id_sepakbola='$_GET[id]'");
  $cek=mysqli_num_rows($query);
  if($cek == 0){
	echo "<script>alert('Hapus Data Gagal, Data Tidak Ditemukan');
      window.location=('?menu=sepakbola')</script>";
  }else{
	$hapus=mysqli_query($koneksi,"DELETE FROM sepakbola WHERE id_sepakbola='$_GET[id]'");
	if($hapus){
      echo "<script>
      window.location=('?menu=sepakbola')</script>";
    }else{
      echo "<script>alert('Hapus Data Gagal');
      window.location=('?menu=sepakbola')</script>";
    }
  } 
break;
}