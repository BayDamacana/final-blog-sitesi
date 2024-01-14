<?php
session_start();

// Kullanıcı girişi kontrolü
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Veritabanı bağlantısı
$host = "localhost";
$kullanici = "root";
$parola = "";
$vt = "1g";

$baglanti = mysqli_connect($host, $kullanici, $parola, $vt);

if (!$baglanti) {
    die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Paneli</title>
</head>
<body>
    <h1>Hoş Geldiniz, <?php echo $_SESSION['admin']; ?></h1>
    <p>Bu admin paneli sadece giriş yapan yöneticilere görüntülenir.</p>

    <!-- İçeriği buraya ekleyebilirsiniz -->

    <br>
    <a href="logout.php">Çıkış Yap</a>
</body>
</html>