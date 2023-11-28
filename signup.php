<?php

include('connection.php');

if (isset($_POST['submit'])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $user_type = $_POST["user_type"];
    $user_picture_name = $_FILES['img']['name'];
    $user_picture_tmp = $_FILES['img']['tmp_name'];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT); //hashing the password

    move_uploaded_file($user_picture_tmp, "./img/$user_picture_name");

    $stmt = "INSERT INTO `user` (name, email, user_type, password, img) VALUES ('$name', '$email', '$user_type', '$password', '$user_picture_name')";
    $result = mysqli_query($conn, $stmt);

    header('Location: login.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Sign up</title>
</head>

<body>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <a href="index.php" ><img class="mx-auto h-10 w-auto" src="img/avito_logo.png"></a>
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign Up</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" method="POST" action="signup.php"
                enctype="multipart/form-data">

                <div>
                    <label for="img" class="block text-sm font-medium leading-6 text-gray-900">User image</label>
                    <div class="mt-2">
                        <input id="img" for="img" name="img" type="file" autocomplete="img" required
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium leading-6 text-gray-900">Username</label>
                    <div class="mt-2">
                        <input id="name" for="name" name="name" type="text" autocomplete="name" required
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                    <div class="mt-2">
                        <input id="email" for="email" name="email" type="email" autocomplete="email" required
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium leading-6 text-gray-900">User Type</label>
                    <div class="mt-2">
                        <select id="user_type" for="user_type" name="user_type"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <option value="utilisateur">Utilisateur</option>
                            <option value="annonceur">Annonceur</option>
                        </select>
                    </div>
                </div>

                <div>
                    <div class="mt-4 flex items-center justify-between">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                        <div class="text-sm">
                        </div>
                    </div>
                    <div class="mt-2">
                        <input id="password" for="password" name="password" type="password"
                            autocomplete="current-password" required
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <button type="submit" for="submit" name="submit"
                        class="mt-6 flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign
                        in</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>