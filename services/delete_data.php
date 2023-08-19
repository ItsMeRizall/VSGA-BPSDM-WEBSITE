<?php
// delete_data.php

include 'koneksi.php';

$dbHelper = new DBHelper("localhost", "root", "", "123_syahmi");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $idToDelete = $_GET['id'];

    if ($dbHelper->deleteData("news", "news_id = $idToDelete")) {
        $response = ['success' => true];
    } else {
        $response = ['success' => false];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

?>
