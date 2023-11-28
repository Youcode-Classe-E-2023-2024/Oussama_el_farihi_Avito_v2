<?php

session_start();

include('connection.php');

if (isset($_SESSION["user_id"])) {
  header("Location: profile.php");
  exit();
}

if (isset($_POST['submit'])) {
  $email = $_POST["email"];
  $password = $_POST["password"];


  $query = "SELECT * FROM user WHERE email = '$email'";
  $result = mysqli_query($conn, $query);

  if ($result->num_rows > 0) {
    $user = mysqli_fetch_assoc($result);

    //check the password using password_verify
    if (password_verify($password, $user['password'])) {
      
      $_SESSION["name"] = $user['name'];
      $_SESSION["user_id"] = $user['user_id'];
      $_SESSION["user_type"] = $user['user_type'];

      switch ($user['user_type']) {
        case 'admin':
          header("Location: profile.php");
          break;
        case 'utilisateur':
          header("Location: profile.php");
          break;
        case 'annonceur':
          header("Location: profile.php");
          break;
        }
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
  <title>Login</title>
</head>

<body>

  <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <a href="index.php" ><img class="mx-auto h-10 w-auto" src="img/avito_logo.png"></a>
      <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your account
      </h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" action="login.php" method="POST">
        <div>
          <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
          <div class="mt-2">
            <input id="email" for="email" name="email" type="email" autocomplete="email" required
              class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          </div>
        </div>

        <div>
          <div class="flex items-center justify-between">
            <label class="block text-sm font-medium leading-6 text-gray-900">Password</label>
          </div>
          <div class="mt-2">
            <input id="password" for="password" name="password" type="password" autocomplete="current-password" required
              class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          </div>
        </div>

        <div>
          <button type="submit" for="submit" name="submit"
            class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Log
            in</button>
        </div>
      </form>

      <p class="mt-10 text-center text-sm text-gray-500">
        Not a member?
        <a href="signup.php" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Sign Up NOW!</a>
      </p>
    </div>
  </div>
</body>

</html>