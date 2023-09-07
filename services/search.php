<?php
include 'koneksi.php';
$dbHelper = new DBHelper("localhost", "root", "", "123_syahmi");

print($_POST["text"]);

if(isset($_POST["text"])){
    $data = $dbHelper->getData("news", "*", "news_title like '%". $_POST["text"]. "%'");
    print_r($data);
}

?>