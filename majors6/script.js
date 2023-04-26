document.addEventListener("DOMContentLoaded", async function() {
    const degreeButtons = document.getElementById("degreeButtons");
    const buttonTemplate = document.getElementById("buttonTemplate");
    const listItemTemplate = document.getElementById("listItemTemplate");
    const categoryList = document.getElementById("categoryList");
    const firstLevelList = document.getElementById("firstLevelList");
    const majorList = document.getElementById("majorList");

    async function fetchData(endpoint, params = {}) {
        const url = new URL(endpoint, window.location.origin);
        Object.entries(params).forEach(([key, value]) => url.searchParams.append(key, value));
        const response = await fetch(url);
        return await response.json();
    }

    const degreeTypes = await fetchData("backend.php", { action: "getDegreeTypes" });
    degreeTypes.forEach(degree => {
        const button = buttonTemplate.content.cloneNode(true).querySelector("button");
        button.textContent = degree.name_degree;
        button.addEventListener("click", async () => {
            categoryList.innerHTML = "";
            firstLevelList.innerHTML = "";
            majorList.innerHTML = "";
            const categories = await fetchData("backend.php", { action: "getCategories", degree: degree.name_degree });
            categories.forEach(category => {
                const listItem = listItemTemplate.content.cloneNode(true).querySelector(".list-item");
                listItem.textContent = category.name_type;
                listItem.addEventListener("click", async () => {
                    firstLevelList.innerHTML = "";
                    majorList.innerHTML = "";
                    const firstLevels = await fetchData("backend.php", { action: "getFirstLevels", category: category.name_type });
                    firstLevels.forEach(firstLevel => {
                        const listItem = listItemTemplate.content.cloneNode(true).querySelector(".list-item");
                        listItem.textContent = firstLevel.name_first;
                        listItem.addEventListener("click", async () => {
                            majorList.innerHTML = "";
                            const majors = await fetchData("backend.php", { action: "getMajors", firstLevel: firstLevel.name_first });
                            majors.forEach(major => {
                                const listItem = listItemTemplate.content.cloneNode(true).querySelector(".list-item");
                                listItem.textContent = `${major.name_major} (${major.id_major})`;
                                majorList.appendChild(listItem);
                            });
                        });
                        firstLevelList.appendChild(listItem);
                    });
                });
                categoryList.appendChild(listItem);
            });
        });
        degreeButtons.appendChild(button);
    });
});
