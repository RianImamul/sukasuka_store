<?php include __DIR__ . '/../koneksi.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sukasuka Store</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../css/index.css">
  <link rel="stylesheet" type="text/css" href="../fontawesome/css/all.min.css">

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
        <li class="nav-item"><a class="nav-link active" href="#">KERANJANG</a></li>
        <li class="nav-item"><a class="nav-link active" href="#">NEW ITEM</a></li>
        <li class="nav-item"><a class="nav-link active" href="#">SECOND ITEM</a></li>
      </ul>
    </div>
  </div>
</nav>

<main>
<!-- Carousel -->
<div class="container mt-4">
  <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="../assets/img1.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="../assets/img2.jpg" class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>
</div>

<!-- Produk -->
<div class="container mt-5">
  <h5 class="text-center fw-bold mb-4">PRODUK</h5>
  <div class="row justify-content-center">
    <!-- Produk 1 -->
    <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3">
      <div class="card text-center">
        <img src="../assets/produk/nikeairforce.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <h6>NIKE AIRFORCE 1 WHITE BLACK</h6>
          <p>Rp. 1.000.000</p>
          <button class="btn btn-primary d-grid" onclick="tambahKeKeranjang('NIKE AIRFORCE 1 WHITE BLACK', 1000000, '../assets/produk/nikeairforce.jpg')">Beli</button>
        </div>
      </div>
    </div>
    <!-- Produk 2 -->
    <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3">
      <div class="card text-center">
        <img src="../assets/produk/gambarvans.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <h6>VANS OLD SKOOL BLACK WHITE</h6>
          <p>Rp. 1.200.000</p>
          <button class="btn btn-primary d-grid" onclick="tambahKeKeranjang('VANS OLD SKOOL BLACK WHITE', 1200000, '../assets/produk/gambarvans.jpg')">Beli</button>
        </div>
      </div>
    </div>
    <!-- Produk 3 -->
    <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3">
      <div class="card text-center">
        <img src="../assets/produk/airmax.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <h6>NIKE AIRMAX 97 TRIPLE WHITE</h6>
          <p>Rp. 1.000.000</p>
          <button class="btn btn-primary d-grid" onclick="tambahKeKeranjang('NIKE AIRMAX 97 TRIPLE WHITE', 1000000, '../assets/produk/airmax.jpg')">Beli</button>
        </div>
      </div>
    </div>
  </div>
</div>
</main>

<!-- Footer -->
<footer class="bg-light p-4 mt-auto">
  <div class="container">
    <div class="row">
      <div class="col-md-6 text-md-start text-center">
        <a href="#"><img src="../assets/logo.png" style="width: 40px;"></a>
        <span class="ps-1">karya <a href="https://www.instagram.com/sukasuka/" class="fw-bold text-dark">sukasuka</a></span>
      </div>
      <div class="col-md-6 text-md-end text-center">
        <a href="#"><img src="../assets/sosialmedia/fb.png" class="ms-2" style="width: 30px;"></a>
        <a href="#"><img src="../assets/sosialmedia/instagram.png" class="ms-2" style="width: 30px;"></a>
        <a href="#"><img src="../assets/sosialmedia/linee.png" class="ms-2" style="width: 40px;"></a>
        <a href="#"><img src="../assets/sosialmedia/twitter.png" class="ms-2" style="width: 25px;"></a>
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
