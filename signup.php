<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        echo "<script>alert('Please fill in both the username and password.'); window.location.href='signup.html';</script>";
        exit();
    }

    // Check if username already exists
    $sql_check = "SELECT * FROM user WHERE username = ?";
    $stmt_check = $conn->prepare($sql_check);
    if (!$stmt_check) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt_check->bind_param("s", $username);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // Username exists
        echo "<script>alert('Username already exists. Please choose a different username.'); window.location.href='signup.html';</script>";
        $stmt_check->close();
        $conn->close();
        exit();
    }
    $stmt_check->close();

    // Insert new user with plain password
    $sql_insert = "INSERT INTO user (username, password) VALUES (?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    if (!$stmt_insert) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt_insert->bind_param("ss", $username, $password);
    
    if ($stmt_insert->execute()) {
        echo "<script>alert('Account created successfully! You can now log in.'); window.location.href='login.html';</script>";
    } else {
        echo "<script>alert('Error creating account. Please try again later.'); window.location.href='signup.html';</script>";
    }

    $stmt_insert->close();
}

$conn->close();
?>
