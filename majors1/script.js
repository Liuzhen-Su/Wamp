document.addEventListener('DOMContentLoaded', () => {
    const degreeSelect = document.getElementById('degree');
    const categorySelect = document.getElementById('category');
    const firstLevelSelect = document.getElementById('first-level');
    const searchForm = document.getElementById('search-form');
    const resultsDiv = document.getElementById('results');
  
    fetchDegrees();
  
    degreeSelect.addEventListener('change', fetchCategories);
    categorySelect.addEventListener('change', fetchFirstLevels);
    searchForm.addEventListener('submit', searchMajors);
  
    function fetchDegrees() {
      fetch('fetch_data.php?action=getDegree')
        .then((response) => response.json())
        .then((data) => {
          if (data.error) {
            alert(data.error);
          } else {
            data.forEach((degree) => {
              const option = document.createElement('option');
              option.value = degree.name_degree;
              option.textContent = degree.name_degree;
              degreeSelect.appendChild(option);
            });
          }
        });
    }
  
    function fetchCategories() {
      const degree = degreeSelect.value;
      if (!degree) return;
  
      fetch(`fetch_data.php?action=getCategory&degree=${degree}`)
        .then((response) => response.json())
        .then((data) => {
          if (data.error) {
            alert(data.error);
          } else {
            categorySelect.innerHTML = '<option value="">请选择大类名称</option>';
            firstLevelSelect.innerHTML = '<option value="">请选择一级学科</option>';
            data.forEach((category) => {
              const option = document.createElement('option');
              option.value = category.name_type;
              option.textContent = category.name_type;
              categorySelect.appendChild(option);
            });
          }
        });
    }
  
    function fetchFirstLevels() {
      const degree = degreeSelect.value;
      const category = categorySelect.value;
      if (!degree || !category) return;
  
      fetch(`fetch_data.php?action=getFirstLevel&degree=${degree}&category=${category}`)
        .then((response) => response.json())
        .then((data) => {
          if (data.error) {
            alert(data.error);
          } else {
            firstLevelSelect.innerHTML = '<option value="">请选择一级学科</option>';
            data.forEach((firstLevel) => {
              const option = document.createElement('option');
              option.value = firstLevel.name_first;
              option.textContent = firstLevel.name_first;
              firstLevelSelect.appendChild(option);
            });
          }
        });
    }
  
    function searchMajors(event) {
      event.preventDefault();
  
      const degree = degreeSelect.value;
      const category = categorySelect.value;
      const firstLevel = firstLevelSelect.value;
  
      if (!degree || !category || !firstLevel) {
        alert('请完整填写所有筛选条件！');
        return;
      }
  
      fetch(`fetch_data.php?action=searchMajors&degree=${degree}&category=${category}&firstLevel=${firstLevel}`)
      .then((response) => response.json())
      .then((data) => {
        if (data.error) {
          alert(data.error);
        } else {
          resultsDiv.innerHTML = '';

          data.forEach((major) => {
            const majorDiv = document.createElement('div');
            majorDiv.classList.add('major');

            const majorTitle = document.createElement('h3');
            majorTitle.textContent = major.name_second;
            majorDiv.appendChild(majorTitle);

            const majorInfo = document.createElement('p');
            majorInfo.innerHTML = `
              学位种类：${major.name_degree}<br>
              大类名称：${major.name_type}<br>
              一级学科：${major.name_first}<br>
              专业代码：${major.id_second}<br>
              专业开设院校列表：${major.school_list}
            `;
            majorDiv.appendChild(majorInfo);

            resultsDiv.appendChild(majorDiv);
          });
        }
      });
  }
});
