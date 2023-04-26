<?php
    include 'config.php';

    $school_id = $_GET['id'];

    $sql = "SELECT * FROM schools_info WHERE id = $school_id";
    $result = $conn->query($sql);

    $output = array();
    if ($row = $result->fetch_assoc()) {
        $output['info'] = $row;
    }

    $sql = "SELECT DISTINCT college FROM scholars_info WHERE school = '$output[info][name]'";
    $result = $conn->query($sql);

    $output['colleges'] = array();
    while ($row = $result->fetch_assoc()) {
        array_push($output['colleges'], $row);
    }

    $sql = "SELECT id, name, title, college FROM scholars_info WHERE school = '$output[info][name]'";
    $result = $conn->query($sql);

    $output['scholars'] = array();
    while ($row = $result->fetch_assoc()) {
        array_push($output['scholars'], $row);
    }

    echo json_encode($output);

    $conn->close();
?>
