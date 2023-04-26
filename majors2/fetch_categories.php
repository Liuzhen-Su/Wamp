<?php
require 'config.php';

if (isset($_POST['degree'])) {
    $degree = $_POST['degree'];
    $sql = "SELECT DISTINCT name_type FROM majors_info WHERE name_degree = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $degree);
    $stmt->execute();
    $result = $stmt->get_result();

    $categories = array();
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($categories);
}
?>