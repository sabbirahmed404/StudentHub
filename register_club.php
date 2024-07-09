<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $club_name = $_POST['club_name'];
    $members = $_POST['members'];
    $club_email = $_POST['club_email'];
    $contact_number = $_POST['contact_number'];
    $responsible_person = $_POST['responsible_person'];
    $Student_ID = $_POST['Student_ID'];
    $department = $_POST['department'];
    $designation = $_POST['designation'];
    
    // Handle file upload
    if ($_FILES['club_logo']['name']) {
        $club_logo = $_FILES['club_logo']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($club_logo);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Check file size (must be under 100 KB)
        if ($_FILES["club_logo"]["size"] > 100000) {
            echo "Sorry, your file is too large.";
            exit;
        }
        
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "Sorry, only JPG, JPEG & PNG files are allowed.";
            exit;
        }
        
        // Check if file upload was successful
        if (!move_uploaded_file($_FILES["club_logo"]["tmp_name"], $target_file)) {
            echo "Sorry, there was an error uploading your file.";
            exit;
        }
    } else {
        $club_logo = null; // No file uploaded
    }

    $sql = "INSERT INTO clubs (club_name, members, club_email, contact_number, club_logo, responsible_person, Student_ID, department, designation) 
            VALUES ('$club_name', '$members', '$club_email', '$contact_number', '$club_logo', '$responsible_person', '$Student_ID', '$department', '$designation')";

    if ($conn->query($sql) === TRUE) {
        echo "New club registered successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
