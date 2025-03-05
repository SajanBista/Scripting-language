<?php
session_start(); // Start the session

// Set Session
if (isset($_POST['set_session'])) {
    $_SESSION["username"] = $_POST['name'];
}

// Delete Session
if (isset($_POST['delete_session'])) {
    session_unset();  // Unset session variables
    session_destroy(); // Destroy session
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP Session Example</title>
</head>
<body>

    <h2>Set Session</h2>
    <form method="post">
        <label>Enter Name: </label>
        <input type="text" name="name" required>
        <br><br>
        <button type="submit" name="set_session">Set Session</button>
    </form>

    <h2>Check Stored Session</h2>
    <p>
        <strong>Session:</strong> 
        <?php echo is
?>