<?php
@include('config.php');
session_start();
$user_id = $_SESSION['userid'];
if (!isset($user_id)) {
    header('location: login.php');
}
?>
<html>

<head>
    <title>User Panel</title>
    <link href='https://fonts.googleapis.com/css?family=Bruno Ace SC' rel='stylesheet'>
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="css/admin.css">

</head>

<body>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <h2><span><img onclick="closeNav()" src="img/logo.png" width="50px" alt="logo"></span>SpaceTech</h2>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li><a href="#" class="active"><span class="lab la-buromobelexperte"></span><span>Dashboard</span></a>
                </li>
                <li><a href="#accounts_spacing1"><span class="las la-user-circle"></span><span>Accounts</span></a></li>
                <li><a href="#products_spacing1"><span class="lab la-product-hunt"></span><span>MyResearch</span></a>
                </li>
                <li><a href="logout.php"><span class="las la-sign-in-alt"></span><span>Logout</span></a></li>
            </ul>
        </div>
    </div>
    <div class="main-content" id="main-content">
        <main>
            <div class="cards">
                <div class="card-single">
                    <div>
                        <?php
                        $research = mysqli_query($conn, "SELECT * FROM `research` where user_id = $user_id") or die('query failed');
                        $total_research = mysqli_num_rows($research);
                        ?>
                        <h1>
                            <?php echo $total_research; ?>
                        </h1>
                        <span class="card-text">research</span>
                        <div class="icon"><span class="lab la-product-hunt"></span></div>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1>
                            Name:
                            <?php echo $_SESSION['username']; ?>
                        </h1>
                        <span class="card-text">Email:
                            <?php echo $_SESSION['useremail']; ?>
                        </span>
                        <div class="icon"><span class="lab las la-users"></span></div>
                    </div>
                </div>
            </div>

            <div class="products_spacing"></div>
            <div id="accounts_spacing1"></div>
            <div id="accounts"><span>Accounts</span></div>
            <div class="container">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">User Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">password</th>
                            <th scope="col">Update</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $users = mysqli_query($conn, "SELECT * FROM `account` where id = $user_id ");
                        while ($row = mysqli_fetch_assoc($users)) {
                            echo "
                                <tr>
                                    <td>$row[username]</td>
                                    <td>$row[email]</td>
                                    <td>$row[password]</td>
                                    <td><a href='myprofile.php? Id= $row[id]' class = 'btn'>Update</a></td>
                                </tr>
                                ";
                        }
                        ?>
                    </tbody>
                </table>
            </div>




            <div class="products_spacing"></div>
            <div id="products_spacing1"></div>
            <div id="products"><span>MyResearch</span></div>
            <div class="container">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">name</th>
                            <th scope="col">description</th>
                            <th scope="col">subject</th>
                            <th scope="col">research image</th>
                            <th scope="col">research date</th>
                            <th scope="col">delete option</th>
                            <th scope="col">Update</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php
                        $research = mysqli_query($conn, "SELECT * FROM `research` WHERE user_id = $user_id");
                        while ($row = mysqli_fetch_assoc($research)) {
                            echo "
                                <tr>
                                    <td>{$row['name']}</td>
                                    <td>{$row['description']}</td>
                                    <td>{$row['subject']}</td>
                                    <td><img class='missionImg' src='uploaded_research/uploaded_img/{$row['rs_image']}'></td>
                                    <td>{$row['rs_date']}</td>
                                    <td><a href='delete.php?Id={$row['id']}' class='btn'>Delete</a></td>
                                    <td><a href='update_research.php?Id={$row['id']}' class='btn'>Update</a></td>
                                </tr>
                            ";
                        }
                    ?>


                    </tbody>
                </table>
            </div>
        </main>
    </div>



</body>

</html>