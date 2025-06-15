<?php include __DIR__ . '/../koneksi.php'; ?>

<?php
// Ambil produk yang sudah ditambahkan lebih dari 30 detik
$query = $conn->query("SELECT * FROM produk_sepatu WHERE TIMESTAMPDIFF(SECOND, tanggal_ditambahkan, NOW()) >= 30 ORDER BY id DESC");
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Second Item - SUKASUKA Store</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../css/seconditem.css">
  <link rel="stylesheet" type="text/css" href="../fontawesome/css/all.min.css">
</head>
<body class="d-flex flex-column min-vh-100">

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
    <nav aria-label="breadcrumb" class="mt-3 bg-white p-3">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="homePage.php" class="text-decoration-none">HOME</a></li>
        <li class="breadcrumb-item"><a href="singleKategori.php" class="text-decoration-none">KATEGORI</a></li>
        <li class="breadcrumb-item active" aria-current="page">SECOND ITEM</li>
      </ol>
    </nav>
  </div>

  <!-- Produk dari Database -->
  <div class="container mt-4 flex-grow-1">
    <div class="judul-produk bg-white py-2 px-3 mb-4">
      <h5 class="text-center fw-bold">SECOND ITEM</h5>
    </div>
    <div class="row">
      <?php if ($query->num_rows > 0): ?>
        <?php while ($row = $query->fetch_assoc()): ?>
          <?php
            $folder = strtolower($row['merek']);
            $gambarPath = "../assets/$folder/" . $row['gambar'];
          ?>
          <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-4">
            <div class="card text-center h-100">
              <img src="<?= $gambarPath ?>" class="card-img-top" alt="<?= $row['nama_produk'] ?>" style="height: 180px; object-fit: cover;">
              <div class="card-body d-flex flex-column">
                <h6 class="card-title"><?= $row['nama_produk'] ?></h6>
                <p class="mb-1 text-muted"><?= $row['merek'] ?></p>
                <p class="mb-1"><strong>Color</strong>: <?= $row['warna'] ?></p>
                <p class="card-text">Rp. <?= number_format($row['harga'], 0, ',', '.') ?></p>
                <button class="btn btn-primary mt-auto" onclick="tambahKeKeranjang('<?= $row['nama_produk'] ?>', <?= $row['harga'] ?>, '<?= $gambarPath ?>')">Beli</button>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p class="text-center">Belum ada produk second item saat ini.</p>
      <?php endif; ?>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-light p-5 mt-auto">
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
