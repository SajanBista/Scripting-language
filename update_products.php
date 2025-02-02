<?php
include '../include/connect.php';

session_start();


if (isset($_POST['update'])) {
  $pid = $_POST['pid'];
  $name = htmlspecialchars(trim($_POST['name'] ?? ''));
  $price = htmlspecialchars(trim($_POST['price'] ?? ''));
  $description = htmlspecialchars(trim($_POST['description'] ?? ''));

  // Update product details
  $update_product = "UPDATE `products` SET name='$name', price='$price', description='$description' WHERE id='$pid'";
  mysqli_query($conn, $update_product);

  echo "<script>
  alert('Product Updated Successfully.');
  window.location.href='products.php';
  </script>";

  $old_image = $_POST['old_image'];
  $image = $_FILES['image']['name'];
  $image_size = $_FILES['image']['size'];
  $image_tmp_name = $_FILES['image']['tmp_name'];
  $image_folder = '../images/products/' . $image;

  if (!empty($image)) {
    if ($image_size > 2000000) {
      echo "<script>alert('Image size is too large.');</script>";
    } else {
      $update_image = "UPDATE `products` SET image='$image' WHERE id='$pid'";
      mysqli_query($conn, $update_image);
      move_uploaded_file($image_tmp_name, $image_folder);
      echo "<script>alert('Image is Updated.');</script>";
    }
  } else {

    $image = $old_image;
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Products</title>

  <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
  <link rel="stylesheet" href="../css/admin_part.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f9;
    }

    .orders {
      max-width: 800px;
      margin: 50px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .orders .heading {
      text-align: center;
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 20px;
      color: #333;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .inputBox {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .inputBox span {
      font-size: 16px;
      font-weight: bold;
      color: #555;
    }

    .inputBox .box {
      padding: 10px;
      font-size: 14px;
      border: 1px solid #ddd;
      border-radius: 5px;
      background-color: #f9f9f9;
      transition: border-color 0.3s ease;
    }

    .inputBox .box:focus {
      border-color: #007bff;
      outline: none;
    }

    textarea.box {
      resize: none;
      height: 100px;
    }

    input[type="file"].box {
      padding: 5px;
      border: none;
      background-color: transparent;
    }

    .btns {
      padding: 12px;
      font-size: 16px;
      font-weight: bold;
      color: #fff;
      background-color: #007bff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btns:hover {
      background-color: #0056b3;
    }

    /*nav bar*/
    .container-box {
      width: 100%;
      background-color: #2a9d8f;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .top-header-navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 2rem;
      color: #fff;
      font-family: "Arial", sans-serif;
    }

    .top-header-navbar a {
      text-decoration: none;
      color: #fff;
      font-weight: bold;
      font-size: 1.5rem;
      transition: color 0.3s ease;
    }

    .top-header-navbar a:hover {
      color: #e9c46a;
    }

    .header {
      display: flex;
      align-items: center;
      gap: 1.5rem;
    }

    .header a {
      text-decoration: none;
      color: #fff;
      font-weight: bold;
      font-size: 1rem;
      transition: color 0.3s ease;
    }

    .header a:hover {
      color: #e76f51;
    }

    .header i {
      font-size: 1.5rem;
      cursor: pointer;
      transition: color 0.3s ease;
    }

    .header i:hover {
      color: #e9c46a;
    }
  </style>
</head>

<body>

  <div class="container-box">
    <div class="top-header-navbar">
      <a href="#">Eco-Planet</a>
      <div class="header">
        <i class="fa-solid fa-bell"></i>
        <a href="#">Settings</a>
        <a href="#">Logout</a>
      </div>
    </div>
  </div>

  <div class="swiper products-slider">
    <section class="orders">
      <h1 class="heading">Update Products</h1>

      <?php
      $update_id = $_GET['update'];
      $update_id = mysqli_real_escape_string($conn, $update_id);

      $query = "SELECT * FROM `products` WHERE id = '$update_id'";
      $result = mysqli_query($conn, $query);

      if ($result && mysqli_num_rows($result) > 0) {
        while ($fetch_products = mysqli_fetch_assoc($result)) {
          $product_name = $fetch_products['name'];
          $product_price = $fetch_products['price'];
          $product_description = $fetch_products['description'];
          $product_image = $fetch_products['image'];
      ?>

          <form action="" method="post" enctype="multipart/form-data">

            <input type="hidden" name="pid" value="<?php echo $update_id; ?>">
            <input type="hidden" name="old_image" value="<?php echo $product_image; ?>">

            <div class="inputBox">
              <span>Update Product Name</span>
              <input type="text" class="box" required name="name" placeholder="Name" value="<?php echo $product_name; ?>">
            </div>

            <div class="inputBox">
              <span>Update Price</span>
              <input type="number" class="box" required name="price" placeholder="Price" value="<?php echo $product_price; ?>">
            </div>

            <div class="inputBox">
              <span>Update Image</span>
              <input type="file" class="box" accept="image/*" name="image">
            </div>

            <div class="inputBox">
              <span>Update Description</span>
              <textarea name="description" class="box" required placeholder="Description"><?php echo $product_description; ?></textarea>
            </div>

            <input type="submit" name="update" class="btns" value="Update Product">
          </form>

      <?php
        }
      } else {
        echo 'Product not found.';
      }
      ?>

    </section>
    <div class="swiper-pagination"></div>
  </div>

  <footer class="bg-secondary text-center text-white">

    <div class="container p-4 pb-0">

      <section class="mb-4">

        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-facebook-f"></i></a>


        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-twitter"></i></a>


        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-google"></i></a>


        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-instagram"></i></a>

        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-linkedin-in"></i></a>

        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-github"></i></a>
      </section>

    </div>

    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2020 Copyright:
      <a class="text-white" href="https://mdbootstrap.com/">eco-planet.com</a>
    </div>

  </footer>


  <script src="js/script.js"></script>

  <script>
    // var swiper = new Swiper(".home-slider", {
    //     loop: true,
    //     spaceBetween: 20,
    //     pagination: {
    //         el: ".swiper-pagination",
    //         clickable: true,
    //     },
    // });

    var swiper = new Swiper(".category-slider", {
      loop: true,
      spaceBetween: 20,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      breakpoints: {
        0: {
          slidesPerView: 2,
        },
        650: {
          slidesPerView: 3,
        },
        768: {
          slidesPerView: 4,
        },
        1024: {
          slidesPerView: 5,
        },
      },
    });

    var swiper = new Swiper(".products-slider", {
      loop: true,
      spaceBetween: 20,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      breakpoints: {
        550: {
          slidesPerView: 2,
        },
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
        },
      },
    });
  </script>
</body>

</html>