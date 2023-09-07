<?php
include 'koneksi.php';

session_start();
if(empty($_SESSION["username"])){
    $_SESSION["error_message"] = "ANDA HARUS LOGIN TERLEBIH DAHULU";
    header("location: ../login.php");
}

$dbHelper = new DBHelper("localhost", "root", "", "123_syahmi");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $newsId = $_POST['id'];
    $updateData = array(
        "news_title" => $_POST['title'],
        "news_kategory" => $_POST['categories'],
        "news_content" => $_POST['content'],
    );

    if ($dbHelper->updateData("news", $updateData, "news_id = $newsId")) {
        // Handle successful update (e.g., redirect back to item list)
        header("Location: ../admin/admin.php");
        exit();
    } else {
        // Handle update failure
        echo "Update failed.";
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $newsId = $_GET['id'];
    $query = "SELECT * FROM news WHERE news_id = $newsId";
    $result = $dbHelper->getConnection()->query($query);

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc(); // Retrieve news data
    } else {
        // Handle not found
        echo "News item not found.";
        exit();
    }
} else {
    // Handle invalid request
    echo "Invalid request.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT DATA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../script/admin.js" defer></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>

<body>
    <section class="login">
        <div class="container grid place-items-center">
            <form action="edit_data.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $data['news_id']; ?>">
                <div class="mb-1">
                    <span class="text-sm">Title</span>
                    <input id="tittleName" value="<?php echo $data['news_title']; ?>" type="text" name='title' required
                        class="h-12 px-3 w-full border-blue-400 border-2 rounded focus:outline-none focus:border-blue-600">
                </div>

                <div class="mb-1">
                    <span class="text-sm">Categories</span>
                    <input type="text" value="<?php echo $data['news_kategory']; ?>" name="categories" required
                        class="h-12 px-3 w-full border-blue-400 border-2 rounded focus:outline-none focus:border-blue-600">
                </div>

                <div class="mb-1">
                    <span class="text-sm">Description</span>
                    <textarea type="text" name="content" required
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
                        </div> <input type="file" name="news_image" accept="image/*" class="h-full w-full opacity-0"
                            id="imageInput">
                    </div>
                </div>

                <div class="mt-3 text-right">
                    
                    <button type="submit"
                        class="ml-2 h-10 w-32 bg-blue-600 rounded text-white hover:bg-blue-700">Create</button>
                </div>
            </form>
        </div>
    </section>
</body>

</html>