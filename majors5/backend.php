<?php
$servername = "localhost";
$username = "root";
$password = "sr19971008";
$dbname = "scholars";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");

switch ($_GET["function"]) {
    case "getDegreeTypes":
        getDegreeTypes($conn);
        break;
    case "getMajorCategories":
        getMajorCategories($conn, $_GET["degree"]);
        break;
    case "getFirstLevelSubjects":
        getFirstLevelSubjects($conn, $_GET["category"]);
        break;
    case "getMajors":
        getMajors($conn, $_GET["subject"]);
        break;
    case "searchMajors":
        searchMajors($conn, $_GET["query"]);
        break;
}

function getDegreeTypes($conn) {
    $sql = "SELECT DISTINCT name_degree FROM majors_info";
    $result = $conn->query($sql);

    $degreeTypes = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $degreeTypes[] = ["name_degree" => $row["name_degree"]];
        }
    }
    echo json_encode($degreeTypes);
}

function getMajorCategories($conn, $degree) {
    $sql = "SELECT DISTINCT name_type FROM majors_info WHERE name_degree = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $degree);
    $stmt->execute();
    $result = $stmt->get_result();

    $majorCategories = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $majorCategories[] = ["name_type" => $row["name_type"]];
        }
    }
    echo json_encode($majorCategories);
}

function getFirstLevelSubjects($conn, $category) {
    $sql = "SELECT DISTINCT name_first FROM majors_info WHERE name_type = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();

    $firstLevelSubjects = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $firstLevelSubjects[] = ["name_first" => $row["name_first"]];
        }
    }
    echo json_encode($firstLevelSubjects);
}

function getMajors($conn, $subject) {
    $sql = "SELECT name_major, id_major FROM majors_info WHERE name_first = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $subject);
    $stmt->execute();
    $result = $stmt->get_result();

    $majors = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $majors[] = ["name_major" => $row["name_major"], "id_major" => $row["id_major"]];
        }
    }
    echo json_encode($majors);
}

function searchMajors($conn, $query) {
    $sql = "SELECT name_major, id_major FROM majors_info WHERE name_major LIKE ?";
    $stmt = $conn->prepare($sql);
    $query = '%' . $query . '%';
    $stmt->bind_param("s", $query);
    $stmt->execute();
    $result = $stmt->get_result();

    $majors = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $majors[] = ["name_major" => $row["name_major"], "id_major" => $row["id_major"]];
        }
    }
    echo json_encode($majors);
}

$conn->close();
?>
