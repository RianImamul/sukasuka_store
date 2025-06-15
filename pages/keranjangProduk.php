<?php include __DIR__ . '/../koneksi.php'; ?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Keranjang Belanja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/keranjangProduk.css">
      <link rel="stylesheet" type="text/css" href="../css/checkout.css">

  </head>
  <body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="homePage.php">
          <img src="../assets/logo.png" alt="" width="30" height="24" class="me-2">
          <span>SUKASUKA <strong>Store</strong></span>
        </a>
        <div class="collapse navbar-collapse justify-content-end">
          <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="keranjangProduk.php">KERANJANG</a></li>
            <li class="nav-item"><a class="nav-link" href="singleProduk.php">NEW ITEM</a></li>
            <li class="nav-item"><a class="nav-link" href="seconditem.php">SECOND ITEM</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Breadcrumb -->
    <div class="breadcrumb-container mt-3">
      <div class="container">
        <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="homePage.php">HOME</a></li>
            <li class="breadcrumb-item"><a href="singleKategori.php">KATEGORI</a></li>
            <li class="breadcrumb-item"><a href="produkhome.php">PRODUK</a></li>
          </ol>
        </nav>
      </div>
    </div>

    <!-- Konten Keranjang -->
    <main>
      <div class="container mt-5">
        <h2 class="mb-4 text-center fw-bold">Keranjang Belanja</h2>
        <div id="cart-items" class="row"></div>
        <div id="total" class="mt-4 fw-bold fs-5 text-end"></div>
        <div class="text-end mt-3">
          <a href="checkout.php" class="btn btn-success">Checkout</a>
        </div>
      </div>
    </main>

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
    <script>
      let cart = JSON.parse(localStorage.getItem('cart')) || [];
      const container = document.getElementById('cart-items');
      const totalDisplay = document.getElementById('total');
    
      function updateCartDisplay() {
        container.innerHTML = '';
        let total = 0;
    
        if (cart.length === 0) {
          container.innerHTML = '<p class="text-center">Keranjang Anda kosong.</p>';
          totalDisplay.innerText = '';
          return;
        }
    
        cart.forEach((item, index) => {
          total += item.price * item.quantity;
    
          const itemHTML = `
            <div class="col-md-4 mb-4">
              <div class="card h-100">
                <img src="${item.image}" class="card-img-top" alt="${item.name}">
                <div class="card-body">
                  <h5 class="card-title">${item.name}</h5>
                  <p class="card-text">Harga: Rp ${item.price.toLocaleString()}</p>
                  <p class="card-text">Jumlah: ${item.quantity}</p>
                  <p class="card-text fw-bold">Subtotal: Rp ${(item.price * item.quantity).toLocaleString()}</p>
                  <button class="btn btn-danger btn-sm" onclick="removeItem(${index})">Hapus</button>
                </div>
              </div>
            </div>
          `;
          container.innerHTML += itemHTML;
        });
    
        totalDisplay.innerText = 'Total: Rp ' + total.toLocaleString();
      }
    
      function removeItem(index) {
        cart.splice(index, 1);
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartDisplay();
      }
    
      updateCartDisplay();
    </script>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
