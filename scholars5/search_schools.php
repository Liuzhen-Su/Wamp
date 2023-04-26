<?php
    include 'config.php';

    $keyword = $_GET['keyword'];
    $feature = $_GET['feature'];

    if (!empty($keyword)) {
        $sql = "SELECT id, name FROM schools_info WHERE name LIKE '%$keyword%'";
    } elseif (!empty($feature)) {
        $sql = "SELECT id, name FROM schools_info WHERE $feature = 1";
    } else {
        $sql = "SELECT id, name FROM schools_info";
    }

    $result = $conn->query($sql);

    $output = array();
    while ($row = $result->fetch_assoc()) {
        array_push($output, $row);
    }

    echo json_encode($output);

    $conn->close();
?>
