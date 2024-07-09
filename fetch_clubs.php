<?php
include 'config.php';

$sql = "SELECT id, club_name AS name, members, club_logo AS logo FROM clubs";
$result = $conn->query($sql);

$clubs = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $clubs[] = $row;
    }
}

echo json_encode($clubs);

$conn->close();
?>
