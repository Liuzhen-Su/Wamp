<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>开设院校</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    /* Add custom styles here */
  </style>
</head>
<body>

<!-- Navigation bar -->
<!-- Add your navigation bar code here -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.html">首页</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="school_list.php">学校库</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="major_search.php">专业库</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="ScholarGPT.html">ScholarGPT</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="zhiku.html">智库服务</a>
            </li>
        </ul>
    </nav>

<!-- Major info -->
<div class="container mt-5">
  <?php
  include 'db.php';

  $id_major = $_GET['id_major'];
  $sql = "SELECT name_major, id_major FROM majors_info_2 WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id_major);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $name_major = $row["name_major"];
  $id_major = $row["id_major"];
  echo "<h2>$name_major ($id_major)</h2>";

  $stmt->close();
  ?>
</div>

<!-- School list -->
<div class="container">
  <h3>开设院校</h3>
  <ul class="list-group">
    <?php
    $sql = "SELECT school_list FROM majors_info_2 WHERE id_major = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_major);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    //$school_list_json = $row["school_list"];
    if ($row) {
      if (isset($row["school_list"])) {
          $school_list_json = $row["school_list"];
          $school_list = json_decode($school_list_json, true);

          if ($school_list === null) {
              echo "Failed to decode JSON: " . json_last_error_msg() . "<br>";  // Debug: Print the JSON decoding error
          } else {
              foreach ($school_list as $school) {
                $sql_s = "SELECT * FROM schools_info WHERE name = '$school'";
                $result = $conn->query($sql_s);
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo "<li class='list-group-item'><h6 class='card-title'><a href='school_home.php?id=" . $row['id'] . "' target='_blank'>" . $row['name'] . "</a></h6></li>";  
                  }
                } else {
                echo "<li class='list-group-item'>$school</li>";
                }
              }
          }
      } else {
          echo "The 'school_list' field is not found in the database result.<br>";  // Debug: Print if 'school_list' field is missing
      }
    } else {
      echo "No data found in the database<br>";  // Debug: Print if no data is fetched from the database
    }




    // // Convert the JSON string to UTF-8 encoding
    // $utf8_school_list_json = mb_convert_encoding($school_list_json, 'UTF-8', 'auto');
    // $school_list = json_decode($utf8_school_list_json, true);

    // //$school_list = json_decode($school_list_json, true);

    // foreach ($school_list as $school) {
    //   echo "<li class='list-group-item'>$school</li>";
    // }

    $stmt->close();
    $conn->close();
    ?>
  </ul>
</div>

</body>
</html>
