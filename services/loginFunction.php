<?php
include 'koneksi.php'; // Pastikan Anda mengimpor file DBHelper.php

$host = "localhost";
$username = "root";
$password = ""; 
$database = "123_syahmi"; 

$dbHelper = new DBHelper($host, $username, $password, $database);



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $where = "username = '$username'";
    $userData = $dbHelper->getData("users", "*", $where);

    if (!empty($userData)) {
        $user = $userData[0];
        $hashedPassword = $user["password"];

        if (password_verify($password, $hashedPassword)) {
            session_start();
            $_SESSION["username"] = $username;
            header("Location: ../admin/admin.php"); 
        } else {
            session_start();
            $_SESSION["error_message"] = "PASSWORD SALAH";
            header("location: ../login.php");
        }
    } else {
        session_start();
        $_SESSION["error_message"] = "USERNAME ANDA TIDAK DI TEMUKAN";
        header("location: ../login.php");
    }
}


?>
