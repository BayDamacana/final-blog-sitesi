<?php
session_start();
include("header.php");
// Veritabanı bağlantısı
$host = "localhost";
$kullanici = "root";
$parola = "";
$vt = "1g";

$baglanti = mysqli_connect($host, $kullanici, $parola, $vt);

if (!$baglanti) {
    die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
}

// Giriş formu gönderildi mi kontrol et
if (isset($_POST['login'])) {
    $kadi = $_POST['kadi'];
    $sifre = $_POST['sifre'];

    // Veritabanında admin bilgilerini kontrol et
    $sorgu = "INSERT INTO uyelik (kullanici_adi,parola) VALUE ('$kadi','$sifre') ";
    $sonuc = mysqli_query($baglanti, $sorgu);
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt ol</title>
</head>
<body>
    <h1 class="">Kayıt ol</h1>

    <?php if (isset($hata)) { ?>
        <p style="color: red;"><?php echo $hata; ?></p>
    <?php } ?>

    <form method="post" action="">
        <label for="admin_kadi">Kullanıcı Adı:</label>
        <input type="text" id="kadi" name="kadi" required><br>
        <label for="admin_sifre">Şifre:</label>
        <input type="password" id="sifre" name="sifre" required><br>

        <button type="submit" name="login">Kayıt ol</button>
    </form>
</body>
</html>
