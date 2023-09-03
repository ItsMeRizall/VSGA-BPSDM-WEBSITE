<?php 
include '../services/koneksi.php';

$dbHelper = new DBHelper("localhost", "root", "", "123_syahmi");

if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $newsId = $_GET['id'];
    $result = $dbHelper->getData("news", "*", "news_id = $newsId");
    
    if (count($result)>0) {
        $data = $result;
        $newsKategory = $result[0]["news_kategory"];
    } else {
        echo "News item not found.";
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <link rel="stylesheet" href="../css/details.css">
    <script src="./script/index.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <nav class="flex items-center border-b-2 px-6 py-4 border-black-500 sticky top-0 bg-white overflow-hidden z-50">
        <a href="../index.html"><img src="../images/bajinggo.png" alt="Logo" class="w-11"></a>
        <p class="judul"> BJG-Times</p>
        <ul class="flex-1 text-center">
            <li class="inline-block px-5 list-none"><a href="../categori/about.php"
                    class="no-underline text-black px-2">About</a></li>
            <li class="inline-block px-5 list-none"><a href="../index.php" class="no-underline text-black px-2">News</a>
            </li>
            <li class="inline-block px-5 list-none"><a href="../categori/sport.php"
                    class="no-underline text-black px-2">Sport</a></li>
            <li class="inline-block px-5 list-none"><a href="../categori/politic.php"
                    class="no-underline text-black px-2">Politic</a></li>
            <li class="inline-block px-5 list-none"><a href="../categori/entertaiment.php"
                    class="no-underline text-black px-2">Entertaiment</a></li>
            <li class="inline-block px-5 list-none"><a href="../categori/bussines.php"
                    class="no-underline text-black px-2">Bussines</a></li>

        </ul>
        <div
            class="w-24 h-10 border-solid border-2 text-black border-black rounded-3xl flex justify-center items-center hover:bg-blue-500 hover:text-white duration-100">
            <a href="../login.php">Login</a>
        </div>
    </nav>

    <div class="flex">
        <div class="w-4/6 overflow-y-scroll p-12">
            <div class="wrap-content">
                <h2 class="capitalize text-center text-3xl font-bold px-6"><?php echo $data[0]["news_title"] ?></h2>
                <div class="px-10 ">
                <img class="rounded-3xl w-full object-contain object-center h-80 mt-8"
                    src="../images/<?php echo $data[0]["images"] ?>" alt="gambar">
                </div>
                <p class="mt-8 text-xl text-justify indent-20 leading-9"><?php echo $data[0]["news_content"] ?></p>
            </div>
        </div>

        <div class="w-2/6 overflow-y-scroll h-screen right-side py-12 px-4">
            <h3 class="text-xl font-semibold">Related Items</h3>
            <div class="grid grid-cols-2 gap-4 mt-3">
                <?php

                $related = $dbHelper->getData("news", "*", "news_kategory = '$newsKategory' and news_id <> $newsId", "news_update DESC");

                for($i=0; $i <count($related); $i++){
                    echo '<div
            class="w-full mx-auto bg-white shadow-md rounded-md p-6 card hover:scale-105 ease-out duration-300">
            ';
                echo '<img class="mb-1 w-full h-32 object-contain" src="../images/' . $related[$i]["images"] .'">';
                echo '<h2 class="text-lg font-semibold mb-2">' . $related[$i]["news_title"] .'</h2>';
                echo '<p class="text-sm text-gray-600 mb-4">' . substr($related[$i]["images"], 0 , 120) .'</p>';
                echo '<p class="text-xs text-gray-500">' . $related[$i]["news_update"] .'</p>';
                echo '<a href="../news_details/details.php?id=' . $related[$i]['news_id'] . '" class="text-blue-500 hover:underline mt-2 inline-block cursor-pointer">Lihat Selengkapnya</a>';
                echo '</div>';
                }
                
    
                ?>
    
            </div>
        </div>
    </div>


</body>

</html>