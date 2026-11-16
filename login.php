<?php
session_start();
ob_start();

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Validate input
    if (empty($username) || empty($password)) {
        echo "<script>alert('Please fill in both the username and password.'); window.location.href='login.html';</script>";
        exit();
    }

    // Check if username exists
    $sql = "SELECT * FROM user WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stored_password = $row['password'];

        // Debugging: Check if we are getting the password correctly
        echo "<script>console.log('Stored Password: " . $stored_password . "');</script>";
        echo "<script>console.log('Entered Password: " . $password . "');</script>";

        // Compare plain text password
        if ($password === $stored_password) {
            $_SESSION['username'] = $username;
            echo "<script>window.location.href='homepage.html';</script>";
            exit();
        } else {
            echo "<script>alert('Invalid username or password.'); window.location.href='login.html';</script>";
        }
    } else {
        echo "<script>alert('Invalid username or password.'); window.location.href='login.html';</script>";
    }

    $stmt->close();
}

$conn->close();
ob_end_flush();
?>
