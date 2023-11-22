<?php
include('connection.php');

// Fetch the rows from the 'product' table
$sql = "SELECT * FROM annonce";
$result = mysqli_query($conn, $sql);

// Handle form submission for updating products
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $product_id = $_POST['product_id'];
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];

    // Update the product details
    $update_sql = "UPDATE annonce SET titre=?, description=?, prix=? WHERE id=?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param('sssi', $product_title, $product_description, $product_price, $product_id);

    if ($stmt->execute()) {
        echo "<script>alert('Product updated successfully');</script>";
    } else {
        echo "<script>alert('Failed to update product: " . $stmt->error . "');</script>";
    }
    header("Location: ". $_SERVER['PHP_SELF']);
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Edit Products</title>
</head>

<body>
<div class="min-h-full">
        <nav class="bg-gray-800">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <a href="index.php" class="flex-shrink-0">
                            <img class="h-8 w-8" src="img/avito_logo.png" alt="Avito">
                        </a>
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                <a href="dashboard.php"
                                    class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium"
                                    aria-current="page">Add</a>
                                <a href="delete.php"
                                    class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium"
                                    aria-current="page">Delete</a>
                                <a href="edit.php"
                                    class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium"
                                    aria-current="page">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">Edit Products</h1>
            </div>
        </header>
        <main>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Profile</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600 mb-6">This information will be displayed publicly so be careful
              what you edit.</p>
                <!-- Display products for editing -->
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        $product_id = $row['id'];
                        $product_title = $row['titre'];
                        $product_description = $row['description'];
                        $product_price = $row['prix'];
                        $product_picture = $row['image'];

                        echo "
                        <div class='p-6 bg-white border rounded-lg shadow-md'>
                            <img src='img/$product_picture' class='aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80'>
                            <form method='POST'>
                                <input type='hidden' name='product_id' value='$product_id'>
                                <label for='product_title' class='block text-sm font-medium text-gray-700'>Title</label>
                                <input type='text' name='product_title' value='$product_title' class='w-full px-3 py-2 mb-4 border rounded-md focus:outline-none focus:ring focus:border-blue-300'>

                                <label for='product_description' class='block text-sm font-medium text-gray-700'>Description</label>
                                <textarea name='product_description' class='w-full px-3 py-2 mb-4 border rounded-md focus:outline-none focus:ring focus:border-blue-300'>$product_description</textarea>

                                <label for='product_price' class='block text-sm font-medium text-gray-700'>Price</label>
                                <input type='text' name='product_price' value='$product_price' class='w-full px-3 py-2 mb-4 border rounded-md focus:outline-none focus:ring focus:border-blue-300'>

                                <button type='submit' name='update' class='bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring focus:border-blue-300'>Update</button>
                            </form>
                        </div>";
                    }
                    ?>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
