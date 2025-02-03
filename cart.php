<?php
include 'include/connect.php';
session_start();

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
  $user_id = '';
}

if (isset($_POST['delete'])) {
  $cart_id = $_POST['cart_id'];
  $query = "DELETE FROM `cart` WHERE id = '$cart_id'";
  mysqli_query($conn, $query);
}

if (isset($_GET['delete_all']) && $user_id) {
  $query = "DELETE FROM `cart` WHERE user_id = '$user_id'";
  mysqli_query($conn, $query);
  header('location: cart.php');
  exit();
}

if (isset($_POST['update_qty'])) {
  $cart_id = $_POST['cart_id'];
  $qty = $_POST['qty'];
  $query = "UPDATE `cart` SET quantity = '$qty' WHERE id = '$cart_id'";
  mysqli_query($conn, $query);
}


if (isset($_POST['add_product'])) {
  $name = htmlspecialchars(trim($_POST['name'] ?? ''));
  $price = htmlspecialchars(trim($_POST['price'] ?? ''));
  $qty = htmlspecialchars(trim($_POST['qty'] ?? ''));

  if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'images/products/' . basename($image);

    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $file_extension = strtolower(pathinfo($image, PATHINFO_EXTENSION));
    if (!in_array($file_extension, $allowed_extensions)) {
      echo "<script>alert('Invalid file format. Allowed formats: jpg, jpeg, png, gif');</script>";
      exit;
    }

    if ($image_size > 2 * 1024 * 1024) {
      echo "<script>alert('File size is too large. Maximum 2MB allowed.');</script>";
      exit;
    }

    // Move the uploaded file
    if (move_uploaded_file($image_tmp_name, $image_folder)) {
      $query = "INSERT INTO cart (name, price, qty, image) 
              VALUES ('$name', '$price', '$qty', '$image')";

      if (mysqli_query($conn, $query)) {
        echo "<script>alert('Product added successfully and saved in database.');</script>";
      } else {
        echo "Error: " . mysqli_error($conn);
      }
    } else {
      echo "<script>alert('Failed to move the uploaded file.');</script>";
    }
  } else {
    echo "<script>alert('Please upload an image.');</script>";
  }

  if (isset($_POST['add_product'])) {
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $price = htmlspecialchars(trim($_POST['price'] ?? ''));
    $qty = htmlspecialchars(trim($_POST['qty'] ?? ''));

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
      $image = $_FILES['image']['name'];
      $image_size = $_FILES['image']['size'];
      $image_tmp_name = $_FILES['image']['tmp_name'];
      $image_folder = 'images/products/' . basename($image);

      $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
      $file_extension = strtolower(pathinfo($image, PATHINFO_EXTENSION));
      if (!in_array($file_extension, $allowed_extensions)) {
        echo "<script>alert('Invalid file format. Allowed formats: jpg, jpeg, png, gif');</script>";
        exit;
      }

      if ($image_size > 2 * 1024 * 1024) {
        echo "<script>alert('File size is too large. Maximum 2MB allowed.');</script>";
        exit;
      }

      // Move the uploaded file
      if (move_uploaded_file($image_tmp_name, $image_folder)) {
        $query = "INSERT INTO products (name, price, qty, image) 
              VALUES ('$name', '$price', '$qty', '$image')";

        if (mysqli_query($conn, $query)) {
          echo "<script>alert('Product added successfully and saved in database.');</script>";
        } else {
          echo "Error: " . mysqli_error($conn);
        }
      } else {
        echo "<script>alert('Failed to move the uploaded file.');</script>";
      }
    } else {
      echo "<script>alert('Please upload an image.');</script>";
    }
  }
}

if (isset($_POST['add_to_cart'])) {

  $pid = $_POST['pid'];
  $name = $_POST['name'];
  $price = $_POST['price'];
  $qty = $_POST['qty'];
  $image = $_POST['image'];

  $query = "SELECT * FROM `cart` WHERE user_id = '$user_id' AND pid = '$pid'";
  $result = mysqli_query($conn, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $query = "UPDATE `cart` SET quantity = quantity + $qty WHERE user_id = '$user_id' AND pid = '$pid'";
    mysqli_query($conn, $query);
  } else {
    $query = "INSERT INTO `cart` (user_id, pid, name, price, quantity,image) VALUES ('$user_id', '$pid', '$name', '$price', '$qty', '$image')";
    mysqli_query($conn, $query);
  }
  header('location: cart.php');
  exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cart</title>

  <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

  <link rel="stylesheet" href="css/style.css">

  <!-- font awesome cdn link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

  <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

  <!--Bootstrap Link-->
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap JS and Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    /*Shopping Cart*/

    .shopping-cart .fa-edit {
      height: 4rem;
      border-radius: 3rem;
      background-color: rgb(108, 79, 24);
      width: 5rem;
      font-size: 2rem;
      color: rgb(208, 208, 208);
      cursor: pointer;
    }

    .shopping-cart .fa-edit:hover {
      background-color: rgb(36, 33, 33);
    }

    .sub-total {
      margin: 1rem 0;
      font-size: 2rem;
      color: rgb(200, 224, 233);
    }

    .sub-total span {
      color: rgb(94, 48, 48);
    }

    .cart-total {
      max-width: 50rem;
      margin: 0 auto;
      margin-top: 3rem;
      background-color: rgb(215, 203, 203);
      border: #1d6621;
      border-radius: 3rem;
      padding: 2rem;
      text-align: center;
    }

    .cart-total p {
      font-size: 2rem;
      color: black;
      margin-bottom: 2rem;
    }

    .cart-total p span {
      color: rgb(94, 48, 48);
    }

    .btns,
    .delete_btn,
    .option-btn {
      display: block;
      width: 100%;
      margin-top: 1rem;
      border-radius: 3rem;
      padding: 1rem 2rem;
      font-size: 1.4rem;
      color: whitesmoke;
      cursor: pointer;
      text-align: center;
      text-decoration: none;
    }

    .btns,
    .delete_btn:hover,
    .option-btn:hover {
      background-color: black;
    }

    .option-btn {
      background-color: rgb(108, 79, 24);
    }

    .delete_btn {
      background-color: rgb(100, 49, 8);
    }

    .sub-total {
      margin: 2rem 0;
      font-size: 2rem;
      color: black;
    }

    .pro-image {
      flex: 1;
      max-width: 100%;
      text-align: center;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      margin: 4rem;
      object-fit: contain;
      height: 20rem;
    }

    .name {
      font-size: 2rem;
    }

    .price {
      font-size: 1.2rem;
      color: gray;
    }

    .box {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .qty {
      width: rem;
      height: 4rem;
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Hike Gear Nepal</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center align-items-center" id="navbarNav">
        <ul class="navbar-nav nav ms-">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="order.php">Orders</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="shop.php">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact</a>
          </li>
        </ul>
      </div>


      <form class="d-flex" action="search_page.php" method="post">
        <input class="form-control me-2 search-input" type="search" name="search_box" placeholder="Search" aria-label="Search" maxlength="100" required>
        <button class="btn btn-outline-success btn-search" type="submit" name="search_btn">Search</button>
      </form>

      <div class="icon">
        <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
        <a href="wishlist.php"><i class="fa-solid fa-heart"></i></a>
        <a href="user_login.php"><i class="fa-solid fa-user"></i></a>
      </div>
    </div>
  </nav>

  <section class="shopping-cart">
    <h1 class="heading">Your Cart</h1>
    <div class="box-container">
      <?php
      $grand_total = 0;

      isset($user_id);
      if ($user_id) {
        $query = "SELECT * FROM `cart` WHERE user_id = '$user_id'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
          while ($fetch_cart = mysqli_fetch_assoc($result)) {
            $sub_total = $fetch_cart['price'] * $fetch_cart['quantity'];
            $grand_total += $sub_total;
      ?>
            <form action="" method="post" class="box">
              <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">

              <img src="images/products/<?= htmlspecialchars($fetch_cart['image']); ?>" name="image">
              <div class="name"><?= $fetch_cart['name']; ?></div>
              <div class="flex">
                <div class="price">Rs.<?= $fetch_cart['price']; ?>/-</div>
                <input type="number" class="qty" name="qty" class="qty" min="1" max="99" value="<?= $fetch_cart['quantity']; ?>">
                <button type="submit" name="update_qty" class="fas fa-edit"></button>
              </div>
              <div class="sub-total">Sub-Total: Rs.<?= $sub_total; ?>/-</div>
              <input type="submit" name="delete" value="Delete" class="delete-btn">
            </form>

      <?php
          }
        } else {
          echo '<p class="empty">Your cart is empty.</p>';
        }
      } else {
        echo '<p class="empty">Please login to view your cart.</p>';
      }
      ?>
    </div>

    <div class="cart-total">
      <p>Total: Rs.<?= $grand_total; ?>/-</p>
      <a href="index.php" class="option-btn">Continue Shopping</a>
      <a href="cart.php?delete_all" class="delete_btn <?= ($grand_total > 0) ? '' : 'disabled'; ?>">Delete All</a>
      <a href="checkout.php" class="btns <?= ($grand_total > 0) ? '' : 'disabled'; ?>">Proceed to Checkout</a>
    </div>
  </section>
</body>

</html>