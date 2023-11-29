<?php
session_start();

include('connection.php');

if($_SESSION["user_type"] != "admine"){
    header("Location: profile.php");
    exit();
}

if (isset($_POST['submit'])) {
    $id_delete = $_POST['id_delete'];

    $delete_query = "DELETE FROM user WHERE user_id = $id_delete";
    $delete_result = mysqli_query($conn, $delete_query);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Users</title>
</head>

<body>

    <?php include 'navDash.php'; ?>
    <ul role="list" class="divide-y divide-gray-100">
        <?php

        // Fetch the information of all users
        $sql = "SELECT * FROM user";
        $result = mysqli_query($conn, $sql);

        // Loop through the result and display each user
        while ($row = mysqli_fetch_assoc($result)) {
            $user_id = $row['user_id'];
            $username = $row['name'];
            $email = $row['email'];
            $role = $row['user_type'];
            $user_picture = $row['img'];

            echo "<li class='flex justify-evenly gap-x-20 py-4'>
            <div class='flex min-w-0 gap-x-4'>
              <img class='h-12 w-12 flex-none rounded-full bg-gray-50' src='img/$user_picture'>
              <div class='min-w-0 flex-auto'>
                <p class='text-sm font-semibold leading-6 text-gray-900'>$username</p>
                <p class='mt-1 truncate text-xs leading-5 text-gray-500'>$email</p>
                <p class='mt-1 truncate text-xs leading-5 text-gray-500'>$role</p>
              </div>
            </div>";

            echo "</select>
                </div>
                <form method='post' action='users.php'>
                    <input type='hidden' name='id_delete' value='$user_id'>
                    <button type='submit' name='submit' class='mt-2 text-sm font-medium text-red-600 hover:text-red-500 focus:outline-none focus:underline'>Delete User</button>
                </form>
            </li>";
        }
        ?>
    </ul>
</body>

</html>