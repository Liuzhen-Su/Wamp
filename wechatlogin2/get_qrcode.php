<?php
$appID = "wx01c08a5eb491476b";
$appSecret = "ca9e431210bc837f0699a6b9fa39b849";
$accessTokenUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appID&secret=$appSecret";
$response = file_get_contents($accessTokenUrl);
$data = json_decode($response, true);

if (isset($data["access_token"])) {
  $accessToken = $data["access_token"];
  $qrcodeUrl = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=$accessToken";
  $expireSeconds = 600;
  $sceneId = rand(100000, 999999);
  $postData = '{"expire_seconds": ' . $expireSeconds . ', "action_name": "QR_SCENE", "action_info": {"scene": {"scene_id": ' . $sceneId . '}}}';
  $options = [
    'http' => [
      'header'  => "Content-type: application/json\r\n",
      'method'  => 'POST',
      'content' => $postData
    ]
  ];
  $context = stream_context_create($options);
  $response = file_get_contents($qrcodeUrl, false, $context);
  $data = json_decode($response, true);

  if (isset($data['ticket'])) {
    $ticket = urlencode($data['ticket']);
    $qrcodeUrl = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=$ticket";
    echo json_encode(["status" => "success", "qrcode_url" => $qrcodeUrl]);
  } else {
    echo json_encode(["status" => "error"]);
  }
} else {
  echo json_encode(["status" => "error"]);
}
?>

  