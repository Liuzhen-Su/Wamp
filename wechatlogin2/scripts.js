function showMessage(message) {
  $("#message").text(message).removeClass("hidden");
  setTimeout(function () {
    $("#message").addClass("hidden");
  }, 3000);
}

function showMoreInfo() {
  $("#qrcode-popup").css("display", "none");
  $("#content").html("<p>苏柳桢曾担任博立科技人工智能算法工程师，在深度学习、数据分析与挖掘、知识图谱、网站开发与运维、等方面有丰富的研发经验。</p>");
}

function checkLoginStatus() {
  $.ajax({
    url: "check_login.php",
    dataType: "json",
    method: "POST",
    success: function (data) {
      if (data.status === "logged_in") {
        showMoreInfo();
      } else {
        setTimeout(checkLoginStatus, 3000);
      }
    },
    error: function () {
      showMessage("登录检查失败");
    },
  });
}

$("#login-btn").on("click", function () {
  $.ajax({
    url: "get_qrcode.php",
    dataType: "json",
    success: function (data) {
      if (data.status === "success") {
        $("#qrcode").attr("src", data.qrcode_url);
        $("#qrcode-popup").css("display", "block");
        setTimeout(checkLoginStatus, 3000);
      } else {
        showMessage("获取二维码失败");
      }
    },
    error: function () {
      showMessage("获取二维码失败");
    },
  });
});
