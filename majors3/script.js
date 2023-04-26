document.addEventListener('DOMContentLoaded', () => {
    const searchBtn = document.getElementById('search-btn');
    const degreeButtons = document.querySelectorAll('.degree-container button');

    searchBtn.addEventListener('click', searchMajors);
    degreeButtons.forEach(btn => btn.addEventListener('click', fetchCategories));
});

async function searchMajors() {
    const searchInput = document.getElementById('search-input');
    const searchTerm = searchInput.value.trim();

    if (searchTerm === '') return;

    const response = await fetch('backend.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ action: 'search', searchTerm })
    });

    const data = await response.json();
    displaySearchResults(data);
}

async function fetchCategories(event) {
    const degree = event.target.id;

    const response = await fetch('backend.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ action: 'fetch_categories', degree })
    });

    const data = await response.json();
    displayCategories(data, degree);
}

async function fetchSubjects(event) {
    const degree = event.target.dataset.degree;
    const category = event.target.textContent;

    const response = await fetch('backend.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ action: 'fetch_subjects', degree, category })
    });

    const data = await response.json();
    displaySubjects(data, degree);
}

async function fetchMajors(event) {
    const degree = event.target.dataset.degree;
    const subject = event.target.textContent;

    const response = await fetch('backend.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ action: 'fetch_majors', degree, subject })
    });

    const data = await response.json();
}

function displaySearchResults(data) {
    const majorContainer = document.getElementById('major-container');
    majorContainer.innerHTML = '';

    data.forEach(item => {
        const major = document.createElement('div');
        major.textContent = `${item.name_major} - ${item.id_major}`;
        majorContainer.appendChild(major);

        const schoolList = document.createElement('div');
        schoolList.textContent = `开设院校：${item.school_list}`;
        majorContainer.appendChild(schoolList);
    });
}

function displayCategories(data, degree) {
    const categoryContainer = document.getElementById('category-container');
    categoryContainer.innerHTML = '';

    data.forEach(item => {
        const category = document.createElement('button');
        category.textContent = item.name_type;
        category.dataset.degree = degree;
        categoryContainer.appendChild(category);

        category.addEventListener('click', fetchSubjects);
    });
}

function displaySubjects(data, degree) {
    const subjectContainer = document.getElementById('subject-container');
    subjectContainer.innerHTML = '';

    data.forEach(item => {
        const subject = document.createElement('button');
        subject.textContent = item.name_first;
        subject.dataset.degree = degree;
        subjectContainer.appendChild(subject);

        subject.addEventListener('click', fetchMajors);
    });
}