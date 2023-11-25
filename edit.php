<?php
session_start();

include 'connection.php';

// Retrieve the user ID and user_type from the session
$user_id = $_SESSION["user_id"];
$user_type = $_SESSION["user_type"];

// Fetch only products associated with the logged-in user if the user is an "annonceur"
if ($user_type == 'annonceur') {
    $select_all_query = "SELECT id, titre, image, description, prix FROM annonce WHERE user_id = $user_id";
} else {
    // Fetch all products for an "admin"
    $select_all_query = "SELECT id, titre, image, description, prix FROM annonce";
}

$result = $conn->query($select_all_query);
$products = $result->fetch_all(MYSQLI_ASSOC);

// Handle form submission for updating products
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $product_id = $_POST['product_id'];
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];

    // Check user type before editing
    if ($user_type == 'annonceur') {
        // Annonceur can only update their own products
        $update_sql = "UPDATE annonce SET titre=?, description=?, prix=? WHERE id=? AND user_id=?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param('sssii', $product_title, $product_description, $product_price, $product_id, $user_id);
    } else {
        // Admin can update any products details
        $update_sql = "UPDATE annonce SET titre=?, description=?, prix=? WHERE id=?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param('sssi', $product_title, $product_description, $product_price, $product_id);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Product updated successfully');</script>";
    } else {
        echo "<script>alert('Failed to update product: " . $stmt->error . "');</script>";
    }
    header("Location: " . $_SERVER['PHP_SELF']);
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

    <?php include 'navDash.php'; ?>

    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Edit Products</h1>
        </div>
    </header>
    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Profile</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600 mb-6">This information will be displayed publicly so be
                careful
                what you edit.</p>
            <!-- Display products for editing -->
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <?php
                foreach ($products as $row) {
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