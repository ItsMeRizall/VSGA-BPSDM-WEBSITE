<?php
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    require_once "koneksi.php";  // Include the DBHelper class

    $dbHelper = new DBHelper("localhost", "root", "", "123_syahmi");

    $data = $dbHelper->getData("news", "*", "", "news_update DESC");
    header('Content-Type: application/json');

    echo json_encode($data);

    $dbHelper->closeConnection();
}

?>
