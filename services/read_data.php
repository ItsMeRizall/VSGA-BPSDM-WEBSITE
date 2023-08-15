<?php
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    require_once "koneksi.php";  // Include the DBHelper class

    $dbHelper = new DBHelper("localhost", "root", "", "114_moch_syaiful_rizal");

    $data = $dbHelper->getData("news", "news_id, news_title, news_content, news_kategory, news_update", "");  // Modify as needed

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
