// main.js

document.addEventListener("DOMContentLoaded", () => {
    const navHome = document.getElementById("nav-home");
    const navSchoolSearch = document.getElementById("nav-school-search");
    const navLogin = document.getElementById("nav-login");
  
    navHome.addEventListener("click", () => {
      showPage("home");
    });
  
    navSchoolSearch.addEventListener("click", () => {
      showPage("school-search");
    });
  
    navLogin.addEventListener("click", () => {
      // 这里可以添加登录相关的逻辑
    });
  });
  
  function showPage(pageId) {
    const pages = ["home", "scholar-detail", "school-search", "school-home"];
  
    for (const page of pages) {
      const pageElement = document.getElementById(page);
  
      if (page === pageId) {
        pageElement.style.display = "block";
      } else {
        pageElement.style.display = "none";
      }
    }
  }
  