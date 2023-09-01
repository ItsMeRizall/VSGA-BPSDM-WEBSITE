<?php
// delete_data.php

include 'koneksi.php';

$dbHelper = new DBHelper("localhost", "root", "", "123_syahmi");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $idToDelete = $_GET['id'];
    $data = $dbHelper->getData("news", "images", "news_id = $idToDelete");
    
    if ($dbHelper->deleteData("news", "news_id = $idToDelete")) {
        if(file_exists("../images/". $data[0]["images"])){
            unlink("../images/". $data[0]["images"]);
            echo "sukses hapus image";
        }else{
            echo "datanya ga ada";
        }
        header("Location: ../admin/admin.php");
        exit();
    } else {
        echo "gagal menghapus";
    }
}

?>
