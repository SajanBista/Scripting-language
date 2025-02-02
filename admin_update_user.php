<?php
include '../include/connect.php';
session_start();

// if (!isset($_SESSION['admin_id'])) {
//   echo "<script>alert('Access Denied! Please log in as admin.');</script>";
//   header('location: admin_login.php');
//   exit;
// }

if (isset($_GET['update'])) {
  $user_id = intval($_GET['update']);
} else {
  echo "<script>alert('No user selected for update!');</script>";
  header('location: admin_user.php');
  exit;
}

$fetch_user_query = "SELECT * FROM `users` WHERE id='$user_id'";
$fetch_user_result = mysqli_query($conn, $fetch_user_query);

if (!$fetch_user_result || mysqli_num_rows($fetch_user_result) == 0) {
  echo "<script>alert('User not found!');</script>";
  header('location: admin_user.php');
  exit;
}

$user_data = mysqli_fetch_assoc($fetch_user_result);

if (isset($_POST['update_user'])) {
  $name = htmlspecialchars(trim($_POST['name']));
  $email = htmlspecialchars(trim($_POST['email']));

  $update_query = "UPDATE `users` SET name='$name', email='$email' WHERE id='$user_id'";
  if (mysqli_query($conn, $update_query)) {
    echo "<script>alert('User details updated successfully.');</script>";
    header('location: admin_user.php');
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
  <title>Update User</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

  <style>
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f8f9fa;
    }

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

    .form-container .back-btn {
      text-align: center;
      margin-top: 20px;
    }

    .form-container .back-btn a {
      text-decoration: none;
      color: #007bff;
      font-size: 16px;
    }

    .form-container .back-btn a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <section class="form-container">
    <form action="" method="POST">
      <h2>Update User</h2>
      <input type="text" name="name" required placeholder="Enter new username" maxlength="50" class="box" value="<?= htmlspecialchars($user_data['name']); ?>">
      <input type="email" name="email" required placeholder="Enter new email" maxlength="100" class="box" value="<?= htmlspecialchars($user_data['email']); ?>">
      <button type="submit" name="update_user" class="btn">Update</button>
    </form>
    <div class="back-btn">
      <a href="admin_user.php">&larr; Back to User Management</a>
    </div>
  </section>
</body>

</html>