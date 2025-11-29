<?php
session_start();
include("connect.php");

if (isset($_POST['signup'])) {
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];
    $phone    = trim($_POST['phone']);

    if (empty($username) || empty($email) || empty($password) || empty($phone)) {
        $_SESSION['reg_error'] = "All fields are required.";
        header("Location: index.php");
        exit;
    }

    // Check duplicates
    $stmt = $conn->prepare("SELECT id FROM users WHERE username=? OR email=? OR phone=?");
    $stmt->bind_param("sss", $username, $email, $phone);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['reg_error'] = "Username, email, or phone already taken.";
        header("Location: index.php");
        exit;
    }

    // Insert new user
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, phone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $hash, $phone);

    if ($stmt->execute()) {
        $_SESSION['reg_success'] = "Registration successful. You can log in now.";
    } else {
        $_SESSION['reg_error'] = "Registration failed. Please try again.";
    }

    header("Location: index.php");
    exit;
}