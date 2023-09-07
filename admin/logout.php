<?php 
session_abort();
session_unset();
session_destroy();

header("location: ../index.php");
?>