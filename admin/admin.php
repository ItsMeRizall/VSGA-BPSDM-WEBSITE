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
            <a href="../index.html">Logout</a>
        </div>
    </nav>

    <section id="Dashboard" class="p-10">
        <div class="container  flex justify-between">
            <div class="flex items-center border-2 rounded-full p-2 w-2/5">
                <input type="text" class="border-none outline-none flex-grow" placeholder="Search...">
                <button class="bg-gray-300 hover:bg-gray-400 text-gray-600 rounded-full p-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2"
                            d="M15 15l4-4m0 0l-4-4m4 4H5" />
                    </svg>
                </button>
            </div>
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
        include '../services/koneksi.php';

        $dbHelper = new DBHelper("localhost", "root", "", "123_syahmi");

        $query = "SELECT * FROM news ORDER BY news_update DESC";
        $result = $dbHelper->getConnection()->query($query);

        if ($result->num_rows > 0) {
            while ($data = $result->fetch_assoc()) {
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
                // Inside the loop
                echo '<a href="../services/edit_data.php?id=' . $data['news_id'] . '" class="font-semibold mx-5 text-indigo-600 hover:text-indigo-500">Edit</a>';

                echo '<a href="javascript:void(0);" onclick="deleteNews(' . $data['news_id'] . ')" class="font-semibold mx-5 text-indigo-600 hover:text-indigo-500">Delete</a>';
                echo '</div>';
                echo '</li>';
                // <!-- Add more items here -->
                echo '</ul>';
                echo '</div>';
            }
        } else {
            echo 'echo <tr><td colspan="4" class="text-center">Tidak ada kegiatan.</td></tr>';
        }
        ?>


    </section>

    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden" id="addPopup">
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
                            <input type="text" name="categories" required
                                class="h-12 px-3 w-full border-blue-400 border-2 rounded focus:outline-none focus:border-blue-600">
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
                            <button type="submit"
                                class="ml-2 h-10 w-32 bg-blue-600 rounded text-white hover:bg-blue-700">Create</button>
                        </div>
                    </form>




                </div>
            </div>
        </div>
    </div>

    <!-- admin.php -->
<!-- ... your previous code ... -->

<script>
function deleteNews(id) {
    if (confirm('Are you sure you want to delete this item?')) {
        fetch(`../services/delete_data.php?id=${id}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update UI if delete is successful
                    const listItem = document.getElementById(`news-${id}`);
                    listItem.remove();
                } else {
                    alert('Failed to delete.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
}
</script>


</body>

</html>