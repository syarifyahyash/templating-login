<?php 
//untuk ngecek, apakah ada atau tidak tipe get menu di URL browser, agar tidak muncul error 
//jika menu tidak di tulis
$menu=isset($_GET['menu'])?$_GET['menu']:"home";
?>
<nav class="navbar navbar-expand-lg navbar-dark  bg-dark fixed-top">
  <a class="navbar-brand" href="#">Belajar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?=($menu=="home")?"active":""?>">
        <a class="nav-link" href="?menu=home">Unira <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item <?=($menu=="football")?"active":""?>">
        <a class="nav-link" href="?menu=football">Football</a>
      </li>
	  <li class="nav-item <?=($menu=="file")?"active":""?>">
        <a class="nav-link" href="?menu=file">File</a>
      </li>
	  <li class="nav-item <?=($menu=="football2")?"active":""?>">
        <a class="nav-link" href="?menu=football2">Football2</a>
      </li>
	  <li class="nav-item <?=($menu=="futsal")?"active":""?>">
        <a class="nav-link" href="?menu=futsal">Futsal</a>
      </li>
    <li class="nav-item <?=($menu=="sepakbola")?"active":""?>">
      <a class="nav-link" href="?menu=sepakbola">Sepakbola</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>