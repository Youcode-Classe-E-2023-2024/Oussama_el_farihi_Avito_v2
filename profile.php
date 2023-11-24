<?php
session_start();
include('connection.php');

include('connection.php'); // Include your connection file

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    // Redirect to the login page or handle the case where the user is not logged in
    header("Location: login.php");
    exit();
}

// Retrieve the user ID from the session
$user_id = $_SESSION["user_id"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Dashboard</title>
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

        // Fetch the information of the logged-in user from the 'user' table
        $sql = "SELECT * FROM user WHERE id = $user_id";
        $result = mysqli_query($conn, $sql);

        // Loop through the result and display each user
        while ($row = mysqli_fetch_assoc($result)) {
            $user_id = $row['id'];
            $username = $row['name'];
            $email = $row['email'];
            $role = $row['user_type'];
            $user_picture = $row['img'];


            echo "
          <!-- Add this section after the main content of the dashboard.php file -->
        <div class='mx-auto max-w-7xl py-6 sm:px-6 lg:px-8'>
            <div class='grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3'>
                <!-- Profile Card -->
                <div class='bg-white overflow-hidden shadow rounded-lg'>
                    <div class='p-4'>
                        <!-- User Image -->
                        <div class='flex items-center justify-center'>
                            <img src='img/$user_picture' alt='User Image' class='w-16 h-16 rounded-full'>
                        </div>
                        <!-- User Name -->
                        <div class='mt-4 text-center'>
                            <h3 class='text-lg font-medium leading-6 text-gray-900'>$username</h3>
                        </div>
                        <!-- User Email -->
                        <div class='mt-2 text-center'>
                            <p class='text-sm leading-5 text-gray-600'>$email</p>
                        </div>
                        <!-- User Role -->
                        <div class='mt-2 text-center'>
                            <p class='text-sm leading-5 font-medium text-indigo-600'>$role</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
        }
        ?>
    </main>
    </div>
</body>

</html>