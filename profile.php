<?php
session_start();

include('connection.php');

$user_id = $_SESSION["user_id"];

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

//updating data
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $query = "UPDATE user SET name='$name', email='$email' WHERE user_id=$user_id";
    $result = mysqli_query($conn, $query);
}

$user_id = $_SESSION["user_id"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>User profile</title>
</head>

<body>

    <?php include 'navDash.php'; ?>

    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">User profile</h1>
        </div>
    </header>
    <main>
        <?php

        $sql = "SELECT * FROM user WHERE user_id = $user_id";
        $result = mysqli_query($conn, $sql);


        while ($row = mysqli_fetch_assoc($result)) {
            $user_id = $row['user_id'];
            $name = $row['name'];
            $email = $row['email'];
            $user_type = $row['user_type'];
            $user_picture = $row['img'];


            echo "
            <div class='mx-auto max-w-xl py-16 sm:px-12 lg:px-16'>
                <div class='bg-white overflow-hidden shadow rounded-lg p-6'>
                    <div class='bg-white overflow-hidden shadow rounded-lg'>
                        <form method='POST'>
                            <div class='p-4'>
                                <div class='flex items-center justify-center'>
                                    <img src='img/$user_picture' alt='User Image' class='w-16 h-16 rounded-full'>
                                </div>
                                <div class='mt-4 text-center'>
                                    <input class='text-lg font-medium leading-6 text-gray-900' type='text' name='name' value='$name'>
                                </div>
                                <div class='mt-4 text-center'>
                                    <input class='text-lg font-medium text-gray-900' type='text' name='email' value='$email'>
                                </div>
                                <div class='mt-4 text-center'>
                                    <p class='text-sm leading-5 font-medium text-indigo-600'>$user_type</p>
                                </div>
                                <button type='submit' name='submit' class='bg-indigo-600 text-white px-4 py-2 rounded-md'>Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>";
        }
        ?>
    </main>
    </div>
</body>

</html>