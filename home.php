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


    <section id="home" class="home">
        <div class="home-text">
            <h1><span>Astronautics : </span> Humanity's</h1>
            <h2>Gateway to the Stars</h2>
            <a href="About.php" class="marsBtn">Know About us</a>
        </div>

        <div class="home-img">
            <img src="img/hero.png" alt="" class="hero">
            <img src="img/light-moon.png" alt="" class="moon-light">
        </div>
    </section>
    <div class="bg">
        <section id="mission-history" class="mission-history">
            <div class="img-mission">
                <img src="img/astronaut.png" alt="">
            </div>
            <div class="research-details-text-mission">
                <h3>Human in Space</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Aperiam rem distinctio laborum!</p>
                <div class="mission-btn">
                    <a href="" class="marsBtn">Join With Us</a>
                </div>
            </div>
        </section>
    </div>
    <div class="res1">
        <?php
        $sql = mysqli_query($conn, "SELECT * FROM research LIMIT 3");

        if (mysqli_num_rows($sql) > 0) {
            echo "<div class='mission-container'>";
            while ($row = mysqli_fetch_assoc($sql)) { ?>
                <div class="mission-card">
                    <img class="mission-image" src="uploaded_research/uploaded_img/<?php echo $row['rs_image']; ?>"
                        alt="Mission Image">
                    <div class="mission-link">
                        <div class="mission-link">
                            <?php
                            // Check if the user is logged in
                            if (isset($_SESSION['user_id'])) {
                                // User is logged in, allow them to access the page
                                ?>
                                <a href="res_spec.php?Id=<?php echo $row['id']; ?>">Learn More</a>
                                <?php
                            } else {
                                // User is not logged in, redirect to the login page
                                echo '<a href="login.php">Log in to access this page</a>';
                            }
                            ?>
                        </div>
                    </div>
                    <h3>
                        <?php echo $row['name']; ?>
                    </h3>
                    <p>
                        <?php echo $row['description']; ?>
                    </p>
                </div>
            <?php }
            echo "</div>";
        } else {
            echo '<p class="no-data-message">Mission data not available</p>';
        }
        ?>
    </div>
    <div class="bt">
        <a href="Research.php" class="btn">View More</a>
    </div>
</body>
<?php @include('nav/footer.php'); ?>

</html>

<style>
    /* Style for the home page */

    /* Import font awesome icons */
    @import url('https://use.fontawesome.com/releases/v5.15.4/css/all.css');

    /* Set the background color and font family for the body */
    body {
        background-color: #0f0f0f;
        font-family: 'Roboto', sans-serif;
    }

    footer {
        margin-top: 60px;
    }

    /* Style for the home text */
    .home-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        text-align: center;
    }

    /* Style for the span element in the home text */
    .home-text span {
        color: #ff9900;
    }

    /* Style for the h1 element in the home text */
    .home-text h1 {
        font-size: 4rem;
        margin-bottom: 1rem;
    }

    /* Style for the h2 element in the home text */
    .home-text h2 {
        font-size: 2rem;
        margin-bottom: 2rem;
    }

    /* Style for the marsBtn class */


    /* Style for the home image */
    .home-img {
        position: absolute;
        top: 50%;
        right: 10%;
        transform: translateY(-50%);
    }

    /* Style for the hero image */
    .hero {
        width: 500px;
    }

    /* Style for the moon light image */
    .moon-light {
        position: absolute;
        top: -100px;
        right: -100px;
    }

    /* Add animation for the moon light image */
    @keyframes moon-light-anim {
        from {
            transform: rotate(0deg);
            opacity: 0.8;
        }

        to {
            transform: rotate(360deg);
            opacity: 1;
        }
    }

    .moon-light {
        animation-name: moon-light-anim;
        animation-duration: 10s;
        animation-iteration-count: infinite;
    }

    /* Style for the earth rotate div */
    .earth-rotate {
        position: absolute;
        top: -100px;
        left: -2px;
    }

    /* Style for the earth image */
    .earth {
        width: 300px;
    }

    /* Add animation for the earth image */
    @keyframes earth-rotate-anim {
        from {
            transform: rotate(0deg);
            opacity: 0.8;
        }

        to {
            transform: rotate(360deg);
            opacity: 1;
        }
    }

    .earth {
        animation-name: earth-rotate-anim;
        animation-duration: 20s;
        animation-iteration-count: infinite;
    }

    /* Style for the btn class */
    .bt {
        display: flex;
        float: right;
    }

    .btn {
        background: linear-gradient(180deg, #70efbf 0, #21c69a 100%);
        height: 28px;
        line-height: 28px;
        border-radius: 5px;
        padding: 0 20px;
        font-weight: 700;
        letter-spacing: 1px;
        transition: all .3s ease;
        white-space: nowrap;
    }

    .btn:hover {
        background-color: #12bd7b;
    }



    /* Style for the mission history section */
    .mission-history {
        display: flex;
        align-items: center;
        justify-content: space-around;
        padding-top: 5rem;
    }

    .bg {
        margin-left: 140px;
        border-radius: 20px;
        height: 350px;
        width: 80%;
        background-color: rgba(0, 0, 0, 0.5);
        /* Transparent black background color */
    }

    /* Style for the img mission div */
    .img-mission {
        width: 40%;
        height: auto;
        margin-left: auto;
        margin-right: auto;
        display: block;
        overflow: hidden;
    }

    /* Style for the astronaut image */
    .img-mission img {
        width: 60%;
        height: auto;
        object-fit: cover;
        object-position: center;
        filter: grayscale(80%);
        transition: all .5s ease-in-out;
    }

    /* Add hover effect for the astronaut image */
    .img-mission:hover img {
        filter: grayscale(0%);
        transform: scale(1.05);
    }

    /* Style for the research details text mission div */
    .research-details-text-mission {
        width: 40%;
        height: auto;
        margin-left: auto;
        margin-right: auto;
        display: block;
        color: white;
    }

    /* Style for the h3 element in the research details text mission div */
    .research-details-text-mission h3 {
        font-size: 2rem;
        margin-bottom: .5rem;
    }

    /* Style for the p element in the research details text mission div */
    .research-details-text-mission p {
        font-size: 1.2rem;
        margin-bottom: 1rem;
        line-height: 1.5;
    }

    /* Style for the mission btn div */
    .mission-btn {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Add media queries for responsiveness */
    @media screen and (max-width: 768px) {

        /* Adjust the home text position */
        .home-text {
            top: 40%;
            left: 50%;
        }

        /* Adjust the home image position and size */
        .home-img {
            top: 60%;
            right: 50%;
            transform: translate(50%, -50%);
        }

        .hero {
            width: 300px;
        }

        /* Adjust the mission history layout */
        .mission-history {
            flex-direction: column;
        }

        /* Adjust the img mission size */
        .img-mission {
            width: 60%;
        }

        /* Adjust the research details text mission size */
        .research-details-text-mission {
            width: 80%;
        }
    }

    .res1 {
        margin-top: 20px;
        margin-bottom: 20px;
        border-radius: 10px;
        background-color: rgba(0, 0, 0, 0.5);
        /* Transparent black background color */
        width: 80%;
        margin-left: 140px;
    }

    /* CSS for mission card layout */
    .mission-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-evenly;
    }

    button[name="ok"] {
        padding: 10px 20px;
        background-color: #70efbf;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button[name="ok"]:hover {
        background-color: #12bd7b;
    }

    .mission-card {
        width: calc(33.33% - 20px);
        /* Decreased the margin from 30px to 20px */
        margin: 10px;
        /* Adjust this margin to control the gap between cards */
        background-color: rgba(0, 0, 0, 0.7);
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        text-align: center;
        position: relative;
        overflow: hidden;
        color: white;
    }


    .mission-image {
        max-width: 100%;
        height: auto;
    }

    .mission-link {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        opacity: 0;
        /* Initially hidden */
        transition: opacity 0.3s ease;
        /* Smooth opacity transition */
    }

    .mission-link a {
        color: #fff;
        text-decoration: none;
        font-weight: bold;
        transition: transform 0.3s ease;
    }


    .mission-card:hover .mission-link {
        opacity: 1;
        /* Show the link container */
    }

    .mission-card:hover .mission-link a {
        transform: translateY(0);
        /* Slide button up from the bottom */
    }
</style>