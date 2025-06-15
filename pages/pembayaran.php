<?php
include __DIR__ . '/../koneksi.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama   = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $nohp   = $_POST['nohp'];
  $metode = $_POST['metode'] ?? null;
  $cart   = json_decode($_POST['cart_data'], true);

  if (!$cart || count($cart) === 0) {
    echo "<script>alert('Keranjang kosong'); window.location.href='keranjangProduk.php';</script>";
    exit;
  }

  if ($metode) {
    // Proses upload bukti pembayaran
    $bukti_path = null;
    if (isset($_FILES['bukti']) && $_FILES['bukti']['error'] === UPLOAD_ERR_OK) {
      $uploadDir = __DIR__ . '/../uploads/';
      if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
      }

      $fileTmpPath = $_FILES['bukti']['tmp_name'];
      $fileName = basename($_FILES['bukti']['name']);
      $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
      $newFileName = uniqid('bukti_') . '.' . $fileExtension;
      $bukti_path = 'uploads/' . $newFileName;
      move_uploaded_file($fileTmpPath, $uploadDir . $newFileName);
    }

    $stmtUser = $conn->prepare("INSERT INTO users (nama, alamat, no_hp) VALUES (?, ?, ?)");
    if (!$stmtUser) die("Prepare users failed: " . $conn->error);
    $stmtUser->bind_param("sss", $nama, $alamat, $nohp);
    $stmtUser->execute();
    $user_id = $stmtUser->insert_id;

    $tanggal = date('Y-m-d H:i:s');
    $stmtPesanan = $conn->prepare("INSERT INTO pesanan (user_id, tanggal_pesan, metode_pembayaran, bukti_pembayaran) VALUES (?, ?, ?, ?)");
    if (!$stmtPesanan) die("Prepare pesanan failed: " . $conn->error);
    $stmtPesanan->bind_param("isss", $user_id, $tanggal, $metode, $bukti_path);
    $stmtPesanan->execute();
    $pesanan_id = $stmtPesanan->insert_id;

    $stmtDetail = $conn->prepare("INSERT INTO detail_pesanan (pesanan_id, produk_id, jumlah) VALUES (?, ?, ?)");
    if (!$stmtDetail) die("Prepare detail_pesanan failed: " . $conn->error);

    foreach ($cart as $item) {
      $stmtProduk = $conn->prepare("SELECT id FROM produk_sepatu WHERE nama_produk = ? LIMIT 1");
      $stmtProduk->bind_param("s", $item['name']);
      $stmtProduk->execute();
      $result = $stmtProduk->get_result();
      if ($row = $result->fetch_assoc()) {
        $produk_id = $row['id'];
        $jumlah = $item['quantity'];
        $stmtDetail->bind_param("iii", $pesanan_id, $produk_id, $jumlah);
        $stmtDetail->execute();
      }
    }

    echo "<script>
      alert('Pembayaran berhasil dikonfirmasi! Terima kasih sudah berbelanja.');
      localStorage.removeItem('cart');
      window.location.href = 'homePage.php';
    </script>";
    exit;
  } else {
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pembayaran - Sukasuka Store</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../css/styleHome.css">
  <link rel="stylesheet" type="text/css" href="../fontawesome/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="../css/checkout.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#"><img src="../assets/logo.png" width="30" height="24" class="me-2"> SUKASUKA <strong>Store</strong></a>
  </div>
</nav>

<div class="container mt-3">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb p-3 bg-white rounded shadow-sm">
      <li class="breadcrumb-item"><a href="homePage.php" class="text-decoration-none">Home</a></li>
      <li class="breadcrumb-item"><a href="produkhome.php" class="text-decoration-none">Produk</a></li>
      <li class="breadcrumb-item"><a href="keranjangProduk.php" class="text-decoration-none">Keranjang</a></li>
      <li class="breadcrumb-item"><a href="Checkout.php" class="text-decoration-none">Checkout</a></li>
      <li class="breadcrumb-item active" aria-current="page">Pembayaran</li>
    </ol>
  </nav>
</div>

<div class="container mt-5">
  <h2 class="text-center mb-4"> Pembayaran</h2>
  <form method="POST" action="pembayaran.php" enctype="multipart/form-data">
    <input type="hidden" name="nama" value="<?= htmlspecialchars($nama) ?>">
    <input type="hidden" name="alamat" value="<?= htmlspecialchars($alamat) ?>">
    <input type="hidden" name="nohp" value="<?= htmlspecialchars($nohp) ?>">
    <input type="hidden" name="cart_data" value='<?= htmlspecialchars(json_encode($cart)) ?>'>

    <div class="mb-3">
      <label for="metode" class="form-label">Metode Pembayaran</label>
      <select class="form-select" id="metode" name="metode" required>
        <option value="">Pilih Metode</option>
        <option value="transfer">Transfer Bank</option>
        <option value="cod">Bayar di Tempat (COD)</option>
        <option value="qris">QRIS</option>
      </select>
    </div>

    <div class="mb-3" id="rekening-info" style="display:none;">
      <p><strong>Transfer ke:</strong><br>BCA 123456789 a.n. Sukasuka Store</p>
    </div>

    <div class="mb-3" id="qris-info" style="display:none;">
      <p>Scan kode QR di bawah ini untuk membayar:</p>
      <img src="../assets/pembayaran/qris.jpg" alt="QRIS" style="width:200px;">
    </div>

    <div class="mb-3" id="bukti-info" style="display:none;">
      <label for="bukti" class="form-label">Upload Bukti Pembayaran</label>
      <input type="file" class="form-control" id="bukti" name="bukti" accept="image/*">
    </div>

    <button type="submit" class="btn btn-success">Konfirmasi Pembayaran</button>
  </form>
</div>

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

<script>
  const metode = document.getElementById('metode');
  const rekeningInfo = document.getElementById('rekening-info');
  const qrisInfo = document.getElementById('qris-info');
  const buktiInfo = document.getElementById('bukti-info');

  metode.addEventListener('change', function () {
    rekeningInfo.style.display = metode.value === 'transfer' ? 'block' : 'none';
    qrisInfo.style.display = metode.value === 'qris' ? 'block' : 'none';
    buktiInfo.style.display = (metode.value === 'transfer' || metode.value === 'qris') ? 'block' : 'none';
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
    exit;
  }
} else {
  header("Location: checkout.php");
  exit;
}
?>
