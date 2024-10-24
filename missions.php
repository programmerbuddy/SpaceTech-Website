<?php
@include 'config.php';
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Mission Page</title>
    <link rel="stylesheet" href="css/style2.css">
</head>

<body>
    <?php
    @include('nav/header.php');
    ?>

    <div class="dropdown-section">
        <form method="post">
            <label for="country-select">Select Country:</label>
            <select id="country-select" name="country">
                <option value="selectcountry">Select a country</option>
                <option value="ISRO">ISRO</option>
                <option value="NASA">NASA</option>
                <option value="ROSCOSMOS">ROSCOSMOS</option>
                <!-- Add more country options as needed -->
            </select>
            <button type="submit" name="ok">OK</button>
        </form>
    </div>
    <div class="country-details" style="display: none;">
        <!-- Content related to the selected country will be displayed here -->
    </div>
    <?php
    if (isset($_POST['ok'])) {
        $selectedCountry = $_POST['country'];

        $sql = mysqli_query($conn, "SELECT mission_id, ms_name, ms_desc, ms_img FROM missions WHERE category = '$selectedCountry'");

        if (mysqli_num_rows($sql) > 0) {
            echo "<div class='mission-container'>";
            while ($row = mysqli_fetch_assoc($sql)) { ?>
                <div class="mission-card">
                    <img class="mission-image" src="uploaded_mission/mission_img/<?php echo $row['ms_img']; ?>" alt="Mission Image">
                    <div class="mission-link">
                        <a href="mission_description.php?Id=<?php echo $row['mission_id']; ?>">Learn More</a>
                    </div>
                    <h3>
                        <?php echo $row['ms_name']; ?>
                    </h3>
                    <p>
                        <?php echo $row['ms_desc']; ?>
                    </p>
                </div>
            <?php }
            echo "</div>";
        } else {
            echo '<p class="no-data-message">Mission data not available</p>';
        }
        mysqli_close($conn);
    }
    ?>

    <style>
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
            /* Three cards per row with some margin */
            margin: 10px;
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
    <script src="script.js"></script>
</body>

</html>