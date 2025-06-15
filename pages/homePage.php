<?php include __DIR__ . '/../koneksi.php'; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Toko Online</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../css/styleHome.css">
  <link rel="stylesheet" type="text/css" href="../fontawesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../css/checkout.css">

</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#"><img src="../assets/logo.png" width="30" height="24" class="me-2"> SUKASUKA <strong>Store</strong></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link active" href="keranjangProduk.php">KERANJANG</a></li>
        <li class="nav-item"><a class="nav-link active" href="singleProduk.php">NEW ITEM</a></li>
        <li class="nav-item"><a class="nav-link active" href="seconditem.php">SECOND ITEM</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Breadcrumb -->
<div class="container">
  <nav aria-label="breadcrumb" style="background-color: #fff;" class="mt-3">
    <ol class="breadcrumb p-3">
      <li class="breadcrumb-item"><a href="homePage.php">HOME</a></li>
      <li class="breadcrumb-item"><a href="singleKategori.php">KATEGORI</a></li>
      <li class="breadcrumb-item"><a href="produkhome.php">PRODUK</a></li>
    </ol>
  </nav>
</div>

<!-- Carousel -->
<div class="container">
  <div id="carouselExampleIndicators" class="carousel slide mt-5" data-bs-ride="carousel" data-bs-interval="3000">
    <div class="carousel-inner">
      <div class="carousel-item active"><img src="../assets/img1.jpg" class="d-block img-fluid"></div>
      <div class="carousel-item"><img src="../assets/img2.jpg" class="d-block img-fluid"></div>
      <div class="carousel-item"><img src="../assets/img3.jpg" class="d-block img-fluid"></div>
      <div class="carousel-item"><img src="../assets/img4.jpg" class="d-block img-fluid"></div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>
</div>

<!-- Kategori -->
<div class="container mt-3">
  <div class="judul-kategori bg-white p-2">
    <h5 class="text-center fw-bold mt-2">KATEGORI</h5>
  </div>
  <div class="row text-center row-container mt-3 justify-content-center">
    <div class="col-lg-3 col-md-2 col-sm-4 col-6 mb-4">
      <div class="menu-kategori d-flex flex-column align-items-center">
        <a href="adidas_produk.php"><img src="../assets/kategori/adidas.jpg" class="img-category mt-3"></a>
        <p class="mt-2">Adidas</p>
      </div>
    </div>
    <div class="col-lg-3 col-md-2 col-sm-4 col-6 mb-4">
      <div class="menu-kategori d-flex flex-column align-items-center">
        <a href="converse_produk.php"><img src="../assets/kategori/converse.jpg" class="img-category mt-3"></a>
        <p class="mt-2">Converse</p>
      </div>
    </div>
    <div class="col-lg-3 col-md-2 col-sm-4 col-6 mb-4">
      <div class="menu-kategori d-flex flex-column align-items-center">
        <a href="nike_produk.php"><img src="../assets/kategori/nike.jpg" class="img-category mt-3"></a>
        <p class="mt-2">Nike</p>
      </div>
    </div>
    <div class="col-lg-3 col-md-2 col-sm-4 col-6 mb-4">
      <div class="menu-kategori d-flex flex-column align-items-center">
        <a href="vans_produk.php"><img src="../assets/kategori/vans.jpg" class="img-category mt-3"></a>
        <p class="mt-2">Vans</p>
      </div>
    </div>
  </div>
</div>

<!-- Produk Terbaru -->
<div class="container mt-5">
  <div class="judul-produk bg-white p-2">
    <h5 class="text-center fw-bold mt-2">PRODUK</h5>
  </div>
  <div class="row">
    <?php
    $query = $conn->query("SELECT * FROM produk_sepatu ORDER BY id DESC LIMIT 6");
    while($row = $query->fetch_assoc()): ?>
      <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-4">
        <div class="card text-center h-100">
          <img src="../assets/<?= strtolower($row['merek']) ?>/<?= $row['gambar'] ?>" class="card-img-top" style="height:180px; object-fit:cover;" alt="<?= $row['nama_produk'] ?>">
          <div class="card-body">
            <h6 class="card-title"><?= $row['nama_produk'] ?></h6>
            <p class="mb-1 text-muted"><?= $row['merek'] ?></p>
            <p class="mb-1"><strong>Color</strong>: <?= $row['warna'] ?></p>
            <p class="mb-1"><strong>Ukuran</strong>: <?= $row['ukuran'] ?></p>
            <p class="card-text">Rp. <?= number_format($row['harga'], 0, ',', '.') ?></p>
            <button class="btn btn-primary d-grid" onclick="tambahKeKeranjang('<?= $row['nama_produk'] ?>', <?= $row['harga'] ?>, '../assets/<?= strtolower($row['merek']) ?>/<?= $row['gambar'] ?>')">Beli</button>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>

<!-- Footer -->
<footer class="bg-light p-5 mt-5">
  <div class="container">
    <div class="row">
      <div class="col-md-6 text-md-start text-center">
        <a href="#"><img src="../assets/logo.png" style="width: 40px;"></a>
        <span class="ps-1">karya <a href="https://www.instagram.com/sukasuka/" class="fw-bold text-dark">sukasuka</a></span>
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

<!-- Script Keranjang -->
<script>
function tambahKeKeranjang(nama, harga, gambar) {
  let cart = JSON.parse(localStorage.getItem('cart')) || [];
  const itemBaru = { name: nama, price: harga, image: gambar, quantity: 1 };
  const itemIndex = cart.findIndex(item => item.name === nama);
  if (itemIndex !== -1) {
    cart[itemIndex].quantity += 1;
  } else {
    cart.push(itemBaru);
  }
  localStorage.setItem('cart', JSON.stringify(cart));
  alert('Produk berhasil ditambahkan ke keranjang!');
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
