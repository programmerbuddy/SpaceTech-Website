<?php
session_start();
@include 'config.php'; // Include your database connection here
$userid = $_SESSION['userid'];

$display_msg = "";

if (isset($_POST['upload'])) {
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $msn_name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $L_desc = mysqli_real_escape_string($conn, $_POST['Ldescription']);
    $msn_img = $_FILES['msnImg'];
    $msn_File = $_FILES['msnpdf'];

    // Check if all required fields are filled
    if (!empty($msn_name) && !empty($description) && !empty($msn_img)) {
        $msn_Filename = uniqid('msn_') . '.' . pathinfo($msn_File['name'], PATHINFO_EXTENSION);
        $msn_imgFilename = uniqid('mission_') . '.' . pathinfo($msn_img['name'], PATHINFO_EXTENSION); // Use the same extension as the image for the PDF

        $msn_imgTargetDirectory = 'uploaded_mission/mission_img/';
        $msn_FileTargetDirectory = 'uploaded_mission/';

        $msn_imgTargetPath = $msn_imgTargetDirectory . $msn_imgFilename;
        $msn_FileTargetPath = $msn_FileTargetDirectory . $msn_Filename;

        if (move_uploaded_file($msn_img['tmp_name'], $msn_imgTargetPath) && move_uploaded_file($msn_File['tmp_name'], $msn_FileTargetPath)) {
            // Assuming you are using mysqli for your database connection

            $query = "INSERT INTO `missions` (`ms_name`, `ms_desc`, `category`, `ms_file`, `ms_img`, `ms_Ldesc`) VALUES ('$msn_name', '$description', '$category', '$msn_Filename', '$msn_imgFilename', '$L_desc')";

            if (mysqli_query($conn, $query)) {
                $display_msg = "Uploaded successfully!";
                header('location:admin_page.php');
            } else {
                $display_msg = "Error uploading files.";
            }
        } else {
            $display_msg = "Error uploading files.";
        }
    } else {
        $display_msg = "Please fill all required fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mission</title>
    <!-- Add your other CSS links here -->
</head>

<body>
    <?php
    @include('nav/header.php');
    ?>

    <footer>
        <?php
        @include 'footer.php'
            ?>
    </footer>
</body>

</html>
<style>
    /* Your CSS styles here */
    body {
        background-image: url('img/background.jpg');
        /* Add your image path here */
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .msg {
        background-color: white;
        top: 100vh;
    }

    .mission-form {
        background-color: rgba(0, 0, 0, 0.7);
        padding: 20px;
        margin-top: 12%;
        border-radius: 5px;
        box-shadow: 0 5px 10px black;
        width: 400px;
        text-align: center;
    }

    .mission-form h2 {
        font-weight: bolder;
        color: #70efbf;
        font-size: 30px;
        margin-bottom: 15px;
        font-family: 'Bruno Ace SC', sans-serif;
        text-align: center;
    }

    .mission-form label {
        display: block;
        margin-top: 10px;
        font-size: 16px;
        color: white;
        text-align: left;
    }

    .mission-form input[type="text"],
    .mission-form input[type="email"],
    .mission-form input[type="file"],
    .mission-form textarea {
        width: 95%;
        margin-top: 10px;
        padding: 10px;
        font-size: 16px;
        border: none;
        border-bottom: 2px solid #70efbf;
        border-top: 2px solid transparent;
        background-color: rgba(0, 0, 0, 0.3);
        border-radius: 10px;
        color: white;
        outline: none;
    }

    .mission-form textarea {
        resize: vertical;
    }

    .mission-form input[type="submit"] {
        height: 30px;
        font-weight: bold;
        border: none;
        width: 100%;
        background: linear-gradient(180deg, #70efbf 0, #21c69a 100%);
        border-radius: 10px;
        cursor: pointer;
        color: #000;
        font-size: 16px;
        transition: all 0.4s ease;
        margin-top: 20px;
    }

    .mission-form input[type="submit"]:hover {
        background: linear-gradient(180deg, #70efbf 0, #12bd7b 100%);
        box-shadow: 0 3px 9px #25b981;
        color: #fff;
    }
</style>