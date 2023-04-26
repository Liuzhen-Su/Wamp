<?php
require 'config.php';

if (isset($_POST['subject'])) {
    $subject = $_POST['subject'];
    $sql = "SELECT name_second, id_second FROM majors_info WHERE name_first = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $subject);
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