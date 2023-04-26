function fetchData(url, callback) {
    fetch(url)
        .then(response => response.json())
        .then(data => callback(data))
        .catch(error => console.error(error));
}

function updateSection(sectionId, data, callback) {
    const section = document.getElementById(sectionId);
    section.innerHTML = '';
    data.forEach(item => {
        const listItem = document.createElement('div');
        listItem.className = 'list-item';
        listItem.textContent = item.name;
        listItem.addEventListener('click', () => callback(item));
        section.appendChild(listItem);
    });
}

function updateMajors(degree) {
    fetchData(`search_results.php?degree=${degree}`, data => {
        updateSection('major-categories', data.categories, category => {
            updateSection('major-disciplines', category.disciplines, discipline => {
                updateSection('majors', discipline.majors, major => {
                    window.location.href = `school_list.php?id_major=${major.id_major}`;
                });
            });
        });
    });
}

window.addEventListener('DOMContentLoaded', () => {
    document.getElementById('search-form').addEventListener('submit', e => {
        e.preventDefault();
        const query = document.getElementById('search-input').value.trim();
        if (query) {
            window.location.href = `search_results.php?query=${query}`;
        }
    });

    fetchData('index.php?action=degrees', data => {
        const degreeButtons = document.getElementById('degree-buttons');
        data.forEach(degree => {
            const button = document.createElement('button');
            button.textContent = degree;
            button.addEventListener('click', () => updateMajors(degree));
            degreeButtons.appendChild(button);
        });
    });
});
