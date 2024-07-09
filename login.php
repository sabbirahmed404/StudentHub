<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE StudentID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['Password'])) {
        $_SESSION['student_id'] = $user['StudentID'];
        echo "<script>alert('Login successful!'); window.location.href='index.php';</script>";
        exit();
    } else {
        echo "<script>alert('Invalid Student ID or Password'); window.location.href='login_signup.html';</script>";
        exit();
    }
} else {
    header("Location: login_signup.html");
    exit();
}
?>
