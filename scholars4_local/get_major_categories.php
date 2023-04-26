<?php
// Connect to database
include 'db.php';

$degree = $_GET['degree'];
$sql = "SELECT DISTINCT name_type FROM majors_info_2 WHERE name_degree = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $degree);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $major_category = $row["name_type"];
    echo "<button type='button' class='btn btn-outline-primary' onclick='loadDisciplines(\"$major_category\")'>$major_category</button>";
}

$stmt->close();
$conn->close();
?>
