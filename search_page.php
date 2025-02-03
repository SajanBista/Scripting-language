<?php
include 'include/connect.php';

session_start();
if (isset($_POST['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
  $user_id = '';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>

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
    input[type="submit"] {
      width: auto;
      height: 3rem;
      background-color: rgb(25, 105, 85);
      color: white;
      border: none;
      border-radius: 10px;
      font-size: 1.1rem;
      cursor: pointer;
      display: flex;
      flex-direction: column;
      gap: 1rem;
      width: 300px;
      margin: auto;
    }
  </style>
</head>

<body>

  <form class="d-flex" action="" method="post">
    <input class="form-control me-2 search-input" type="search" name="search_box" placeholder="Search" aria-label="Search" maxlength="100" required>
    <button class="btn btn-outline-success btn-search" type="submit" name="search_btn">Search</button>
  </form>

  <section class="products">
    <div class="box-container">

      <?php
      if (isset($_POST['search_box']) or isset($_POST['search_btn'])) {  //checks if the form was submitted.
        $search_box = $_POST['search_box']; //stores value entered in search bx into var $search box.

        $conn = new mysqli('localhost', 'root', '', 'eco_planet');

        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        $search_box = $conn->real_escape_string($search_box); //prevent sql injection

        $query = "SELECT * FROM `products` WHERE name LIKE '%$search_box%'";


        $result = $conn->query($query);


        if ($result->num_rows > 0) {
          while ($fetch_product = $result->fetch_assoc()) {
      ?>
            <form action="" method="post" class="box">
              <input type="hidden" name="pid" value="<?= isset($fetch_product['pid']); ?>">

              <input type="hidden" name="name" value="<?= isset($fetch_product['name']); ?>">

              <input type="hidden" name="price" value="<?= isset($fetch_product['price']); ?>">

              <input type="hidden" name="image" value="<?= isset($fetch_product['image']); ?>">

              <img src="images/products/<?= $fetch_product['image']; ?>" alt="">

              <div class="name"><?= htmlspecialchars(($fetch_product['name'])); ?></div>
              <div class="flex">
                <div class="price">Rs.<?= htmlspecialchars(($fetch_product['price'])); ?></div>

                <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length==2) return false ;" value="1">
              </div>

              <input type="submit" value="Add to Cart" class="btns" name="">
            </form>
      <?php
          }
        } else {
          echo "<script type='text/javascript'>
                            alert('0 results.');
                            window.location.href='index.php';
                            </script>";
        }
        $conn->close();
      }
      ?>
    </div>
  </section>
</body>

</html>