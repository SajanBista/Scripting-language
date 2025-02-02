<?php

include '../include/connect.php';

session_start();
//$admin_id = isset($_SESSION['admin_id']);

if (isset($_GET['delete'])) {
  $delete_id = intval($_GET['delete']);
  $query = "DELETE FROM admins WHERE id = '$delete_id'";
  $result = mysqli_query($conn, $query);

  if ($conn->query($query) === TRUE) {
    echo "<script type='text/javascript'>
    alert('Record Deleted Successfully.');
    window.location.href='admin_account.php';
    </script>";
  } else {
    echo "<script type='text/javascript'>
    alert('Error deleting record: $conn->error');
    window.location.href='admin_account.php';
    </script>";
  }

  header('location:admin_update.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Account</title>

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
    .accounts {
      padding: 50px 20px;
      background-color: #f4f4f4;
    }

    .accounts .heading {
      text-align: center;
      font-size: 36px;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .box-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
    }

    .box {
      background-color: #fff;
      padding: 20px;
      width: 250px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      text-align: center;
    }

    .box h3 {
      font-size: 24px;
      margin-bottom: 30px;
      margin-top: 1rem;
    }

    .box p {
      font-size: 16px;
      color: #555;
    }

    .box .flex-btn {
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
    }

    .box .flex-btn a {
      text-decoration: none;
      padding: 8px 15px;
      border-radius: 5px;
      font-size: 14px;
    }

    .option-btn {
      background-color: #4CAF50;
      color: #fff;
    }

    .option-btn:hover {
      background-color: #45a049;
    }

    .option-btns {
      background-color: #4CAF50;
      color: #fff;
      text-decoration: none;
      padding: 1rem;
      border-radius: 1rem;
    }

    .option-btns:hover {
      background-color: #45a049;
    }

    .delete-btn {
      background-color: #f44336;
      color: #fff;
    }

    .delete-btn:hover {
      background-color: #d32f2f;
    }
  </style>
</head>

<body>

  <section class="accounts">
    <h1 class="heading">Admin Account</h1>

    <div class="box-container">

      <div class="box">
        <h3>Admin Account</h3>
        <a href="admin_register.php" class="option-btns">Register Admin</a>
      </div>

      <?php

      $query = "SELECT * FROM `admins`";
      $result = mysqli_query($conn, $query);

      if ($result && mysqli_num_rows($result) > 0) {
        while ($fetch_accounts = mysqli_fetch_assoc($result)) {
      ?>
          <div class="box">
            <p> Admin ID : <span><?= $fetch_accounts['id']; ?></span> </p>
            <p> Admin Name : <span><?= htmlspecialchars($fetch_accounts['name']); ?></span> </p>
            <p>Email: <span><?= htmlspecialchars($fetch_accounts['email']); ?></span></p>
            <div class="flex-btn">
              <a href="admin_account.php?delete=<?= $fetch_accounts['id']; ?>"
                onclick="return confirm('Are you sure you want to delete this user?');"
                class="delete-btn">Delete</a>
              <a href="admin_update.php?update=<?= $fetch_accounts['id']; ?>"
                class="option-btn">Update</a>
            </div>
          </div>
      <?php
        }
      } else {
        echo "<script type='text/javascript'>
    alert('No accounts found.');
    </script>";
      }
      ?>
    </div>
  </section>

</body>

</html>