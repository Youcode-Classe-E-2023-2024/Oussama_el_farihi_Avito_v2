<?php
include 'connection.php';


// Process product deletion
if (isset($_POST['delete'])) {
    if (isset($_POST['selected_products'])) {
        foreach ($_POST['selected_products'] as $product_id) {
            $delete_query = "DELETE FROM annonce WHERE id = ?";
            $stmt = $conn->prepare($delete_query);
            $stmt->bind_param('i', $product_id);

            if ($stmt->execute()) {
                echo "<script>alert('Selected products deleted successfully'); window.location.href='delete.php';</script>";
                exit();
            } else {
                echo "<script>alert('Failed to delete products: " . $stmt->error . "');</script>";
            }
        }
    } else {
        echo "<script>alert('No products selected for deletion');</script>";
    }
    header("Location: ". $_SERVER['PHP_SELF']);
  exit();
}

// Fetch all products for display
$select_all_query = "SELECT id, titre, image FROM annonce";
$result = $conn->query($select_all_query);
$products = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Delete Products</title>
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
    <main>
        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">Edit Products</h1>
            </div>
        </header>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h2 class="text-base font-semibold leading-7 text-gray-900">Profile</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">This information will be displayed publicly so be careful
              what you delete.</p>
            <form method="POST" action="delete.php">
                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <?php foreach ($products as $product): ?>
                        <div class="col-span-6 sm:col-span-4 flex items-center">
                            <input type="checkbox" name="selected_products[]" value="<?php echo $product['id']; ?>"
                                class="mr-2">
                            <img src="img/<?php echo $product['image']; ?>" alt="<?php echo $product['titre']; ?>"
                                class="h-16 w-16 object-cover rounded-md mr-4">
                            <label class="text-sm text-gray-900">
                                <?php echo $product['titre']; ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="submit" name="delete"
                        class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">Delete
                        Selected</button>
                    <a href="dashboard.php" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
                </div>
            </form>
        </div>
    </main>
    </div>
</body>

</html>