<?php
require_once "db.php"; // 连接到你的数据库

$openid = isset($_POST["openid"]) ? $_POST["openid"] : "";

if ($openid) {
  $sql = "SELECT * FROM users WHERE openid = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $openid);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    echo json_encode(["status" => "logged_in"]);
  } else {
    echo json_encode(["status" => "not_logged_in"]);
  }
} else {
  echo json_encode(["status" => "error"]);
}
?>
