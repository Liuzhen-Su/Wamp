<?php
include 'db.php';

$search_name = $_POST['search_name'];

$sql = "SELECT id, name, title, research FROM scholars_info WHERE name LIKE '%$search_name%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='row'>";
    while($row = $result->fetch_assoc()) {
        echo "<div class='col-md-4'>";
        echo "<div class='card mb-4'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'><a href='scholar_details.php?id=" . $row['id'] . "'>" . $row['name'] . "</a></h5>";
        echo "<p class='card-text'>" . $row['title'] . "</p>";
        echo "<p class='card-text'>" . $row['research'] . "</p>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "没有找到相关学者";
}

$conn->close();
