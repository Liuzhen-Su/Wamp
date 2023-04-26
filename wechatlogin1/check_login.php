<?php
require_once 'config.php';
require_once 'db.php';

if (isset($_GET['openid'])) {
  $openid = $_GET['openid'];

  $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

  if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
  }

  $sql = "SELECT * FROM users WHERE openid = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $openid);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    echo json_encode(["status" => "success", "logged_in" => true]);
  } else {
    echo json_encode(["status" => "success", "logged_in" => false]);
  }

  $stmt->close();
  $conn->close();
} else {
  echo json_encode(["status" => "error", "message" => "缺少openid参数"]);
}
?>