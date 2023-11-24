<?php

include 'connection.php';

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    // Redirect to the login page or handle the case where the user is not logged in
    header("Location: login.php");
    exit();
}

// Retrieve the user type from the session
$user_type = $_SESSION["user_type"];


 if ($user_type == 'admin'){
    echo '<div class="min-h-full">
    <nav class="bg-gray-800">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
          <div class="flex items-center">
            <a href="index.php" class="flex-shrink-0">
              <img class="h-8 w-8" src="img/avito_logo.png" alt="Avito">
            </a>
            <div class="hidden md:block">
              <div class="ml-10 flex items-baseline space-x-4">
                <a href="profile.php" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium"
                  aria-current="page">Profile</a>
                <a href="dashboard.php" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium"
                  aria-current="page">Add</a>
                <a href="delete.php" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium"
                  aria-current="page">Delete</a>
                <a href="edit.php" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium"
                  aria-current="page">Edit</a>
                  <a href="users.php" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium"
                  aria-current="page">Users</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>';
 }elseif($user_type == 'annonceur'){
    echo '<div class="min-h-full">
    <nav class="bg-gray-800">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
          <div class="flex items-center">
            <a href="index.php" class="flex-shrink-0">
              <img class="h-8 w-8" src="img/avito_logo.png" alt="Avito">
            </a>
            <div class="hidden md:block">
              <div class="ml-10 flex items-baseline space-x-4">
                <a href="profile.php" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium"
                  aria-current="page">Profile</a>
                <a href="dashboard.php" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium"
                  aria-current="page">Add</a>
                <a href="delete.php" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium"
                  aria-current="page">Delete</a>
                <a href="edit.php" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium"
                  aria-current="page">Edit</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>';
 }else{
    echo '<div class="min-h-full">
    <nav class="bg-gray-800">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
          <div class="flex items-center">
            <a href="index.php" class="flex-shrink-0">
              <img class="h-8 w-8" src="img/avito_logo.png" alt="Avito">
            </a>
            <div class="hidden md:block">
              <div class="ml-10 flex items-baseline space-x-4">
                <a href="profile.php" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium"
                  aria-current="page">Profile</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>';
 }
?>