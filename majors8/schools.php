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

<!-- Major info -->
<div class="container mt-5">
  <?php
  // Connect to database
  $servername = "localhost";
  $username = "root";
  $password = "sr19971008";
  $dbname = "scholars";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

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
    $sql = "SELECT school_list FROM majors_info_2 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_major);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $school_list_json = $row["school_list"];
    $school_list = json_decode($school_list_json, true);

    foreach ($school_list as $school) {
      echo "<li class='list-group-item'>$school</li>";
    }

    $stmt->close();
    $conn->close();
    ?>
  </ul>
</div>

</body>
</html>
