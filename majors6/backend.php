<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");

$servername = "localhost";
$username = "root";
$password = "sr19971008";
$dbname = "scholars";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");

$action = isset($_GET["action"]) ? $_GET["action"] : "";

switch ($action) {
    case "getDegreeTypes":
        $sql = "SELECT DISTINCT name_degree FROM majors_info";
        break;
    case "getCategories":
        $degree = isset($_GET["degree"]) ? $_GET["degree"] : "";
        $sql = "SELECT DISTINCT name_type FROM majors_info WHERE name_degree = '$degree'";
        break;
    case "getFirstLevels":
        $category = isset($_GET["category"]) ? $_GET["category"] : "";
        $sql = "SELECT DISTINCT name_first FROM majors_info WHERE name_type = '$category'";
        break;
    case "getMajors":
        $firstLevel = isset($_GET["firstLevel"]) ? $_GET["firstLevel"] : "";
        $sql = "SELECT name_major, id_major FROM majors_info WHERE name_first = '$firstLevel'";
        break;
    default:
        echo json_encode(["error" => "Invalid action"]);
        exit;
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $output = [];
    while($row = $result->fetch_assoc()) {
        $output[] = $row;
    }
    echo json_encode($output);
} else {
    echo json_encode([]);
}

$conn->close();
?>
