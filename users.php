<?php
session_start();

include('connection.php');

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


    echo "<li class='flex justify-between gap-x-6 py-5'>
    <div class='flex min-w-0 gap-x-4'>
      <img class='h-12 w-12 flex-none rounded-full bg-gray-50' src='img/$user_picture'>
      <div class='min-w-0 flex-auto'>
        <p class='text-sm font-semibold leading-6 text-gray-900'>$username</p>
        <p class='mt-1 truncate text-xs leading-5 text-gray-500'>$email</p>
      </div>
    </div>
  </li>";
}
?>
  
</ul>


</body>

</html>