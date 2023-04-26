// search.js

document.addEventListener("DOMContentLoaded", () => {
    const searchButton = document.getElementById("search-button");
    const schoolSearchButton = document.getElementById("school-search-button");
    const search985 = document.getElementById("search-985");
    const search211 = document.getElementById("search-211");
    const searchS16 = document.getElementById("search-s16");
  
    searchButton.addEventListener("click", () => {
        const scholarName = document.getElementById("search-input").value;
        searchScholars(scholarName);
      });
  
    schoolSearchButton.addEventListener("click", () => {
      // 这里可以添加根据输入的学校名称搜索学校的逻辑
    });
  
    search985.addEventListener("click", () => {
      // 这里可以添加根据 985 特征搜索学校的逻辑
    });
  
    search211.addEventListener("click", () => {
      // 这里可以添加根据 211 特征搜索学校的逻辑
    });
  
    searchS16.addEventListener("click", () => {
      // 这里可以添加根据双一流特征搜索学校的逻辑
    });
  });

// 使用 JavaScript 的 fetch 函数发起 AJAX 请求
function searchScholars(scholarName) {
    fetch("backend/search.php?action=search_scholars&name=" + encodeURIComponent(scholarName))
      .then((response) => {
        if (response.ok) {
          return response.json();
        } else {
          throw new Error("Network response was not ok.");
        }
      })
      .then((scholars) => {
        // 处理搜索结果，例如更新页面内容
      })
      .catch((error) => {
        console.error("There was a problem with the fetch operation:", error);
      });
  }
  
  // 使用 jQuery 的 $.ajax 方法发起 AJAX 请求
  function searchScholarsWithJQuery(scholarName) {
    $.ajax({
      url: "backend/search.php",
      type: "GET",
      data: {
        action: "search_scholars",
        name: scholarName,
      },
      dataType: "json",
      success: function (scholars) {
        // 处理搜索结果，例如更新页面内容
      },
      error: function (xhr, status, error) {
        console.error("AJAX request failed:", error);
      },
    });
  }





  