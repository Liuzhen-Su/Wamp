<?php
header('Content-Type: application/json');
require_once 'config.php'; // 在这个文件中定义数据库连接信息

$data = json_decode(file_get_contents('php://input'), true);

switch ($data['action']) {
    case 'search':
        echo json_encode(searchMajors(data['searchTerm'], $connection));
        break;
    case 'fetch_categories':
        echo json_encode(fetchCategories($data['degree'], $connection));
        break;
    case 'fetch_subjects':
        echo json_encode(fetchSubjects($data['degree'], $data['category'], $connection));
        break;
    case 'fetch_majors':
        echo json_encode(fetchMajors($data['degree'], $data['subject'], $connection));
        break;
}

function searchMajors($searchTerm, $connection) {
    $sql = "SELECT name_major, id_major, school_list FROM majors_info WHERE name_major LIKE ?";
    $stmt = $connection->prepare($sql);
    $searchTerm = '%' . $searchTerm . '%';
    $stmt->bind_param('s', $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function fetchCategories($degree, $connection) {
    $sql = "SELECT DISTINCT name_type FROM majors_info WHERE name_degree = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('s', $degree);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function fetchSubjects($degree, $category, $connection) {
    $sql = "SELECT DISTINCT name_first FROM majors_info WHERE name_degree = ? AND name_type = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('ss', $degree, $category);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function fetchMajors($degree, $subject, $connection) {
    $sql = "SELECT name_major, id_major FROM majors_info WHERE name_degree = ? AND name_first = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('ss', $degree, $subject);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}
?>
