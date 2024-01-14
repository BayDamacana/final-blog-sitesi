<?php
session_start();
include("header.php");
if (isset($_SESSION['postid'])) {
    $postid = $_SESSION['postid'];
    $query = "SELECT * FROM posts WHERE id ='$postid'";
    $result = mysqli_query($link,$query);
    $row = mysqli_fetch_assoc($result);
    $baslik = $row['heading'];
    $text = $row['text'];
} 
if (isset($_POST['update'])) {
    $baslikupdate = $_POST['heading'];
    $textupdate = $_POST['text'];

    $queryupdate = "UPDATE posts SET  heading =' $baslikupdate' , text='$textupdate' WHERE id='$postid'";
    $result = mysqli_query($link,$queryupdate);
    header("Location: index.php");
    exit();
}
?>


<div class="container">
<form method="post">
<h2>Başlık</h2><br>
<input type="text" class="heading" name="heading" value="<?php echo $baslik; ?>"><br>
</p>

<br>
<h2>İçerik</h2><br>
<textarea class="text" name="text" require><?php echo $text; ?></textarea><br>
<button type="submit" class="btn btn-warning" name="update" >Yayınla</button>
</form>
</div>