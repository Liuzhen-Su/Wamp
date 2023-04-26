<?php
// Connect to database
$servername = "localhost";
$username = "root";
$password = "sr19971008";
$dbname = "scholars";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$major_category = $_GET['major_category'];
$sql = "SELECT DISTINCT name_first FROM majors_info_2 WHERE name_type = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $major_category);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $discipline = $row["name_first"];
    echo "<button type='button' class='btn btn-outline-primary' onclick='loadMajors(\"$discipline\")'>$discipline</button>";
}

$stmt->close();
$conn->close();
?>
