$(document).ready(function() {
    $("#login").click(function() {
      $.ajax({
        url: "get_qrcode.php",
        dataType: "json",
        success: function(data) {
          if (data.status === "success") {
            $("#qrcode").attr("src", data.qrcode_url);
            $("#qrcode-popup").removeClass("hidden");
          }
        }
      });
    });
  });
  
  function showMessage(message) {
    // 在这里实现你喜欢的提示信息方式，例如使用alert()或在页面上显示一个提示框
    alert(message);
  }
  
  function showMoreInfo() {
    $("#more-info").removeClass("hidden");
    $("#qrcode-popup").addClass("hidden");
  }
  
  function checkLoginStatus() {
    $openid = 0
    $.ajax({
      url: "check_login.php",
      dataType: "json",
      data: { openid: openid },
    success: function(data) {
      if (data.status === "success") {
        if (data.logged_in) {
          showMoreInfo();
        } else {
          setTimeout(function() {
            checkLoginStatus(openid);
          }, 5000);
        }
      } else {
        showMessage("登录检查失败");
      }
    }
  });
}

$(document).ready(function() {
  $("#login").click(function() {
    $.ajax({
      url: "get_qrcode.php",
      dataType: "json",
      success: function(data) {
        if (data.status === "success") {
          $("#qrcode-popup").removeClass("hidden");
          $("#qrcode").attr("src", data.qrcode_url);
          checkLoginStatus();
        } else {
          showMessage("无法获取二维码");
        }
      }
    });
  });
});


