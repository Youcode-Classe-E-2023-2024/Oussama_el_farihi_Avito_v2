<?php
session_start();

include('connection.php');

// Check if the delete button is clicked
if(isset($_POST['delete_user'])) {
    $user_id_to_delete = $_POST['user_id_to_delete'];

    // Check if there are related records in the 'annonce' table
    $check_query = "SELECT COUNT(*) as count FROM annonce WHERE user_id = $user_id_to_delete";
    $check_result = mysqli_query($conn, $check_query);
    $check_row = mysqli_fetch_assoc($check_result);
    $related_records_count = $check_row['count'];

    // If there are related records, prompt the user to delete them first
    if ($related_records_count > 0) {
        echo "<script>alert('Cannot delete user. There are related records in the annonce table.'); window.location.href='users.php';</script>";
    } else {
        // No related records, proceed with user deletion
        $delete_query = "DELETE FROM user WHERE user_id = $user_id_to_delete";
        $delete_result = mysqli_query($conn, $delete_query);

        // Add error handling and feedback as needed
        if($delete_result) {
            echo "<script>alert('User deleted successfully'); window.location.href='users.php';</script>";
        } else {
            echo "Error deleting user: " . mysqli_error($conn);
        }
    }
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
              </div>
            </div>
            <div class='hidden shrink-0 sm:flex sm:flex-col sm:items-end'>
              <select id='user_type' name='user_type' class='block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6'>";

            // Define the role options
            $roleOptions = ['admin', 'utilisateur', 'annonceur'];

            // Loop through the role options to create the dropdown
            foreach ($roleOptions as $option) {
                // Check if the current option matches the user's existing role
                $selected = ($option == $role) ? 'selected' : '';

                // Output the option tag
                echo "<option value='$option' $selected>$option</option>";
            }

            echo "</select>
                </div>
                <form method='post' action='users.php'>
                    <input type='hidden' name='user_id_to_delete' value='$user_id'>
                    <button type='submit' name='delete_user' class='mt-2 text-sm font-medium text-red-600 hover:text-red-500 focus:outline-none focus:underline'>Delete User</button>
                </form>
            </li>";
        }
        ?>

    </ul>

</body>

</html>
