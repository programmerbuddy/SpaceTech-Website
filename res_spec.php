<?php @include 'header.php';
  @include 'sidebar.php';
  @include 'config.php';

  if (isset($_GET['Id'])) {
    $res_id = $_GET['Id'];


    $fetch_research = mysqli_query($conn, "SELECT * FROM `research` WHERE `id` = $res_id ") or die('query failed');
    if (mysqli_num_rows($fetch_research) > 0) {
      $research = mysqli_fetch_assoc($fetch_research);
      $resFile = $research['rs_file'];

      echo "<h2>Research: " . $research['name'] . "</h2>";
      echo '<iframe src="uploaded_research/' . $resFile . '" width="100%" height="500px"></iframe>';
    } else {
      echo "research Not Found.";
    }
  } else {
    echo "Invalid Request.";
  }
?>