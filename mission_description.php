<?php
@include('config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mission Description</title>

</head>


<body>


    <?php
    if (isset($_GET['Id'])) {
        $msn_id = $_GET['Id'];
        echo '<div class="container">';
        $sql = mysqli_query($conn, "SELECT ms_name, ms_Ldesc, ms_img, ms_file FROM missions WHERE mission_id=$msn_id");
        while ($row = mysqli_fetch_assoc($sql)) { ?>
            <div class="mission-description">
                <h1>Our Mission</h1>
                <img src="uploaded_mission/mission_img/<?php echo $row['ms_img']; ?>" alt="Mission Image" width="400">
                <p>
                    <?php echo $row['ms_Ldesc']; ?>
                </p>
            </div>
            <div class="pdf-embed">
                <iframe src="uploaded_mission/<?php echo $row['ms_file']; ?>" frameborder="0"></iframe>
            </div>
            <a class="back-button" href="missions.php">Back</a>
        <?php }
    }
    echo "</div>"
        ?>

</body>
<style>
    :root {
        --color-text: #cdc6c3;
        --hover-color: #70efbf;
        --neon-box-shadow: 0 0 .5rem #70efbf;
        --index: calc(1vw + 1vh);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: "Outfit", sans-serif;
        background: url('./img/background.jpg') no-repeat;
        background-size: cover;
        background-position: center;
        overflow-x: hidden;
        color: var(--color-text);
    

        position: relative;
        /* Add this for positioning the back button */
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .mission-description {
        background-color: rgba(16, 18, 54, 0.8);
        /* Adjust transparency here */
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.7);
        color: #fff;
        margin-bottom: 20px;
        display: flex;
        /* Use flexbox to center content vertically */
        align-items: center;
        /* Center vertically */
        justify-content: center;
        /* Center horizontally */
        text-align: center;
        /* Center text */
        flex-direction: column;
        /* Stack items vertically */
        margin-top: 60px;
    }

    .mission-description h1 {
        font-size: 2.5rem;
        text-shadow: 2px 1px 1px #cd1a1a;
        margin-bottom: 1rem;
    }

    .mission-description p {
        margin-top: 1rem;
        line-height: 1.5rem;
    }

    .mission-description img {
        max-width: 100%;
        height: auto;
    }

    .pdf-embed {
        background-color: rgba(16, 18, 54, 0.8);
        /* Adjust transparency here */
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.7);
        margin-bottom: 20px;
    }

    .pdf-embed iframe {
        width: 100%;
        height: 500px;
        border: none;
    }

    /* Back Button */
    .back-button {
        position: absolute;
        bottom: 20px;
        right: 20px;
        padding: 10px 20px;
        background-color: var(--hover-color);
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .back-button:hover {
        background-color: #12bd7b;
    }

    /* Links */
    a {
        padding-top: 50px;
        color: #fff;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    a:hover {
        color: var(--hover-color);
    }
</style>

</html>