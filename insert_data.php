<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once './services/koneksi.php'; // Sertakan file koneksi ke database
    $dbHelper = new DBHelper("localhost", "admin", "", "123_syahmi");


    $title = $_POST["title"];
    $categories = $_POST['categories'];
    $description = $_POST['description'];
    $newsImage = $_FILES['news_image'];

    // Lakukan validasi data

    // Simpan gambar ke server dan dapatkan path-nya
    $imagePath = 'images/' . $newsImage['name'];
    move_uploaded_file($newsImage['tmp_name'], $imagePath);

    // Simpan nama gambar ke database
    $data = array(
        "news_title" => $title,
        "news_content" => $description,
        "news_kategory" => $categories,
        "images" => $newsImage['name'],
    );

    $insertResult = $dbHelper->insertData("news", $data);
    if ($insertResult) {
        header("Location: ./admin/admin.php");
        exit();
    } else {
        echo "<p>Tidak Berhasil</p>;";
    }
}
?>