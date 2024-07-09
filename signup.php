<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $profile_picture = '';

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == UPLOAD_ERR_OK) {
        $profile_picture = 'uploads/' . basename($_FILES['profile_picture']['name']);
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profile_picture);
    }

    $sql = "INSERT INTO user (StudentID, Name, Email, Department, Contact, Address, ProfilePicture, Password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $student_id, $name, $email, $department, $contact, $address, $profile_picture, $password);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['error'] = "Failed to register. Please try again.";
        header("Location: login_signup.html");
        exit();
    }
} else {
    header("Location: login_signup.html");
    exit();
}
?>
