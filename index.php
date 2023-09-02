<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BJG-Times</title>
    <link rel="stylesheet" href="/css/style.css">
    <script src="./script/index.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <nav class="flex items-center border-b-2 px-6 py-4 border-black-500 sticky top-0 bg-white overflow-hidden z-50">
        <a href="index.php"><img src="./images/bajinggo.png" alt="Logo" class="w-11"></a>
        <p class="judul">BJG-Times</p>
        <ul class="flex-1 text-center">
            <li class="inline-block px-5 list-none"><a href="categori/about.php"
                    class="no-underline text-black px-2">About</a></li>
            <li class="inline-block px-5 list-none"><a href="#" class="no-underline text-black px-2">News</a></li>
            <li class="inline-block px-5 list-none"><a href="categori/sport.php"
                    class="no-underline text-black px-2">Sport</a></li>
            <li class="inline-block px-5 list-none"><a href="categori/politic.php"
                    class="no-underline text-black px-2">Politic</a></li>
            <li class="inline-block px-5 list-none"><a href="categori/entertaiment.php"
                    class="no-underline text-black px-2">Entertaiment</a></li>
            <li class="inline-block px-5 list-none"><a href="categori/bussines.php"
                    class="no-underline text-black px-2">Bussines</a></li>

        </ul>
        <div
            class="w-24 h-10 border-solid border-2 text-black border-black rounded-3xl flex justify-center items-center hover:bg-blue-500 hover:text-white duration-100">
            <a href="./login.html">Login</a>
        </div>
    </nav>

    <div class="konten">
        <!-- Section: HOME -->
        <section id="news">
            <div class="container p-5 min-h-screen">
                <div class="gambar">
                </div>
                <div class="flex justify-between items-center ">
                    <h2 class="text-2xl font-semibold">News Update</h2>
                    <a href="#" class="text-blue-500 hover:underline mt-4">Lihat Semua</a>
                </div>
                <div id="cardNews" class="grid lg:grid-cols-3 sm:grid-cols-1 md:grid-cols-2 gap-4">
                    <?php
                    include 'services/koneksi.php';
                    $dbHelper = new DBHelper("localhost", "root", "", "123_syahmi");
                    $result = $dbHelper->getData("news", "*", "", "news_update DESC");
                    if (!empty($result)) {
                        $max;
                        if(count($result) > 6){
                            $max = 6;
                        }
                        else{
                            $max = count($result);
                        }
                        for ($i = 0; $i < $max; $i++) {
                            echo '<div class="w-full h-full mx-auto bg-white shadow-md rounded-md p-6 card hover:scale-105 ease-out duration-300 my-5">';
                            echo '<img class="mb-4 w-full h-64" src="images/' . $result[$i]["images"] .'" style="object-fit: cover;">';
                            echo '<h2 class="text-xl font-semibold mb-2">' .$result[$i]["news_title"] . '</h2>';
                            echo '<p class="text-gray-600 mb-4">' .substr($result[$i]["news_content"], 0, 200). "..." . '</p>';
                            echo '<p class="text-sm text-gray-500">' .$result[$i]["news_update"] . '</p>';
                            echo '<a href="news_details/details.php?id=' . $result[$i]['news_id'] . '" class="text-blue-500 hover:underline mt-2 inline-block cursor-pointer">Lihat Selengkapnya</a>';
                            echo '</div>';
                        }
                    }

                    ?>
                </div>
            </div>
        </section>

    </div>
    <footer>
        <div class="grid place-items-center border-t-2 h-30 mt-5">
            <div class="text-center">

                <p> </p>
                <p>BJG Junior Web Developer</p>
            </div>
        </div>
    </footer>
</body>

</html>