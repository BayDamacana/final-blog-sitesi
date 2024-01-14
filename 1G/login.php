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
    $sorgu = "SELECT * FROM uyelik WHERE kullanici_adi='$kadi' AND parola='$sifre' ";
    $sonuc = mysqli_query($baglanti, $sorgu);

    if ($sonuc) {
        $user = mysqli_fetch_assoc($sonuc);
        echo "Giriş başarılı";
        $_SESSION["user"]="user";

        } else {
            $hata = "Kullanıcı adı veya şifre hatalı";
        }
    } 

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş</title>
</head>
<body>
    <h1>Giriş</h1>

    <?php if (isset($hata)) { ?>
        <p style="color: red;"><?php echo $hata; ?></p>
    <?php } ?>

    <form method="post">
        <label for="admin_kadi">Kullanıcı Adı:</label>
        <input type="text" id="kadi" name="kadi" required><br>

        <label for="admin_sifre">Şifre:</label>
        <input type="password" id="sifre" name="sifre" required><br>

        <button type="submit" name="login">Giriş Yap</button>
    </form>
</body>
</html>
