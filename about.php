<?php
@include 'config.php';


session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SpaceTech</title>
    <link rel="stylesheet" href="css/style2.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php
        @include('nav/header.php');
        ?>

    <div class="earth-rotate">
        <img src="img/earthPlanet.png" alt="" class="earth">
    </div>

    <section class="about-section">
        <h2 class="section-title">About Us</h2>
        <div class="about-grid">
            <div class="about-box">
                <img src="img/about1.jpg" alt="Image 1">
                <p><strong>Welcome to the thrilling world of space exploration!.🔥🔥🔥</strong></p>
            </div>
            <div class="about-box">
                <img src="img/about2.jpg" alt="Image 2">
                <p><strong>Embark on an extraordinary journey beyond the stars🌠🌠.</strong></p>
            </div>
            <div class="about-box">
                <img src="img/about3.jpg" alt="Image 3">
                <p><strong>Our mission is to ignite your passion for the cosmos🚀🚀, one celestial adventure at a time.</strong></p>
            </div>
            <div class="about-box">
                <img src="img/about4.jpg" alt="Image 4">
                <p><strong> Join us as we unlock the wonders of the universe together.🫂🫂</strong></p>
            </div>
        </div>
        <div class="explore-btn">
            <a href="missions.php" class="marsBtn">Start Exploring</a>
        </div>
    </section>

    <style>
        .about-section {
            padding: 100px 12%;
            color: #fff;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            color: var(--hover-color);
            margin-bottom: 2rem;
        }

        .about-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
        }

        .about-box {
            background-color: black;
            border-radius: 10px;
            padding: 2rem;
        }

        .about-box img {
            width: 100%;
            border-radius: 10px;
            margin-bottom: 1rem;
        }

        .about-box p {
            color: #dddcdc;
            line-height: 1.5rem;
        }

        .explore-btn {
            display: flex;
            justify-content: center;
            margin-top: 3rem;
        }
    </style>
</body>

<?php @include 'nav/footer.php';?>

</html>