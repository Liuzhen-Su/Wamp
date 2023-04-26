<?php
    include 'config.php';

    $scholar_id = $_GET['id'];

    $sql = "SELECT * FROM scholars_info WHERE id = $scholar_id";
    $result = $conn->query($sql);

    $output = array();
    if ($row = $result->fetch_assoc()) {
        $output = $row;
    }

    echo json_encode($output);

    $conn->close();
?>
