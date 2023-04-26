<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

$servername = "localhost";
$username = "root";
$password = "sr19971008";
$dbname = "scholars";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("连接失败: " . $conn->connect_error);
}

$action = $_GET['action'];

switch ($action) {
  case 'getDegree':
    getDegree($conn);
    break;
  case 'getCategory':
    getCategory($conn);
    break;
  case 'getFirstLevel':
    getFirstLevel($conn);
    break;
  case 'searchMajors':
    searchMajors($conn);
    break;
  default:
    echo json_encode(['error' => '无效的操作']);
}

function getDegree($conn) {
  $sql = "SELECT DISTINCT name_degree FROM majors_info";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $degrees = [];
    while ($row = $result->fetch_assoc()) {
      $degrees[] = $row;
    }
    echo json_encode($degrees);
  } else {
    echo json_encode(['error' => '未找到任何学位种类']);
  }
}

function getCategory($conn) {
  $degree = $_GET['degree'];
  $sql = "SELECT DISTINCT name_type FROM majors_info WHERE name_degree = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $degree);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $categories = [];
    while ($row = $result->fetch_assoc()) {
      $categories[] = $row;
    }
    echo json_encode($categories);
  } else {
    echo json_encode(['error' => '未找到任何大类']);
  }
}

function getFirstLevel($conn) {
  $degree = $_GET['degree'];
  $category = $_GET['category'];
  $sql = "SELECT DISTINCT name_first FROM majors_info WHERE name_degree = ? AND name_type = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $degree, $category);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $firstLevels = [];
    while ($row = $result->fetch_assoc()) {
      $firstLevels[] = $row;
    }
    echo json_encode($firstLevels);
  } else {
    echo json_encode(['error' => '未找到任何一级学科']);
  }
}

function searchMajors($conn) {
  $degree = $_GET['degree'];
  $category = $_GET['category'];
  $firstLevel = $_GET['firstLevel'];
  $sql = "SELECT * FROM majors_info WHERE name_degree = ? AND name_type = ? AND name_first = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sss", $degree, $category, $firstLevel);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $majors = [];
    while ($row = $result->fetch_assoc()) {
      $majors[] = $row;
    }
    echo json_encode($majors);
  } else {
    echo json_encode(['error' => '未找到任何专业']);
  }
}

$conn->close();
?>
