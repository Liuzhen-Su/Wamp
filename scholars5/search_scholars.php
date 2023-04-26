<?php
    include 'config.php';

    $keyword = $_GET['keyword'];

    $sql = "SELECT id, name, title, research FROM scholars_info WHERE name LIKE '%$keyword%'";
    $result = $conn->query($sql);

    $output = array();
    while($row = $result->fetch_assoc()) {
        array_push($output, $row);
    }

    echo json_encode($output);

    $conn->close();
?>
