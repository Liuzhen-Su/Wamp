<?php
require 'config.php';

if (isset($_POST['category'])) {
    $category = $_POST['category'];
    $sql = "SELECT DISTINCT name_first FROM majors_info WHERE name_type = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();

    $subjects = array();
    while ($row = $result->fetch_assoc()) {
        $subjects[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($subjects);
}
?>