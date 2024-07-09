<?php
include 'config.php';

$club_id = $_GET['id'];
$sql = "SELECT * FROM clubs WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $club_id);
$stmt->execute();
$result = $stmt->get_result();

$club = $result->fetch_assoc();

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $club['club_name']; ?> Profile</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div style="background:rgb(93, 128, 108);padding:5px">
        <h2 style="text-align:center; color: #ffffff;">GREEN UNIVERSITY OF BANGLADESH</h2>
    </div>
    <div class="header" style="background-image: url('Student\ HUB.png');">
        <h1>Student HUB</h1>
        <p>Connecting <b>Students</b> of <b>Green University of Bangladesh</b> through <b>Institutes</b>.</p>
    </div>
    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="registration.html">Register</a>
        <a href="clubs.html" style="background-color: #ffffff; color: #333;">Club Lists</a>
        <a href="login_signup.html">Club Login</a>
    </div>
    <div class="row">
        <div class="main">
            <h2><?php echo $club['club_name']; ?> Profile</h2>
            <div class="profile-container">
                <img src="<?php echo $club['club_logo'] ? 'uploads/' . $club['club_logo'] : 'placeholder.png'; ?>" alt="<?php echo $club['club_name']; ?> Logo">
                <div>
                    <p><strong>Club Name:</strong> <?php echo $club['club_name']; ?></p>
                    <p><strong>Members:</strong> <?php echo $club['members']; ?></p>
                </div>
            </div>
            <div class="profile-details">
                <p><strong>Contact Number:</strong> <?php echo $club['contact_number']; ?></p>
                <p><strong>Club Email:</strong> <?php echo $club['club_email']; ?></p>
                <p><strong>Responsible Person:</strong> <?php echo $club['responsible_person']; ?></p>
                <p><strong>Student ID:</strong> <?php echo $club['Student_ID']; ?></p>
                <p><strong>Department:</strong> <?php echo $club['department']; ?></p>
                <p><strong>Designation:</strong> <?php echo $club['designation']; ?></p>
            </div>
        </div>
    </div>
    <div class="footer">
      <h2>Made By Sabbir Ahmed</h2>
      <a href="https://github.com/sabbirahmed404"><img src="25231.png" alt="Sabbir Ahmed's Github" style="width:42px;height:42px;"></a>
      <a href="https://www.linkedin.com/in/msabbir-ahmed/"><img src="linkedin.png" alt="Sabbir Ahmed's Linkedin" style="width:42px;height:42px;"></a>

    </div>
</body>
</html>