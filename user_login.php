<?php
include 'include/connect.php';

session_start();

// LOGIN LOGIC
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $pass = $_POST['pass']; // Retrieve and sanitize email
    $pass = htmlspecialchars(trim($_POST['pass'])); // Retrieve and sanitize password

    $query = "SELECT * FROM `users` WHERE email='$email' AND password='$pass'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['id'];
        header('Location: index.php');
        exit;
    } else {
        echo "<script>alert('Invalid email or password.');</script>";
    }
}

// REGISTRATION LOGIC
if (isset($_POST['submits'])) {
    $name = $_POST['name'];
    $name = htmlspecialchars(trim($_POST['name']));   // Retrieve and sanitize name
    $email = $_POST['email'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // Retrieve and sanitize email
    $pass = $_POST['pass'];
    $pass = htmlspecialchars(trim($_POST['pass']));
    $cpass = $_POST['cpass'];
    $cpass = htmlspecialchars(trim($_POST['cpass']));

    if ($pass != $cpass) {
        echo "<script>alert('Passwords do not match!');
        </script>";
    } else {
        // Check if email already exists
        $query = "SELECT * FROM `users` WHERE email='$email'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            echo "<script>alert('Email already exists.');</script>";
        } else {
            // Insert new user into the database
            $query = "INSERT INTO `users` (name, email, password) VALUES ('$name', '$email', '$pass')";
            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Registered successfully.');</script>";
                header('Location: user_login.php'); // Redirect to login page after registration
                exit;
            } else {
                echo "<script>alert('Error occurred while registering.');</script>";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="css/user_login.css">
</head>

<body>
    <div id="main" class="container">
        <div class="sign-up">
            <form action="#" method="post">
                <h1>Create new account</h1><br>
                <input type="text" name="name" id="name" placeholder="Name">
                <input type="email" name="email" id="email" placeholder=" Email">
                <input type="password" name="pass" id="password" placeholder=" Password">
                <input type="password" name="cpass" id="confirm_password" placeholder="Confirm Password">
                <br> <br>
                <button name="submits"> sign up </button>
            </form>
        </div>
        <div class="Login">
            <form action="#" method="post">
                <h1>Login Page</h1>
                <br>
                <input type="email" name="email" id="email" placeholder="E-mail">
                <input type="password" name="pass" id="password" placeholder="Password">
                <br><br>
                <button type="submit" name="submit">Login</button>
                <a href="#">Forgot your Password??</a>
            </form>
        </div>


        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>
                        To keep connected with us please Login with your personal info
                    </p>
                    <button class="ghost" id="signIn">Login</button>
                </div>

                <div class="overlay-panel overlay-right">
                    <h1>New Here?</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="sign-up">sign up</button>
                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript">
        const Registerbutton = document.getElementById('sign-up');
        const signInbutton = document.getElementById('signIn');
        const main = document.getElementById('main');

        Registerbutton.addEventListener('click', () => {
            main.classList.add("right-panel-active")
        });
        signInbutton.addEventListener('click', () => {
            main.classList.remove("right-panel-active")
        });
    </script>

</body>

</html>