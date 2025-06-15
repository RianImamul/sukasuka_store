<?php session_start(); ?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Checkout - SUKASUKA Store</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../fontawesome/css/all.min.css">
      <link rel="stylesheet" type="text/css" href="../css/checkout.css">

</head>
<body class="bg-light">

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
<div class="container mt-3">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb p-3 bg-white rounded shadow-sm">
      <li class="breadcrumb-item"><a href="homePage.php" class="text-decoration-none">Home</a></li>
      <li class="breadcrumb-item"><a href="produkhome.php" class="text-decoration-none">Produk</a></li>
      <li class="breadcrumb-item"><a href="keranjangProduk.php" class="text-decoration-none">Keranjang</a></li>
      <li class="breadcrumb-item active" aria-current="page">Checkout</li>
    </ol>
  </nav>
</div>

<!-- Checkout Content -->
<div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card shadow-sm">
        <div class="card-body">
          <h4 class="card-title text-center mb-4">Checkout</h4>

          <div id="checkout-items" class="mb-3"></div>
          <div id="checkout-total" class="fw-bold text-end mb-3"></div>

          <form id="checkout-form" method="POST" action="pembayaran.php" novalidate>
            <input type="hidden" name="cart_data" id="cart_data">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama Lengkap</label>
              <input type="text" class="form-control" id="nama" name="nama" required>
              <div class="invalid-feedback">Nama harus diisi.</div>
            </div>
            <div class="mb-3">
              <label for="alamat" class="form-label">Alamat Pengiriman</label>
              <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
              <div class="invalid-feedback">Alamat pengiriman harus diisi.</div>
            </div>
            <div class="mb-3">
              <label for="nohp" class="form-label">Nomor HP</label>
              <input type="tel" class="form-control" id="nohp" name="nohp" pattern="[0-9]+" required>
              <div class="invalid-feedback">Nomor HP harus diisi dan hanya boleh angka.</div>
            </div>
            <div class="text-end">
              <button type="submit" class="btn btn-primary">Lanjut ke Pembayaran</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

<!-- Footer -->
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


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
  const cart = JSON.parse(localStorage.getItem('cart')) || [];
  document.getElementById('cart_data').value = JSON.stringify(cart);
  const checkoutItems = document.getElementById('checkout-items');
  const checkoutTotal = document.getElementById('checkout-total');
  let total = 0;

  if (cart.length === 0) {
    checkoutItems.innerHTML = '<div class="alert alert-warning text-center">Keranjang kosong. Silakan tambahkan produk sebelum checkout.</div>';
    document.getElementById('checkout-form').style.display = 'none';
  } else {
    let list = '<ul class="list-group">';
    cart.forEach(item => {
      total += item.price * item.quantity;
      list += `<li class="list-group-item d-flex justify-content-between align-items-center">
                 ${item.name} (x${item.quantity})
                 <span>Rp ${item.price.toLocaleString()}</span>
               </li>`;
    });
    list += '</ul>';
    checkoutItems.innerHTML = list;
    checkoutTotal.innerText = 'Total: Rp ' + total.toLocaleString();
  }

  // Bootstrap validation
  (() => {
    const form = document.getElementById('checkout-form');
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  })();
</script>

</body>
</html>
