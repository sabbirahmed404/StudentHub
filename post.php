<?php
session_start();
include 'config.php';

if (!isset($_SESSION['student_id'])) {
    header("Location: login_signup.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_SESSION['student_id'];
    $text = $_POST['text'];
    $club_name = $_POST['club_name']; // Get the club name from the form input
    $media = '';

    if (isset($_FILES['media']) && $_FILES['media']['error'] == UPLOAD_ERR_OK) {
        $media = 'uploads/' . basename($_FILES['media']['name']);
        move_uploaded_file($_FILES['media']['tmp_name'], $media);
    }

    $sql = "INSERT INTO post (student_id, text, media, club_name, created_at) VALUES (?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $student_id, $text, $media, $club_name);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Failed to post. Please try again.";
    }
} else {
    header("Location: index.php");
    exit();
}
