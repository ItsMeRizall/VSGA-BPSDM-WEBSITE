<?php
session_start();
include '../services/koneksi.php';

$dbHelper = new DBHelper("localhost", "root", "", "123_syahmi");

$result = $dbHelper->getData("news", "*", "", "news_update DESC");

if (empty($_SESSION["username"])) {
    $_SESSION["error_message"] = "ANDA HARUS LOGIN TERLEBIH DAHULU";
    header("location: ../login.php");
}

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

if (isset($_POST["search"])) {
    if (!empty($_POST["text"])) {
        $data_search = $dbHelper->getData("news", "*", "news_title like '%" . $_POST["text"] . "%'");
        $result = $data_search;
    } else {
        $result = $dbHelper->getData("news", "*", "", "news_update DESC");
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../script/admin.js" defer></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>

<body>
    <nav
        class="flex items-center border-b-2 px-10 py-4 border-black-500 sticky top-0 bg-white overflow-hidden  justify-between">
        <img src="../assets/logo/logo.png" alt="Logo" class="w-11">

        <div
            class="w-24 h-10 border-solid border-2 text-black border-black rounded-3xl flex justify-center items-center hover:bg-red-500 hover:text-white duration-100">
            <a href="logout.php">Logout</a>
        </div>
    </nav>

    <section id="Dashboard" class="p-10">
        <div class="container flex justify-between">
                <form class="flex items-center border-2 rounded-full p-2 w-2/5" action="admin.php" method="post">
                    <input type="text" name="text" class="border-none outline-none flex-grow" placeholder="Search...">
                    <button name="search" value="search"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-600 rounded-full p-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2"
                                d="M15 15l4-4m0 0l-4-4m4 4H5" />
                        </svg>
                    </button>
                </form>
            <div class="self-end">
                <button id="newItem"
                    class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-full flex items-center gap-1">
                    <span class="material-symbols-outlined w-5 h-5 mr-1 mb-1">
                        add
                    </span>
                    Add News
                </button>
            </div>
        </div>

        <h2 class="mt-8 font-medium text-xl">Dashboard</h2>


        <!-- LIST ITEM -->
        <?php

        if (!empty($result)) {
            foreach ($result as $data) {
                echo '<div class="container mx-auto mt-8">';
                echo '<ul class="grid grid-cols-1 gap-4">';
                // <!-- Item 1 -->
                echo '<li id="news-' . $data['news_id'] . '" class="bg-white p-4 rounded shadow-md flex items-center justify-between">';
                echo '<div class="flex items-center">';
                echo '<img src="../images/' . $data['images'] . '" alt="Image" class="w-16 h-16 rounded-full mr-4">';
                echo '<div>';
                echo '<h2 class="text-lg font-semibold">' . $data['news_title'] . '</h2>';
                echo '<p class="text-gray-600">' . $data['news_content'] . '</p>';
                echo '</div>';
                echo '</div>';
                echo ' <div class="text-sm">';
                echo '<a href="../services/edit_data.php?id=' . $data['news_id'] . '" class="font-semibold mx-5 text-indigo-600 hover:text-indigo-500">Edit</a>';
                echo '<a href="../services/delete_data.php?id=' . $data['news_id'] . '" class="font-semibold mx-5 text-indigo-600 hover:text-indigo-500">Delete</a>';
                echo '</div>';
                echo '</li>';
                echo '</ul>';
                echo '</div>';
            }
        } else {
            echo '<tr><td colspan="4" class="text-center">Tidak ada kegiatan.</td></tr>';
        }
        ?>


    </section>

    <div class="fixed flex inset-0 items-center justify-center bg-black bg-opacity-50 hidden" id="addPopup">
        <!-- <div class="relative flex"><p class="absolute top-0 right-0 p-5 black rounded-bl-lg text-lg">X</p></div> -->
        <div class="w-4/6 h-auto bg-white rounded-lg overflow-hidden md:max-w-lg">
            <div class="">
                <div class="w-full px-4 py-6 ">

                    <form action="../insert_data.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-1">
                            <span class="text-sm">Title</span>
                            <input id="tittleName" value="" type="text" name='title' required
                                class="h-12 px-3 w-full border-blue-400 border-2 rounded focus:outline-none focus:border-blue-600">
                        </div>

                        <div class="mb-1">
                            <span class="text-sm">Categories</span>
                            <label for="categories" class="text-sm">Categories</label>
                            <select required name="categories" id="categories"
                                class="h-12 px-3 w-full border-blue-400 border-2 rounded focus:outline-none focus:border-blue-600">
                                <option value="sport">Sport</option>
                                <option value="politics">Politics</option>
                                <option value="entertainment">Entertainment</option>
                                <option value="business">Business</option>
                            </select>
                        </div>

                        <div class="mb-1">
                            <span class="text-sm">Description</span>
                            <textarea type="text" name="description" required
                                class="h-24 py-1 px-3 w-full border-2 border-blue-400 rounded focus:outline-none focus:border-blue-600 resize-none"></textarea>
                        </div>

                        <div class="mb-1">
                            <span>Attachments</span>
                            <div
                                class="relative border-dotted h-32 rounded-lg border-2 border-blue-700 bg-gray-100 flex justify-center items-center">
                                <div class="absolute">
                                    <div class="flex flex-col items-center"> <i
                                            class="fa fa-folder-open fa-3x text-blue-700"></i> <span id="foto_nama"
                                            class="block text-gray-400 font-normal">Attach your files here</span> </div>
                                </div> <input type="file" name="news_image" accept="image/*"
                                    class="h-full w-full opacity-0" id="imageInput">
                            </div>
                        </div>

                        <div class="mt-3 text-right">
                            <button id="cancel-btn" style="border: 1px solid red; box-sizing: border-box;" class="ml-2 h-10 w-32 rounded text-black hover:border-black-700" type="button">Cancel</button>
                            <button type="submit"
                                class="ml-2 h-10 w-32 bg-blue-600 rounded text-white hover:bg-blue-700">Add Item</button>
                        </div>
                    </form>




                </div>
            </div>
        </div>
    </div>

</body>

</html>