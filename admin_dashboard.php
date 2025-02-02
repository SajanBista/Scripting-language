<?php

include '../include/connect.php';

// session_start();

$admin_id = isset($_SESSION['admin_id']);

// if (!isset($admin_id)) {
//   header('location:admin_login.php');
//   exit();
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>

  <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

  <link rel="stylesheet" href="../css/admin_part.css">

  <!-- font awesome cdn link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

  <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

  <!--Bootstrap Link-->
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap JS and Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    /*admin dashboard*/

    html,
    body {
      margin: 0;
      padding: 0;
      width: 100%;
    }

    .container {
      max-width: 100%;
      background-color: rgb(43, 41, 41);
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .top-header-navbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 20px;
    }

    .top-header-navbar a {
      text-decoration: none;
      color: white;
      font-weight: 600;
      font-size: 1.2rem;
    }

    .top-header-navbar a:hover {
      color: rgb(203, 228, 255);
    }

    .header a {
      padding: 20px;
    }

    .header i {
      color: white;
      font-weight: 600;
      font-size: 1.2rem;
    }

    .header i:hover {
      color: rgb(203, 228, 255);
      cursor: pointer;
    }

    h3 {
      font-size: 1.5rem;
      display: flex;
      width: 100%;
      justify-content: center;
      background-color: rgba(11, 24, 35, 0.58);
      padding: 0.8rem;
      color: rgba(247, 242, 242, 0.87);
      font-weight: 600;
    }

    .card {
      width: 300px;
      height: 260px;
      border-radius: 20px;
      background: #f5f5f5;
      position: relative;
      padding: 1.8rem;
      border: 2px solid #c3c6ce;
      transition: 0.5s ease-out;
      overflow: visible;
      cursor: pointer;
    }

    .card-details {
      color: black;
      height: 100%;
      gap: .5em;
      display: grid;
      place-content: center;
    }

    .card-button {
      transform: translate(-50%, 125%);
      width: 60%;
      border-radius: 1rem;
      border: none;
      background-color: #008bf8;
      color: #fff;
      font-size: 1rem;
      padding: .5rem 1rem;
      position: absolute;
      left: 50%;
      bottom: 0;
      opacity: 0;
      transition: 0.3s ease-out;
    }

    .text-body {
      color: rgb(134, 134, 134);
    }

    .heading {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      padding: 40px;
    }

    .text-title {
      font-size: 1.5em;
      font-weight: bold;
    }

    .card:hover {
      border-color: #008bf8;
      box-shadow: 0 4px 18px 0 rgba(0, 0, 0, 0.25);
    }

    .card:hover .card-button {
      transform: translate(-50%, 50%);
      opacity: 1;
    }

    .panel-icon {
      font-size: 100px;
      color: #007bff;
      text-align: center;
    }

    .text-title {
      text-align: center;
    }

    .card-button a {
      text-decoration: none;
      color: #fff;
    }
  </style>
</head>

<body>
  <!--Navbar Header-->

  <div class="container">
    <div class="top-header-navbar">
      <a href="#">Hike Gear Nepal</a>
      <div class="header">
        <i class="fa-solid fa-bell"></i>
        <a href="#">Settings</a>
        <a href="admin_logout.php">Logout</a>
      </div>
    </div>
  </div>

  <!--Dashboard Cards-->


  <h3>Admin Dashboard</h3>
  <div class="heading">

    <div class="heading">
      <div class="card">
        <div class="card-details">
          <div class="panel-icon">👤</div>
          <p class="text-title"> User Panel</p>

        </div>
        <button class="card-button"><a href="admin_user.php">More info</a> <i class="fa-solid fa-arrow-right"></i></button>
      </div>
    </div>

    <div class="heading">
      <?php

      $query = "SELECT * FROM `orders`";
      $result = mysqli_query($conn, $query);

      $number_of_orders = $result->num_rows;

      ?>
      <div class="card">
        <div class="card-details">
          <div class="panel-icon">📦</div>
          <p class="text-title">Order Panel</p>
        </div>
        <button class="card-button"><a href="order_panel.php">More info</a> <i class="fa-solid fa-arrow-right"></i></button>

      </div>
    </div>

    <div class="heading">
      <div class="card">
        <div class="card-details">
          <div class="panel-icon">🛒</div>
          <p class="text-title">Add Products</p>
        </div>
        <button class="card-button"><a href="products.php">More info</a> <i class="fa-solid fa-arrow-right"></i></button>
      </div>
    </div>

    <div class="heading">
      <div class="card">
        <div class="card-details">
          <div class="panel-icon">🛠️</div>
          <p class="text-title">Admin Panel</p>

        </div>
        <button class="card-button"><a href="admin_account.php">More info</a> <i class="fa-solid fa-arrow-right"></i></button>
      </div>
    </div>
  </div>


</body>

</html>