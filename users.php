<?php

session_start();


// Retrieve the user ID and user_type from the session
$user_id = $_SESSION["user_id"];
$user = $_SESSION["user_type"];

include('connection.php');

// Fetch the rows from the 'product' table
$sql = "SELECT * FROM annonce";
$result = mysqli_query($conn, $sql);

// Retrieve the user ID from the session
$user_id = $_SESSION["user_id"];
$user = $_SESSION["user_type"];

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

</body>

</html>