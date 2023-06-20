<?php

// Bagian Home
if ($menu=='home'){
	include "page/home/home.php";
}

// Bagian football
elseif ($menu=='football'){
    include "page/football/football.php";   
}

// Bagian football2
elseif ($menu=='football2'){
    include "page/football2/football2.php";   
}

// Bagian futsal
elseif ($menu=='futsal'){
    include "page/futsal/futsal.php";   
}

// Bagian file
elseif ($menu=='file'){
    include "page/file/file.php";   
}

// Bagian sepakbola
elseif ($menu=='sepakbola'){
    include "page/sepakbola/sepakbola.php";   
}

// Apabila modul tidak ditemukan
else{
  echo "<h4 class='text-center' style='margin-top:60px;'><b>PAGE BELUM ADA ATAU BELUM LENGKAP ATAU ANDA TIDAK BERHAK 
  MENGAKSES HALAMAN INI</b></h4>";
}
?>
