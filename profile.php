<?php include('connection.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Dashboard</title>
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
                                <a href="profile.php"
                                    class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium"
                                    aria-current="page">Profile</a>
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
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">User profile</h1>
        </div>
    </header>
    <main>
        <?php 
        // Fetch the rows from the 'user' table
        $sql = "SELECT * FROM user";
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