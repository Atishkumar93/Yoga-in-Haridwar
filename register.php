<?php

// MySQLi Database Connection
$conn = new mysqli("localhost", "root", "", "haridwar");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve and sanitize input
    $user_id = $_POST['user_id'];
    $name    = $conn->real_escape_string($_POST['name']);
    $mobile  = $conn->real_escape_string($_POST['mobile']);
    $address = $conn->real_escape_string($_POST['address']);

    // Simple validation (optional but recommended)
    // if (!preg_match("/^[0-9]{10}$/", $mobile)) {
    //     die("Invalid mobile number. It should be 10 digits.");
    // }

    // Prepare the SQL insert statement
    $stmt = $conn->prepare("INSERT INTO register ( name, mobile, address) VALUES ( ?, ?, ?)");
    $stmt->bind_param("sss",  $name, $mobile, $address);

    // Execute and check result
   
if ($stmt->execute()) {
    echo "<script>
        alert('Registration Successful');
        window.location.href = '/Project.Html/yoga.websitelayout.net/yoga.websitelayout.net/index.html';
    </script>";
    exit(); // Always call exit after echoing JavaScript in PHP



    } else {
        echo "❌ Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>

