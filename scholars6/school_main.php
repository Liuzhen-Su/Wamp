<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $school_id = $_POST["school_id"];
    $sql_colleges = "SELECT DISTINCT college FROM scholars_info WHERE school = '$school_id'";
    $result_colleges = $conn->query($sql_colleges);

    if ($result_colleges->num_rows > 0) {
        // 输出学院列表
        while ($row_college = $result_colleges->fetch_assoc()) {
            // 根据查询结果输出学院名称
        }
    } else {
        echo "该学校暂无学院信息";
    }

    // 获取选中的学院信息
    $selected_college = $_POST["selected_college"];

    if (!empty($selected_college)) {
        $sql_scholars = "SELECT * FROM scholars_info WHERE school = '$school_id' AND college = '$selected_college'";
        $result_scholars = $conn->query($sql_scholars);

        if ($result_scholars->num_rows > 0) {
            // 输出学者列表
            while ($row_scholar = $result_scholars->fetch_assoc()) {
                // 根据查询结果输出学者名称和职称
            }
        } else {
            echo "该学院暂无学者信息";
        }
    }
}
$conn->close();
?>
