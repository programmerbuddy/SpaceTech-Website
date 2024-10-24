<?php
@include 'config.php';
session_start();
$mission_Id = $_GET['Id'];

if (isset($_POST['update'])) {
  $Mission_Name = $_POST['mission_name'];
  $Mission_Desc = $_POST['descriptions'];
  $Mission_Ldesc = $_POST['Ldescription'];
  $Category = $_POST['category'];

  
  // name in the form of img section
  if ($_FILES['mission_img']['error'] === 0) {  
    // New image is uploaded
    $img_extension = pathinfo($_FILES['mission_img']['name'], PATHINFO_EXTENSION);
    $img_name = uniqid('mission_') . '.' . $img_extension;
    $img_directory = 'uploaded_mission/mission_img/';
    $img_path = $img_directory . $img_name;

    if (move_uploaded_file($_FILES['mission_img']['tmp_name'], $img_path)) {
      mysqli_query($conn, "UPDATE missions SET ms_img='$img_name' WHERE mission_id=$mission_Id") or die(mysqli_error($conn));
    } else {
      $display_msg[] = "Error uploading image.";
    }
  }
  if ($_FILES['msnpdf']['error'] === 0) {
    // New pdf is uploaded
    $pdf_extension = pathinfo($_FILES['uploaded_mission']['name'], PATHINFO_EXTENSION); 
    $pdf_name = uniqid('mission_pdf_') . '.' . $pdf_extension;
    $pdf_directory = 'uploaded_mission';
    $pdf_path = $pdf_directory . $pdf_name;

    if (move_uploaded_file($_FILES['uploaded_mission/']['tmp_name'], $pdf_path)) {
      mysqli_query($conn, "UPDATE missions SET ms_file='$pdf_name' WHERE mission_id=$mission_Id") or die(mysqli_error($conn));
    } else {
      $display_msg[] = "Error uploading pdf.";
    }
  }


  // Update other fields
  if (!empty($Mission_Name)) {
    mysqli_query($conn, "UPDATE missions SET ms_name='$Mission_Name' WHERE mission_id=$mission_Id") or die(mysqli_error($conn));
  }
  if (!empty($Mission_Desc)) {
    mysqli_query($conn, "UPDATE missions SET ms_desc='$Mission_Desc' WHERE mission_id=$mission_Id") or die(mysqli_error($conn));
  }
  if (!empty($Mission_Ldesc)) {
    mysqli_query($conn, "UPDATE missions SET ms_Ldesc='$Mission_Ldesc' WHERE mission_id=$mission_Id") or die(mysqli_error($conn));
  }
  if (!empty($Mission_img)) {
    mysqli_query($conn, "UPDATE missions SET ms_img='$Mission_Img' WHERE mission_id=$mission_Id") or die(mysqli_error($conn));
  }
  if (!empty($Mission_pdf)) {
    mysqli_query($conn, "UPDATE missions SET ms_file='$Mission_pdf' WHERE mission_id=$mission_Id") or die(mysqli_error($conn));
  }
  if (!empty($Category)) {
    mysqli_query($conn, "UPDATE missions SET category='$Category' WHERE mission_id=$mission_Id") or die(mysqli_error($conn));
}

  $display_msg[] = "Updated successfully!";
  header('location: admin_page.php#missions_spacing1');
} 
?>
<!DOCTYPE html>
<html>

<head>
  <title>Add mission</title>
  <link href='https://fonts.googleapis.com/css?family=Bruno Ace SC' rel='stylesheet'>
  <script src="https://kit.fontawesome.com/de5a643238.js" crossorigin="anonymous"></script>

  <script src="jquery.js"></script>
</head>
<?php
if (isset($display_msg)) {
  foreach ($display_msg as $display_msg) {
    echo '
  <div class = "display_msg">
     <span>' . $display_msg . '</span>
     <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
  </div>
  ';
  }
}
?>

<body>

  <section class="form-container">
    <form action="" method="post" enctype="multipart/form-data">
      <h3>Update mission</h3>
      <p>Name</p>
      <input type="text" name="mission_name" placeholder="Enter mission Name" maxlength="50" class="box">
      <p>Select Country:</p>
            <select name="category" id="category">
                <option value="ISRO">ISRO</option>
                <option value="NASA">NASA</option>
                <option value="ROSCOSMOS">ROSCOSMOS</option>
            </select>
      <P>short Information:</P>
      <textarea id="description" name="descriptions" rows="4" class="box"></textarea>
      <P>Mission details:</P>
      <textarea id="description" name="Ldescription" class="box"></textarea>
      <p>mission Image</p>
      <input type="file" accept="image/jpg, image/jpeg, image/png" class="box" name="mission_img">
      <p>mission pdf</p>
      <input type="file" accept=".pdf, .epub, .pptx" class="box" name="msnpdf">
      <input type="submit" value="Update mission" name="update" class="btn">
    </form>
  </section>


</body>

</html>
<style>
  body {
    background-color: #111;
    /* Dark background */
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
  }

  .form-container {
    padding: 20px;
    border: 2px solid #333;
    width: 100%;
    max-width: 400px;
    background-color: rgba(0, 0, 0, 0.7);
    /* Semi-transparent dark background */
    color: cyan;
    /* Cyan text color */
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
  }

  .form-container input {
    width: 94%;
  }

  .box,
  #category {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 2px solid cyan;
    border-radius: 5px;
    outline: none;
    background-color: transparent;
    /* Transparent input background */
    color: cyan;
    /* Cyan text color */
  }

  .btn {
    background-color: cyan;
    color: black;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease-in-out;
    /* Animation for button color */
    width: 50%;
    /* Button width set to 50% */
    display: block;
    margin: 0 auto;
    /* Center the button horizontally */
  }

  .btn:hover {
    background-color: #33aacc;
  }
</style>