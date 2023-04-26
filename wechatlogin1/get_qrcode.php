<?php
require_once 'config.php';

function getAccessToken() {
  global $appId, $appSecret;
  
  $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appId}&secret={$appSecret}";
  $response = file_get_contents($url);
  $data = json_decode($response, true);

  if (isset($data['access_token'])) {
    return $data['access_token'];
  } else {
    return false;
  }
}

function getQRCodeUrl($accessToken) {
  $url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token={$accessToken}";
  $postData = json_encode([
    "expire_seconds" => 2592000,
    "action_name" => "QR_STR_SCENE",
    "action_info" => [
      "scene" => [
        "scene_str" => "login"
      ]
    ]
  ]);

  $options = [
    'http' => [
      'method' => 'POST',
      'header' => 'Content-Type: application/json',
      'content' => $postData
    ]
  ];
  $context = stream_context_create($options);
  $response = file_get_contents($url, false, $context);
  $data = json_decode($response, true);

  if (isset($data['ticket'])) {
    return "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=" . urlencode($data['ticket']);
  } else {
    return false;
  }
}

$accessToken = getAccessToken();
if ($accessToken) {
  $qrcodeUrl = getQRCodeUrl($accessToken);
  if ($qrcodeUrl) {
    echo json_encode(["status" => "success", "qrcode_url" => $qrcodeUrl]);
  } else {
    echo json_encode(["status" => "error", "message" => "无法获取二维码"]);
  }
} else {
  echo json_encode(["status" => "error", "message" => "无法获取访问令牌"]);
}
?>