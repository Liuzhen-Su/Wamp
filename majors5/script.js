document.addEventListener("DOMContentLoaded", function () {
    getDegreeTypes();

    document.getElementById("search-button").addEventListener("click", function () {
        searchMajors(document.getElementById("search-input").value);
    });
});

function getDegreeTypes() {
    // 获取学位种类
    fetch("backend.php?function=getDegreeTypes")
        .then(response => response.json())
        .then(data => {
            let degreeButtons = document.querySelector(".degree-buttons");
            data.forEach(degree => {
                let button = document.createElement("button");
                button.innerText = degree.name_degree;
                button.addEventListener("click", function () {
                    getMajorCategories(degree.name_degree);
                });
                degreeButtons.appendChild(button);
            });
        });
}

function getMajorCategories(degree) {
    // 获取
    // 获取大类
    fetch("backend.php?function=getMajorCategories&degree=" + encodeURIComponent(degree))
        .then(response => response.json())
        .then(data => {
            let majorCategory = document.querySelector(".major-category");
            majorCategory.innerHTML = "";
            data.forEach(category => {
                let span = document.createElement("span");
                span.innerText = category.name_type;
                span.addEventListener("click", function () {
                    getFirstLevelSubjects(category.name_type);
                });
                majorCategory.appendChild(span);
            });
        });
}

function getFirstLevelSubjects(category) {
    // 获取一级学科
    fetch("backend.php?function=getFirstLevelSubjects&category=" + encodeURIComponent(category))
        .then(response => response.json())
        .then(data => {
            let firstLevel = document.querySelector(".first-level");
            firstLevel.innerHTML = "";
            data.forEach(subject => {
                let span = document.createElement("span");
                span.innerText = subject.name_first;
                span.addEventListener("click", function () {
                    getMajors(subject.name_first);
                });
                firstLevel.appendChild(span);
            });
        });
}

function getMajors(subject) {
    // 获取专业
    fetch("backend.php?function=getMajors&subject=" + encodeURIComponent(subject))
        .then(response => response.json())
        .then(data => {
            let majors = document.querySelector(".majors");
            majors.innerHTML = "";
            data.forEach(major => {
                let span = document.createElement("span");
                span.innerText = major.name_major + " (" + major.id_major + ")";
                majors.appendChild(span);
            });
        });
}

function searchMajors(query) {
    // 搜索专业
    fetch("backend.php?function=searchMajors&query=" + encodeURIComponent(query))
        .then(response => response.json())
        .then(data => {
            let majors = document.querySelector(".majors");
            majors.innerHTML = "";
            data.forEach(major => {
                let span = document.createElement("span");
                span.innerText = major.name_major + " (" + major.id_major + ")";
                majors.appendChild(span);
            });
        });
}
