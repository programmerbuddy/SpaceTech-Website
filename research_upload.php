<?php
session_start();
@include 'config.php';
$userid = $_SESSION['userid'];

if (isset($_POST['upload'])) {
    $rsname = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $rsImage = $_FILES['researchImg'];
    $rsFile = $_FILES['researchFile'];

    // Check if all required fields are filled
    if (!empty($rsname) && !empty($description) && !empty($subject) && !empty($rsFile['name']) && !empty($rsImage['name'])) {

        // Check if the description has at least 4 lines
        $descriptionLines = explode("\n", $description);
        $minLines = 4;

        if (count($descriptionLines) >= $minLines) {
            // Generate unique filenames
            $rsFileExtension = pathinfo($rsFile['name'], PATHINFO_EXTENSION);
            $rsImageExtension = pathinfo($rsImage['name'], PATHINFO_EXTENSION);
            $rsFilename = uniqid('res_cover_') . '.' . $rsFileExtension;
            $rsImageFilename = uniqid('research_') . '.' . $rsImageExtension;

            // Define target directories
            $rsFileTargetDirectory = 'uploaded_research/';
            $rsImageTargetDirectory = 'uploaded_research/uploaded_img/';

            // Define target paths
            $rsImageTargetPath = $rsImageTargetDirectory . $rsImageFilename;
            $rsFileTargetPath = $rsFileTargetDirectory . $rsFilename;

            // Move uploaded files to target directories
            if (move_uploaded_file($rsImage['tmp_name'], $rsImageTargetPath) && move_uploaded_file($rsFile['tmp_name'], $rsFileTargetPath)) {

                // Insert data into the database with sanitized input
                $query = "INSERT INTO `research` (`user_id`, `name`, `description`, `subject`, `rs_file`, `rs_image`) VALUES ($userid, '$rsname', '$description', '$subject', '$rsFilename', '$rsImageFilename')";
                mysqli_query($conn, $query) or die('Query failed');

                // Redirect after successful upload
                header('location: Research.php');

                $display_msg[] = "Uploaded successfully!";
            } else {
                $display_msg[] = "Error uploading files.";
            }
        } else {
            $display_msg[] = "Please provide a description with at least 4 lines.";
        }
    } else {
        $display_msg[] = "Please fill all required fields.";
    }
}
?>

<?php
if (isset($display_msg)) {
    if (is_array($display_msg)) {
        foreach ($display_msg as $display_msg) {
            echo '
      <div class="display_msg">
         <span>' . $display_msg . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Research </title>
    <!-- Add your other CSS links here -->
</head>

<body>
    <header>
        <?php
        @include 'header.php'
            ?>
    </header>

    <section id="research" class="research-section">
    <div class="research-form">
                <h2>Submit Your Research</h2>
                <form method="POST" enctype="multipart/form-data">
                    <label for="name"> Research Name:</label>
                    <input type="text" id="name" name="name" required>

                    <label for="description">Research Description:</label>
                    <textarea id="description" name="description" rows="4" required></textarea>

                    <label for="subject">Research Subject:</label>
                    <input type="text" id="subject" name="subject" required>

                    <label for="researchFile">Upload Research:</label>
                    <input type="file" id="researchFile" name="researchFile" accept=".pdf,.doc,.docx," required>

                    <label for="researchImage">Upload Image:</label>
                    <input type="file" id="researchImg" name="researchImg" accept=".jpeg,.png, .jpg, " required>

                    <input type="submit" name="upload" value="Submit Research">
                </form>
            </div>
    </section>

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

    .research-form {
        background-color: rgba(0, 0, 0, 0.7);
        padding: 20px;
        margin-top: 12%;
        border-radius: 5px;
        box-shadow: 0 5px 10px black;
        width: 400px;
        text-align: center;
    }

    .research-form h2 {
        font-weight: bolder;
        color: #70efbf;
        font-size: 30px;
        margin-bottom: 15px;
        font-family: 'Bruno Ace SC', sans-serif;
        text-align: center;
    }

    .research-form label {
        display: block;
        margin-top: 10px;
        font-size: 16px;
        color: white;
        text-align: left;
    }

    .research-form input[type="text"],
    .research-form input[type="email"],
    .research-form input[type="file"],
    .research-form textarea {
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

    .research-form textarea {
        resize: vertical;
    }

    .research-form input[type="submit"] {
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

    .research-form input[type="submit"]:hover {
        background: linear-gradient(180deg, #70efbf 0, #12bd7b 100%);
        box-shadow: 0 3px 9px #25b981;
        color: #fff;
    }

    /* Styles for the display_msg */
    .display_msg {
        position: fixed;
        top: 30%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
        background-color: #f8f8f8;
        padding: 40px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        color: #333;
        font-size: 16px;
        text-align: center;
        max-width: 600px;
    }

    .display_msg span {
        display: block;
        margin-bottom: 10px;
    }

    .display_msg i {
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
        color: #777;
        font-size: 20px;
    }

    /* MESSAGE CSS END */
</style>