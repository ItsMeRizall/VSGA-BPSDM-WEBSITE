<?php
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    require_once "koneksi.php";  // Include the DBHelper class

    $dbHelper = new DBHelper("localhost", "root", "", "123_syahmi");

    $data = $dbHelper->getData("news", "*", "", "news_update DESC");  // Modify as needed

    header('Content-Type: application/json');
    // $data = array_map('utf8_encode', $data);
    echo json_encode($data);

    // if ($data_json !== false) {
    //     echo "JSON encoding successful.";
    // } else {
    //     echo "JSON encoding failed with error code: " . json_last_error();
    // }

    $dbHelper->closeConnection();
}

?>
