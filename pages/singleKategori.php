<?php include __DIR__ . '/../koneksi.php'; ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/singelkategori.css">
    <link rel="stylesheet" type="text/css" href="../fontawesome/css/all.min.css">

    <title>Toko Online</title>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="../assets/logo.png" alt="" width="30" height="24" class="me-2">
          SUKASUKA <strong>Store</strong>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" href="keranjangProduk.php">KERANJANG</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="singleProduk.php">NEW ITEM</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="seconditem.php">SECOND ITEM</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Breadcrumb -->
    <div class="container">
      <nav aria-label="breadcrumb" class="mt-3 bg-white">
        <ol class="breadcrumb p-3">
          <li class="breadcrumb-item"><a href="homePage.php" class="text-decoration-none">HOME</a></li>
          <li class="breadcrumb-item active" aria-current="page">KATEGORI</li>
        </ol>
      </nav>
    </div>

    <!-- Kategori Brand -->
    <div class="container mt-3">
      <div class="judul-kategori" style="background-color: #fff; padding: 5px 5px;">

        <h5 class="text-center fw-bold" style="margin-top: 10px;">KATEGORI</h5>

      </div>
      <div class="row text-center row-container mt-3 justify-content-center">

      </div>
      <div class="row text-center mt-3">
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-4">
          <a href="adidas_produk.php" class="text-decoration-none text-dark">
            <img src="../assets/kategori/adidas.jpg" class="img-fluid mb-2" alt="Adidas">
            <p class="mb-0">Adidas</p>
          </a>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-4">
          <a href="converse_produk.php" class="text-decoration-none text-dark">
            <img src="../assets/kategori/converse.jpg" class="img-fluid mb-2" alt="Converse">
            <p class="mt-2">Converse</p>
          </a>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-4">
          <a href="nike_produk.php" class="text-decoration-none text-dark">
            <img src="../assets/kategori/nike.jpg" class="img-fluid mb-2" alt="Nike">
            <p class="mt-2">Nike</p>
          </a>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-4">
          <a href="vans_produk.php" class="text-decoration-none text-dark">
            <img src="../assets/kategori/vans.jpg" class="img-fluid mb-2" alt="Vans">
            <p class="mb-0">Vans</p>
          </a>
        </div>
      </div>
      
    <!-- Akhir Kategori Brand -->

    <!-- Footer -->
    <footer class="bg-light p-5 mt-5">
      <div class="container">
        <div class="row">
          <div class="col-md-6 text-md-start text-center">
            <a href="#"><img src="../assets/logo.png" style="width: 40px;"></a>
            <span class="ps-1">karya <a href="https://www.instagram.com/sukasuka/" class="text-decoration-none text-dark fw-bold">sukasuka</a></span>
          </div>
          <div class="col-md-6 text-md-end text-center">
            <a href="#"><img src="../assets/sosialmedia/fb.png" class="ms-2" style="width: 40px;"></a>
            <a href="#"><img src="../assets/sosialmedia/instagram.png" class="ms-2" style="width: 40px;"></a>
            <a href="#"><img src="../assets/sosialmedia/linee.png" class="ms-2" style="width: 52px;"></a>
            <a href="#"><img src="../assets/sosialmedia/twitter.png" class="ms-2" style="width: 30px;"></a>
          </div>
        </div>
      </div>
    </footer>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
