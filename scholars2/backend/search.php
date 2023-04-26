<?php
// search.php

require_once "config/db_config.php";

function searchScholarsByName($name) {
    $connection = connectToDatabase();
    $stmt = $connection->prepare("SELECT * FROM scholars WHERE name LIKE ?");
    $name = '%' . $name . '%';
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();
    $scholars = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $connection->close();
    return $scholars;
}

function searchSchoolsByName($name) {
    $connection = connectToDatabase();
    $stmt = $connection->prepare("SELECT * FROM schools WHERE name LIKE ?");
    $name = '%' . $name . '%';
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();
    $schools = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $connection->close();
    return $schools;
}

function searchSchoolsByFeature($feature) {
    $connection = connectToDatabase();
    $stmt = $connection->prepare("SELECT * FROM schools WHERE " . $feature . " = 1");
    $stmt->execute();
    $result = $stmt->get_result();
    $schools = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $connection->close();
    return $schools;
}

header("Content-Type: application/json");
$action = $_GET["action"] ?? "";

switch ($action) {
    case "search_scholars":
        $name = $_GET["name"] ?? "";
        $scholars = searchScholarsByName($name);
        echo json_encode($scholars);
        break;
    // 你可以根据需要添加其他 case 以处理不同的请求
    default:
        http_response_code(400);
        echo json_encode(["error" => "Invalid action."]);
        break;
}

