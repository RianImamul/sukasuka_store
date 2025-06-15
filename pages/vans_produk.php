<?php include __DIR__ . '/../koneksi.php'; ?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Produk Vans</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../css/seconditem.css">
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
        <li class="nav-item"><a class="nav-link active" href="keranjangProduk.php">KERANJANG</a></li>
        <li class="nav-item"><a class="nav-link active" href="singleProduk.php">NEW ITEM</a></li>
        <li class="nav-item"><a class="nav-link active" href="#">SECOND ITEM</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Breadcrumb -->
<div class="container">
  <nav aria-label="breadcrumb" class="mt-3 bg-white p-3">
    <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><a href="homePage.php" class="text-decoration-none">HOME</a></li>
      <li class="breadcrumb-item"><a href="singleKategori.php" class="text-decoration-none">KATEGORI</a></li>
      <li class="breadcrumb-item"><a href="produkhome.php" class="text-decoration-none">PRODUK</a></li>
    </ol>
  </nav>
</div>

<!-- Produk Vans dari Database -->
<div class="container mt-5">
  <div class="bg-white p-2 text-center">
    <h5 class="fw-bold">VANS</h5>
  </div>
  <div class="row g-3 mt-3">
    <?php
    $query = $conn->query("SELECT * FROM produk_sepatu WHERE merek = 'Vans'");
    while ($row = $query->fetch_assoc()):
    ?>
      <div class="col-lg-2 col-md-3 col-sm-4 col-6">
        <div class="card h-100 text-center">
          <img src="../assets/vans/<?= $row['gambar'] ?>" class="card-img-top" style="height: 180px; object-fit: cover;" alt="<?= $row['nama_produk'] ?>">
          <div class="card-body d-flex flex-column">
            <h6 class="card-title"><?= $row['nama_produk'] ?></h6>
            <p class="mb-1 text-muted"><?= $row['ukuran'] ?> | <?= $row['warna'] ?></p>
            <p class="card-text">Rp. <?= number_format($row['harga'], 0, ',', '.') ?></p>
            <button class="btn btn-primary mt-auto" onclick="tambahKeKeranjang('<?= $row['nama_produk'] ?>', <?= $row['harga'] ?>, '../assets/vans/<?= $row['gambar'] ?>')">Beli</button>
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

<!-- Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
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
</body>
</html>
