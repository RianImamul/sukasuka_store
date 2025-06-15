<?php
require __DIR__ . '/../koneksi.php';

// Tangkap data dari form
$nama   = $_POST['nama'];
$alamat = $_POST['alamat'];
$nohp   = $_POST['nohp'];
$cart   = json_decode($_POST['cart_data'], true);

if (!$cart || count($cart) === 0) {
    die("Keranjang kosong.");
}

// 1. Masukkan ke tabel `users` (optional, atau pakai user tetap)
$stmtUser = $conn->prepare("INSERT INTO users (nama, alamat, no_hp) VALUES (?, ?, ?)");
$stmtUser->bind_param("sss", $nama, $alamat, $nohp);
$stmtUser->execute();
$user_id = $stmtUser->insert_id;

// 2. Masukkan ke tabel `pesanan`
$tanggal = date('Y-m-d H:i:s');
$stmtPesanan = $conn->prepare("INSERT INTO pesanan (user_id, tanggal_pesan) VALUES (?, ?)");
$stmtPesanan->bind_param("is", $user_id, $tanggal);
$stmtPesanan->execute();
$pesanan_id = $stmtPesanan->insert_id;

// 3. Masukkan ke `detail_pesanan`
$stmtDetail = $conn->prepare("INSERT INTO detail_pesanan (pesanan_id, produk_id, jumlah) VALUES (?, ?, ?)");

foreach ($cart as $item) {
    // Ambil ID produk berdasarkan nama (pastikan nama unik)
    $stmtProduk = $conn->prepare("SELECT id FROM produk_sepatu WHERE nama_produk = ? LIMIT 1");
    $stmtProduk->bind_param("s", $item['name']);
    $stmtProduk->execute();
    $result = $stmtProduk->get_result();
    $produk = $result->fetch_assoc();
    if ($produk) {
        $stmtDetail->bind_param("iii", $pesanan_id, $produk['id'], $item['quantity']);
        $stmtDetail->execute();
    }
}

// 4. Bersihkan keranjang
echo "<script>
  alert('Pesanan berhasil dikirim!');
  localStorage.removeItem('cart');
  window.location.href = 'homePage.php';
</script>";
?>
