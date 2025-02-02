<?php

include '../include/connect.php';

session_start();

$admin_id = isset($_SESSION['admin_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Login'])) {
  $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
  $pass = isset($_POST['pass']) ? $_POST['pass'] : '';

  $query = "SELECT * from admins where email='$email' and password='$pass'";
  $result = mysqli_query($conn, $query);

  if (!$result) {
    echo "Error: " . mysqli_error($conn);
  }
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
    if (!empty($_POST['Remember_Me'])) {
      setcookie('email', $email, time() + 60 * 60 * 24 * 30);
      setcookie('pass', $pass, time() + 60 * 60 * 24 * 30);
    } else {
      setcookie('email', "", time() + 60 * 60 * 24 * 30);
      setcookie('pass', "", time() + 60 * 60 * 24 * 30);
    }

    echo "<script type='text/javascript'>
        alert('Login Successful.');
        window.location.href='admin_dashboard.php';
    </script>";
    exit;
  } else {
    echo "<script type='text/javascript'>
        alert('Login Failed');
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
  <title>Login</title>

  <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

  <link rel="stylesheet" href="../css/admin_part.css">
  <script src="js/script.js"></script>

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

  <form action="admin_login.php" method="POST" class="form-box">
    <div class="containers">
      <div class="heading">
        <h5>Login Now</h5>
      </div>


      <div class="input">
        <input
          type="email"
          name="email"
          id="email"
          placeholder="Enter your email"
          value="<?php echo isset($_COOKIE['email']) ? htmlspecialchars($_COOKIE['email']) : ''; ?>"
          required>

        <input
          type="password"
          name="pass"
          id="password"
          placeholder="Enter your password"
          value="<?php echo isset($_COOKIE['pass']) ? htmlspecialchars($_COOKIE['pass']) : ''; ?>"
          required>
        <br>
        <label>
          <input
            type="checkbox"
            id="rememberMe"
            name="Remember_Me"
            <?php echo isset($_COOKIE['email']) ? 'checked' : ''; ?>> Remember Me
        </label>
        <br>
        <input type="submit" value="Login" name="Login">
        <p class="register"><a href="admin_register.php">Don't have an account?<u> Register Here!</u></a></p>
      </div>
    </div>
  </form>

</body>

</html>

</html>