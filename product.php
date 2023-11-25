<?php include('connection.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Product</title>
</head>
<body>
  <!---- navbar --->
  <?php include 'navbar.php'; ?>
  <!---- navbar --->
<div class="bg-white">
    <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
      <h2 class="text-4xl font-bold tracking-tight text-gray-900 text-center">Our Products</h2>
      <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
        <?php
        // Fetch the rows from the 'product' table
        $sql = "SELECT * FROM annonce";
        $result = mysqli_query($conn, $sql);

        // Loop through the result and display each product
        while ($row = mysqli_fetch_assoc($result)) {
          $product_id = $row['id'];
          $product_title = $row['titre'];
          $product_description = $row['description'];
          $product_price = $row['prix'];
          $product_picture = $row['image'];

          echo "<div class='group relative' method='POST'>
          <div
            class='aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80'>
            <img src='img/$product_picture'
              class='h-full w-full object-cover object-center lg:h-full lg:w-full'>
          </div>
          <div class='mt-4 flex justify-between'>
            <div>
              <h3 class='text-sm text-gray-700'>
                <a href='#'>
                  <span aria-hidden='true' class='absolute inset-0'></span>
                  $product_title
                </a>
              </h3>
              <p class='mt-1 text-sm text-gray-500'>$product_description</p>
            </div>
            <p class='text-sm font-medium text-gray-900'>$$product_price</p>
          </div>
          </div>";
        }
        ?>

      </div>
    </div>
  </div>
</body>
</html>