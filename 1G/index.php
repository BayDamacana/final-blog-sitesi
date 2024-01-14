<?php
session_start();
$role =@$_SESSION["user"];
echo $role;
include("header.php");

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<?php

if (isset($_POST["edit"])) {
    $postid = $_POST["postid"];
    $_SESSION['postid'] = $postid;
    header("Location: duzenle.php");
    exit();
}

if (isset($_POST["delete"])) {
    $postid = $_POST["postid"];
    $sql = "DELETE FROM posts WHERE id='$postid'";
    $result = mysqli_query($link, $sql);
}

if (isset($_POST["arama"])) {
    $baslik = $_POST["aramatext"];
    $sql = "SELECT * FROM posts WHERE heading LIKE '%$baslik%'";
    $result = mysqli_query($link, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '
            <div class="container">';

            if ($role == "admin") {
                echo '
                <form action="" method="post">
                <button type="submit" name="delete"><i class="fa-solid fa-xmark"></i></button>
                <input type="hidden" name="postid" value="' . $row["id"] . '">
                </form>

                <form action="" method="post">
                <button class="edit" type="submit" name="edit"><i class="fa-regular fa-pen-to-square"></i></button>
                <input type="hidden" name="postid" value="' . $row["id"] . '">
                </form>';
            }

            echo '
            <h2 style="text-align:center;">' . $row["heading"] . '</h2>
            <p>' . $row["text"] . '</p>
            </div>';
        }
    } else {
        echo "Error executing the search query.";
    }
} else {
    $sql = "SELECT * FROM posts ORDER BY id DESC";
    $result = mysqli_query($link, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '
            <div class="container">';

            if ($role == "admin") {
                echo '
                <form action="" method="post">
                <button type="submit" name="delete"><i class="fa-solid fa-xmark"></i></button>
                <input type="hidden" name="postid" value="' . $row["id"] . '">
                </form>

                <form action="" method="post">
                <button class="edit" type="submit" name="edit"><i class="fa-regular fa-pen-to-square"></i></button>
                <input type="hidden" name="postid" value="' . $row["id"] . '">
                </form>';
            }

            echo '
            <h2 style="text-align:center;">' . $row["heading"] . '</h2>
            <p>' . $row["text"] . '</p>
            </div>';
        }
    } else {
        echo "Error fetching posts.";
    }
}

?>

</body>

</html>
