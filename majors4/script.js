document.getElementById("search-btn").addEventListener("click", () => {
    let searchInput = document.getElementById("search-input").value;
    if (searchInput) {
        fetch("search.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json;charset=utf-8"
            },
            body: JSON.stringify({ search: searchInput })
        })
            .then(response => {
                console.log("Response status:", response.status);
                return response.json();
            })
            .then(data => {
                console.log("Received data:", data);
                displayResults(data);
            })
            .catch(err => console.error(err));
    }
});

function displayResults(data) {
    let resultsSection = document.getElementById("results-section");
    resultsSection.innerHTML = "";

    if (data.length === 0) {
        resultsSection.innerHTML = "<p>抱歉，未找到相关专业。</p>";
    } else {
        data.forEach(item => {
            let result = document.createElement("div");
            result.classList.add("result");

            result.innerHTML = `
                <p><strong>专业名称：</strong>${item.name_major}</p>
                <p><strong>专业代码：</strong>${item.id_major}</p>
            `;

            resultsSection.appendChild(result);
        });
    }
}
