<?php
require 'config.php';

if (isset($_POST['searchQuery'])) {
    $searchQuery = $_POST['searchQuery'];
    $sql = "SELECT name_second, id_second FROM majors_info WHERE name_second LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $searchQuery);
    $stmt->execute();
    $result = $stmt->get_result();

    $majors = array();
    while ($row = $result->fetch_assoc()) {
        $majors[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($majors);
}
?>