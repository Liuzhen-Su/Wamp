$(document).ready(function () {
    loadDegrees();

    $('#search-btn').click(function () {
        searchMajors();
    });

    $('body').on('click', '.degree-btn', function () {
        const degree = $(this).text();
        loadCategories(degree);
    });

    $('body').on('click', '.category', function () {
        const category = $(this).text();
        loadSubjects(category);
    });

    $('body').on('click', '.subject', function () {
        const subject = $(this).text();
        loadMajors(subject);
    });
});

function loadDegrees() {
    $.ajax({
        url: "fetch_degrees.php",
        method: "GET",
        dataType: "json",
        success: function (data) {
            data.forEach(function (degree) {
                const btn = `<button class="degree-btn">${degree.name_degree}</button>`;
                $(".degrees-container").append(btn);
            });
        }
    });
}

function loadCategories(degree) {
    $.ajax({
        url: "fetch_categories.php",
        method: "POST",
        data: { degree: degree },
        dataType: "json",
        success: function (data) {
            $(".categories-container").empty();
            $(".subjects-container").empty();
            $(".majors-container").empty();
            data.forEach(function (category) {
                const div = `<div class="category">${category.name_type}</div>`;
                $(".categories-container").append(div);
            });
        }
    });
}

function loadSubjects(category) {
    $.ajax({
        url: "fetch_subjects.php",
        method: "POST",
        data: { category: category },
        dataType: "json",
        success: function (data) {
            $(".subjects-container").empty();
            $(".majors-container").empty();
            data.forEach(function (subject) {
                const div = `<div class="subject">${subject.name_first}</div>`;
                $(".subjects-container").append(div);
            });
        }
    });
}

function loadMajors(subject) {
    $.ajax({
        url: "fetch_majors.php",
        method: "POST",
        data: { subject: subject },
        dataType: "json",
        success: function (data) {
            $(".majors-container").empty();
            data.forEach(function (major) {
                const div = `<div class="major"><span>${major.name_second} (${major.id_second})</span><button data-id="${major.id_second}" class="view-schools-btn">查看</button></div>`;
                $(".majors-container").append(div);
            });
        }
    });
}

function searchMajors() {
    const searchQuery = $("#search-input").val();
    $.ajax({
        url: "search_majors.php",
        method: "POST",
        data: { searchQuery: searchQuery },
        dataType: "json",
        success: function (data) {
            $(".degrees-container").empty();
            $(".categories-container").empty();
            $(".subjects-container").empty();
            $(".majors-container").empty();
            data.forEach(function (major) {
                const div = `<div class="major"><span>${major.name_second} (${major.id_second})</span><button data-id="${major.id_second}" class="view-schools-btn">查看</button></div>`;
                $(".majors-container").append(div);
            });
        }
    });
}
