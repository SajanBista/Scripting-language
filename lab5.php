<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
    // Check if any field is empty
    if (empty($name) || empty($email) || empty($message)) {
        echo "<p>No data submitted. Please fill in all fields.</p>";
    } else {
        // Display the submitted data
        echo "<h2>Quotation Submitted</h2>";
        echo "<p><strong>Name:</strong> " . $name . "</p>";
        echo "<p><strong>Email:</strong> " . $email . "</p>";
        echo "<p><strong>Message:</strong> " . $message . "</p>";
    }
} else {
    // In case the form is not submitted, display a message
    echo "<p>No data submitted.</p>";
}
?>
