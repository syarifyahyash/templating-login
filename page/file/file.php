<?php
include "koneksi.php";
$action=isset($_GET['submenu'])? $_GET['submenu'] :'';
switch($action){
default:
?>
<h1 class="text-center" style="margin-top:60px;"> Halaman File Saya</h1>
<hr/>
<div class="row">
	<div class="col-sm-8">
	  <h4>Data File Saya</h4>
	  <a href="?menu=file&submenu=tambah" class="btn btn-primary mb-2">Tambah Data</a>
	 <div class="table-responsive ">
	 <table class="table table-hover">
	  <thead class="thead-dark">
		<tr>
			<th>No</th>
			<th>Keterangan</th>
			<th>File</th>
			<th>Tanggal Upload</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
	  </thead>
	  <tbody>
	<?php 
	
	$query=mysqli_query($koneksi, "SELECT * FROM tbl_file ORDER BY id_file desc");
	$no=1;
	while($d=mysqli_fetch_assoc($query)){ 
	//ini menghasilkan array associative
	?>
		<tr>
			<td><?= $no; ?></td>
			<td><?= $d['nama_file']; ?></td>
			<td><img src="fileq/<?=$d['file_nya'];?>" style="width:50px; height:50px;"/></td>
			<td><?= $d['tgl_upload']; ?></td>
			<td><a href="?menu=file&submenu=edit&id=<?= $d['id_file'];?>">Edit</a></td>
			<td>
				<a href="?menu=file&submenu=hapus&id=<?= $d['id_file'];?>" 
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
<h1 class="text-center" style="margin-top:60px;"> Tambah Halaman File Saya</h1>
<hr/>
<div class="row">
	<div class="col-sm-4">
		<form method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="nama">Keterangan FIle</label><br/>
				<input type="text" class="form-control" name="nama" id="nama" required placeholder="tulis keterangan file" autocomplete="off" />
			</div>
			<div class="form-group">
				<label for="file">File</label><br/>
				<input type="file" class="form-control" name="file" id="file" required />
			</div>
			
			
			<button type="submit" name="submit" class="btn btn-primary">Tambah Data</button>
			<a href="?menu=file" class="btn btn-info">Kembali</a>
		</form>
	</div>
</div> <!-- end row -->
<?php 
if(isset($_POST['submit'])){ //jika tombol submit di klik
	//ambil data dari form input
	//mengabaikan tanda petik
	$nama=mysqli_real_escape_string($koneksi, $_POST['nama']); 
	
	//penanganan file gambar
	$validextensions = array("jpg", "JPG", "jpeg", "JPEG", "png", "PNG");
	$acak        = rand(1,9999);
	$temporary = explode(".", $_FILES["file"]["name"]); //unira.jpg
	//ini yang merubah nama gambar menjadi angka acak
	$namaGambar = $acak.round(microtime(true)) . '.' . end($temporary);//fungsi untuk membuat nama acak 
	
	$folder = "fileq/"; // folder untuk foto berita
	$file_upload = $folder . $namaGambar; // fileq/123412341234.jpg
	// Simpan/pindahkakn file dalam ukuran aslinya
	move_uploaded_file($_FILES["file"]["tmp_name"], $file_upload);
	
	$hari_ini=Date("Y-m-d");
	
	$query=mysqli_query($koneksi, 
		"INSERT INTO tbl_file VALUES 
		('','$nama','$namaGambar','$hari_ini')
		");
	$sukses=mysqli_affected_rows($koneksi);
	if($sukses > 0){
		echo "<script>alert('Data Berhasil di Tambah');
			window.location.href='?menu=file';
		</script>";
	}else{
		echo "<script>alert('Data GAGAL di Tambah');
			window.location.href='?menu=file';
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
    $edit=mysqli_query($koneksi,"SELECT * FROM tbl_file WHERE id_file='$id'");
    $d=mysqli_fetch_array($edit);
?>
<h1 class="text-center" style="margin-top:60px;"> Edit Halaman Football</h1>
<hr/>
<div class="row">
	<div class="col-sm-4">
		<form method="POST" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?=$d['id_file'];?>" />
			<div class="form-group">
				<label for="nama">Keterangan FIle</label><br/>
				<input type="text" class="form-control" name="nama" id="nama" value="<?=$d['nama_file'];?>" required placeholder="tulis keterangan file" autocomplete="off" />
			</div>
			<div class="form-group">
				<label for="file">File</label><br/>
				<input type="file" class="form-control" name="file" id="file"  />
				<span class="help-block">Kosongi jika file tidak ingin di ganti</span>
			</div>
			
			
			<button type="submit" name="submit" class="btn btn-primary">Edi Data</button>
			<a href="?menu=file" class="btn btn-info">Kembali</a>
		</form>
	</div>
</div> <!-- end row -->
<?php 
if(isset($_POST['submit'])){ //jika tombol submit di klik
	//ambil data dari form input
	$id=$_POST['id'];
	//dapatkan data berdasarkan id
	$kode=mysqli_query($koneksi, "SELECT * FROM tbl_file WHERE id_file='$id' ");
	$k=mysqli_fetch_assoc($kode);
	
	$nama=mysqli_real_escape_string($koneksi, $_POST['nama']); //mengabaikan tanda petik
	//jika user tidak mengirimkan gambar dari form input
	if(empty($_FILES['file']['name'])){
		$query=mysqli_query($koneksi, "UPDATE tbl_file SET 
		nama_file='$nama'
		WHERE id_file='$id' ");
		$sukses=mysqli_affected_rows($koneksi);
		if($sukses > 0){
			echo "<script>alert('Data Berhasil di UBAH');
				window.location.href='?menu=file';
			</script>";
		}else{
			echo "<script>alert('Data GAGAL di UBAH');
				window.location.href='?menu=file';
			</script>"; 
		}
	}else{
		//penanganan file gambar
		$validextensions = array("jpg", "JPG", "jpeg", "JPEG", "png", "PNG");
		$acak        = rand(1,9999);
		$temporary = explode(".", $_FILES["file"]["name"]);
		$namaGambar = $acak.round(microtime(true)) . '.' . end($temporary);//fungsi untuk membuat nama acak 
		$folder = "fileq/"; // folder untuk foto berita
		$file_upload = $folder . $namaGambar;
		// Simpan file dalam ukuran aslinya
		move_uploaded_file($_FILES["file"]["tmp_name"], $file_upload);
		
		$query=mysqli_query($koneksi, "UPDATE tbl_file SET 
		nama_file='$nama', file_nya='$namaGambar'
		WHERE id_file='$id' ");
		$sukses=mysqli_affected_rows($koneksi);
		if($sukses > 0){
			unlink("fileq/".$k['file_nya']);
			echo "<script>alert('Data Berhasil di UBAH');
				window.location.href='?menu=file';
			</script>";
		}else{
			echo "<script>alert('Data GAGAL di UBAH');
				window.location.href='?menu=file';
			</script>"; 
		}
	}
}
break;
case "hapus":
  //nanti, pastikan saat menghapus, juga harus bisa menghapus file yang ada di folder yang ada di htdocs aplikasinya..
  // jadi gak hanya ngapus data yang ada di dalam tabel.
  $query=mysqli_query($koneksi,"select * from tbl_file where id_file='$_GET[id]'");
  $r=mysqli_fetch_assoc($query);
  
  $cek=mysqli_num_rows($query);
  if($cek == 0){
	echo "<script>alert('Hapus Data Gagal, Data Tidak Ditemukan');
      window.location=('?menu=file')</script>";
  }else{
	$hapus=mysqli_query($koneksi,"DELETE FROM tbl_file WHERE id_file='$_GET[id]'");
	if($hapus){
      //perintah untuk menghapus file yang ada di direktori
	  unlink("fileq/".$r['file_nya']);
	  echo "<script>
      window.location=('?menu=file')</script>";
    }else{
      echo "<script>alert('Hapus Data Gagal');
      window.location=('?menu=file')</script>";
    }
  } 
break;
}