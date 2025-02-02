<?php

include '../include/connect.php';

if (isset($_POST['register'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $pass = $_POST['pass'];

  $query = "INSERT INTO admins (name,email,password) VALUES ('$name','$email','$pass')";
  $result = mysqli_query($conn, $query);

  if ($result) {
    echo "<script type='text/javascript'>
    alert('Registration Successfull.');
    window.location.href='admin_login.php';
    </script>";
  } else {
    echo "<script type='text/javascript'>
    alert('Registration UnSuccessfull.');
    window.location.href='admin_register.php';
    </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>

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
    /*Login page css*/
    .form-box {
      width: 100%;
      max-width: 400px;
      margin: 50px auto;
      padding: 20px;
      background-color: #f9f9f9;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      font-family: Arial, sans-serif;
    }

    .form-box .containers {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 20px;
    }

    .form-box .headings h5 {
      font-size: 1.5rem;
      color: #333;
      margin: 0;
      text-align: center;
    }

    .form-box .input input[type="email"],
    .form-box .input input[type="text"],
    .form-box .input input[type="password"] {
      width: 100%;
      padding: 10px;
      font-size: 1rem;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .form-box .input input[type="email"]:focus,
    .form-box .input input[type="text"]:focus,
    .form-box .input input[type="password"]:focus {
      border-color: #007bff;
      box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
      outline: none;
    }

    .form-box .input label {
      font-size: 0.9rem;
      color: #555;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .form-box .input input[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      font-size: 1rem;
      cursor: pointer;
    }

    .form-box .input input[type="submit"]:hover {
      background-color: #0056b3;
    }

    .form-box .input a {
      text-decoration: none;
    }

    .form-box .input a input[type="submit"] {
      width: 100%;
    }

    .register {
      margin-top: 20px;
    }

    .register a {
      color: black;
      padding: 4px;
    }

    u {
      font-weight: 600;
      text-decoration: none;
    }
  </style>
</head>

<body>

  <form action="" method="POST" class="form-box">
    <div class="containers">
      <div class="heading">
        <h5>Register Here</h5>
      </div>

      <div class="input">
        <input type="text" placeholder="Enter your name" id="name" name="name" required>
        <input type="email" placeholder="Enter your email" id="email" name="email" required> <br>
        <input type="password" placeholder="Enter your password" id="password" name="pass" required> <br>
        <a href="admin_dashboard.php"><input type="submit" value="Register" onclick="handleLogin()" name="register"></a>
        <p class="register"><a href="admin_login.php">Already have an account?<u> Login Here!</u></a></p>
      </div>
    </div>
  </form>

</body>

</html>