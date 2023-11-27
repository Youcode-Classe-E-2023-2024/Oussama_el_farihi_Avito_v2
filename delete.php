<?php
session_start();

include 'connection.php';

// fetching user ID and user_type from session
$user_id = $_SESSION["user_id"];
$user_type = $_SESSION["user_type"];

// fetch only products associated with the user who logged if the user is an "annonceur"
if ($user_type == 'annonceur') {
    $query = "SELECT id, titre, image FROM annonce WHERE user_id = $user_id";
} else {
    // fetch all products for an "admin"
    $query = "SELECT id, titre, image FROM annonce";
}

$run_query = mysqli_query($conn, $query);
$products = mysqli_fetch_all($run_query, MYSQLI_ASSOC); //fetche all the results from the executed query $run_query

// delete process
if (isset($_POST['delete'])) {
    if (isset($_POST['selected_products'])) {
        foreach ($_POST['selected_products'] as $product_id) {
            // check user type before deleting
            if ($user_type == 'annonceur') {
                $delete_query = "DELETE FROM annonce WHERE id = $product_id AND user_id = $user_id";
            } else {
                $delete_query = "DELETE FROM annonce WHERE id = $product_id";
            }
            
            mysqli_query($conn, $delete_query);
        }
    }
    header("Location: delete.php");
}
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

    <?php include 'navDash.php'; ?>

    <main>
        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">Delete Products</h1>
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
                    <a href="add.php" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
                </div>
            </form>
        </div>
    </main>
    </div>
</body>

</html>