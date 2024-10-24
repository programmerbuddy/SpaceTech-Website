<?php
@include 'config.php';
session_start();

// Ensure the user is logged in and has a valid session
if (empty($_SESSION['userid'])) {
  // Redirect to a login page or handle the case when the user is not logged in
  header('location: login.php'); // Replace 'login.php' with your actual login page
  exit;
}

$user_id = $_SESSION['userid'];

$research_id = $_GET['Id']; // Use 'research_id' instead of 'Id' for consistency

$display_msg = array(); // Initialize an array to store messages

if (isset($_POST['uploads'])) {
  $research_Name = $_POST['name'];
  $research_Desc = $_POST['descriptions'];
  $Subject = $_POST['subject'];

  // Check if a new image is uploaded
  if ($_FILES['researchImg']['error'] === 0) {
    // New image is uploaded
    $img_extension = pathinfo($_FILES['researchImg']['name'], PATHINFO_EXTENSION);
    $img_name = uniqid('research_img_') . '.' . $img_extension;
    $img_directory = 'uploaded_research/uploaded_img/';
    $img_path = $img_directory . $img_name;

    if (move_uploaded_file($_FILES['researchImg']['tmp_name'], $img_path)) {
      mysqli_query($conn, "UPDATE research SET rs_image='$img_name' WHERE id=$research_id") or die(mysqli_error($conn));
    } else {
      $display_msg[] = "Error uploading image.";
    }
  }

  // Check if a new PDF is uploaded
  if ($_FILES['researchFile']['error'] === 0) {
    // New PDF is uploaded
    $pdf_extension = pathinfo($_FILES['researchFile']['name'], PATHINFO_EXTENSION);
    $pdf_name = uniqid('research_pdf_') . '.' . $pdf_extension;
    $pdf_directory = 'uploaded_research/';
    $pdf_path = $pdf_directory . $pdf_name;

    if (move_uploaded_file($_FILES['researchFile']['tmp_name'], $pdf_path)) {
      mysqli_query($conn, "UPDATE research SET rs_file='$pdf_name' WHERE id=$research_id") or die(mysqli_error($conn));
    } else {
      $display_msg[] = "Error uploading PDF.";
    }
  }

  // Update other fields
  if (!empty($research_Name)) {
    mysqli_query($conn, "UPDATE research SET name='$research_Name' WHERE id=$research_id") or die(mysqli_error($conn));
  }
  if (!empty($Subject)) {
    mysqli_query($conn, "UPDATE research SET subject='$Subject' WHERE id=$research_id") or die(mysqli_error($conn));
  }
  if (!empty($research_Desc)) {
    mysqli_query($conn, "UPDATE research SET description='$research_Desc' WHERE id=$research_id") or die(mysqli_error($conn));
  }

  // Redirect to the profile page with a success message
  $display_msg[] = "Updated successfully!";
  header('location: profile_header.php#products_spacing1');
  exit;
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Add research</title>
  <link href='https://fonts.googleapis.com/css?family=Bruno Ace SC' rel='stylesheet'>
  <script src="https://kit.fontawesome.com/de5a643238.js" crossorigin="anonymous"></script>

  <script src="jquery.js"></script>
</head>
<body>
  <section id="research" class="research-section">
    <div class="research-form">
      <h2>Submit Your Research</h2>
      <form method="POST" enctype="multipart/form-data">
        <p> Research Name:</p>
        <input type="text" id="name" name="name" class="box">

        <p> Research Description:</p>
        <textarea id="description" name="descriptions" rows="4" class="box"></textarea>

        <p>Research Subject:</p>
        <input type="text" id="subject" name="subject" class="box">

        <p>Upload Research:</p>
        <input type="file" id="researchFile" name="researchFile" accept=".pdf,.doc,.docx," class="box">

        <p> Upload Image:</p>
        <input type="file" id="researchImg" name="researchImg" accept=".jpeg,.png, .jpg, " class="box">

        <input type="submit" name="uploads" value="Submit Research">
      </form>
    </div>
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
  height: 70%;
  margin: 0;
}

.research-form {
  padding: 15px; 
  border: 2px solid #333;
  max-width: 400px;
  background-color: rgba(0, 0, 0, 0.7);
  /* Semi-transparent dark background */
  color: cyan;
  /* Cyan text color */
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
  margin: 10px;
}

.research-form input[type="text"],
.research-form textarea,
.research-form input[type="file"] {
  width: 90%;
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

.research-form input[type="file"] {
  padding: 5px;
}

.research-form input[type="submit"] {
  background-color: cyan;
  color: black;
  padding: 10px 15px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease-in-out;
  /* Animation for button color */
  width: 100%;
}

.research-form input[type="submit"]:hover {
  background-color: #33aacc;
}

.display_msg {
  margin-top: 10px;
  padding: 10px;
  background-color: #f44336;
  color: white;
  border-radius: 4px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.display_msg i {
  cursor: pointer;
}

/* Responsive design */
@media (max-width: 768px) {
  .research-form {
    margin: 10px auto;
    width: 90%;
  }
}

</style>