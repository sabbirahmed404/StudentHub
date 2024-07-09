<?php
include 'config.php';

$sql = "SELECT * FROM post ORDER BY created_at DESC";
$result = $conn->query($sql);

$posts = [];
while ($row = $result->fetch_assoc()) {
    $posts[] = $row;
}

echo json_encode($posts);
?>
