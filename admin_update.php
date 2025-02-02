<?php
include '../include/connect.php';
session_start();

$admin_id = isset($_SESSION['admin_id']);

if (isset($_GET['update'])) {
  $admin_id = intval($_GET['update']);
} else {
  echo "<script>
    alert('No user selected for update!');
  </script>";
  header('location: admin_account.php');
  exit;
}

$query = "SELECT * FROM admins WHERE id='$admin_id'";
$result = mysqli_query($conn, $query);
if (!$result || mysqli_num_rows($result) == 0) {
  echo "<script>alert('Admin not found!');</script>";
  header('location: admin_account.php');
  exit;
}

$admin_data = mysqli_fetch_assoc($result);

if (isset($_POST['update_admin'])) {
  $name = htmlspecialchars(trim($_POST['name']));
  $email = htmlspecialchars(trim($_POST['email']));

  $query = "UPDATE `admins` SET name='$name', email='$email' WHERE id='$admin_id'";
  if (mysqli_query($conn, $query)) {
    echo "<script>alert('Admin details updated successfully.');</script>";
    header('location: admin_account.php');
    exit;
  } else {
    echo "<script>alert('Error updating user: " . mysqli_error($conn) . "');</script>";
  }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Profile</title>

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
    .form-container {
      max-width: 500px;
      margin: 50px auto;
      padding: 30px;
      background-color: #fff;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
    }

    .form-container h2 {
      text-align: center;
      font-size: 24px;
      margin-bottom: 20px;
      color: #333;
    }

    .form-container .box {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 5px;
      outline: none;
    }

    .form-container .box:focus {
      border-color: #4CAF50;
      box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
    }

    .form-container .btn {
      width: 100%;
      padding: 12px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .form-container .btn:hover {
      background-color: #45a049;
    }
  </style>
</head>

<body>
  <section class="form-container">
    <form action="" method="POST">
      <h2>Update Profile</h2>
      <input type="text" name="name" required placeholder="Enter new username" maxlength="50" class="box" value="<?= htmlspecialchars($admin_data['name']); ?>">
      <input type="email" name="email" required placeholder="Enter new email" maxlength="100" class="box" value="<?= htmlspecialchars($admin_data['email']); ?>">
      <button type="submit" name="update_admin" class="btn">Update</button>
    </form>
  </section>
</body>

</html>