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

$discipline = $_GET['discipline'];
$sql = "SELECT id, name_major, id_major FROM majors_info_2 WHERE name_first = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $discipline);
$stmt->execute();
$result = $stmt->get_result();

echo "<table class='table'>";
echo "<thead><tr><th>专业名称</th><th>专业代码</th><th>操作</th></tr></thead>";
echo "<tbody>";
while ($row = $result->fetch_assoc()) {
    $id = $row["id"];
    $name_major = $row["name_major"];
    $id_major = $row["id_major"];
    echo "<tr><td>$name_major</td><td>$id_major</td><td><button class='btn btn-primary' onclick='viewSchools($id)'>查看</button></td></tr>";
}
echo "</tbody>";
echo "</table>";

$stmt->close();
$conn->close();
?>
