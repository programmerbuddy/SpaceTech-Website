<?php
@include('config.php');
session_start();
$name = $_SESSION['adminname'];
?>

<?php
if (isset($msg)) {
    foreach ($msgs as $msg) {
        echo "
        <div id='messageBox'>
          <span class='closeButton' onclick='this.parentElement.remove()'>&times;</span>
          <p>$msg</p>
        </div>
";
    }
}
?>
<html>

<head>
    <title>Admin Panel</title>
    <link href='https://fonts.googleapis.com/css?family=Bruno Ace SC' rel='stylesheet'>
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="css/admin.css">

    <script src="jquery.js"></script>
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
                <li><a href="#msgs_spacing1"><span class="las la-comment-dots"></span><span>Messages</span></a></li>
                <li><a href="#products_spacing1"><span class="lab la-product-hunt"></span><span>Missions</span></a></li>
                <li><a href="logout.php"><span class="las la-sign-in-alt"></span><span>Logout</span></a></li>
            </ul>
        </div>
    </div>
    <script>
        let list = document.querySelectorAll(".sidebar-menu li a");
        list.forEach(item => {
            item.addEventListener('click', () => {
                document.querySelector('.active')?.classList.remove('active');
                item.classList.add('active');

            });
        });
    </script>
    <div class="main-content" id="main-content">
        <header>
            <h2>
                <label for="" onclick="openNav()"><span class="las la-bars"></span></label>
                Dashboard
            </h2>
            <div class="user-wrapper">
                <h4>
                    <?php echo $name; ?>
                </h4>
                <small>Admin</small>
            </div>
        </header>
        <main>
            <div class="cards">
                <div class="card-single">
                    <div>
                        <?php
                        $users = mysqli_query($conn, "SELECT * FROM `account` where user_type = 'user' ") or die('query failed');
                        $total_users = mysqli_num_rows($users);
                        ?>
                        <h1>
                            <?php echo $total_users; ?>
                        </h1>
                        <span class="card-text">Accounts</span>
                        <div class="icon"><span class="las la-users"></span></div>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <?php
                        $msgs = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
                        $total_msgs = mysqli_num_rows($msgs);
                        ?>
                        <h1>
                            <?php echo $total_msgs; ?>
                        </h1>
                        <span class="card-text">Messages</span>
                        <div class="icon"><span class="las la-comment-dots"></span></div>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <?php
                        $msn = mysqli_query($conn, "SELECT * FROM `missions`") or die('query failed');
                        $total_msn = mysqli_num_rows($msn);
                        ?>
                        <h1>
                            <?php echo $total_msn; ?>
                        </h1>
                        <span class="card-text">Missions</span>
                        <div class="icon"><span class="lab la-product-hunt"></span></div>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <?php
                        $research = mysqli_query($conn, "SELECT * FROM `research`") or die('query failed');
                        $total_research = mysqli_num_rows($research);
                        ?>
                        <h1>
                            <?php echo $total_research; ?>
                        </h1>
                        <span class="card-text">research</span>
                        <div class="icon"><span class="lab la-product-hunt"></span></div>
                    </div>
                </div>

            </div>

            <!-- -----------------------Accounts Info starts here----------------------- -->
            <div class="products_spacing"></div>
            <div id="accounts_spacing1"></div>
            <div id="accounts"><span>Accounts</span></div>
            <div class="container">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">User Type</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">password</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $users = mysqli_query($conn, "SELECT * FROM `account` where user_type = 'user' ");
                        while ($row = mysqli_fetch_assoc($users)) {
                            echo "
                                <tr>
                                    <td>$row[id]</td>
                                    <td>$row[user_type]</td>
                                    <td>$row[username]</td>
                                    <td>$row[email]</td>
                                    <td>$row[password]</td>
                                    <td><a href='delete.php? user_Id= $row[id]' class = 'btn'>Delete</a></td>
                                </tr>
                                ";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- -----------------------Accounts Info ends here----------------------- -->

            <!-- -----------------------Messages starts here----------------------- -->
            <div class="products_spacing"></div>
            <div id="msgs_spacing1"></div>
            <div id="msgs"><span>Messages</span></div>
            <div class="container">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Messages</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $messages = mysqli_query($conn, "SELECT * FROM `message`");
                        while ($row = mysqli_fetch_assoc($messages)) {
                            echo "
                                <tr>
                                    <td>$row[name]</td>
                                    <td>$row[email]</td>
                                    <td>$row[message]</td>
                                    <td><a href='delete.php? userId= $row[id]' class = 'btn'>Delete</a></td>
                                </tr>
                                ";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- -----------------------Messages Info ends here----------------------- -->

            <!-- -----------------------Add products----------------------- -->

            <div class="products_spacing"></div>
            <div id="products_spacing1"></div>
            <div id="products"><span>Add Missions</span></div>
            <center>
                <section id="mission" class="ms-section">
                    <div class="msn-form">
                        <form action="mission_upload.php" method="POST" enctype="multipart/form-data">
                            <label for="name"> Mission Name:</label>
                            <input type="text" id="name" name="name" required>

                            <label for="description">short Information:</label>
                            <textarea id="description" name="description" rows="4" required></textarea>

                            <label for="Ldescription">Mission details:</label>
                            <textarea id="description" name="Ldescription" required></textarea>

                            <label for="msnFile">Category:</label>
                            <select name="category" id="category">
                                <option value="ISRO">ISRO</option>
                                <option value="NASA">NASA</option>
                                <option value="ROSCOSMOS">ROSCOSMOS</option>
                            </select>

                            <label for="researchImage">Upload Image:</label>
                            <input type="file" id="msnImg0" name="msnImg" accept=".jpeg,.png, .jpg, " required>

                            <label for="missionpdf">Upload pdf:</label>
                            <input type="file" id="msnpdf" name="msnpdf" accept=".pdf, .epub, .pptx,">

                            <input type="submit" name="upload" id="upload" value="upload">
                        </form>
                    </div>
                </section>
            </center>


            <!-- fetch data -->

            <div class="container">

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Mission details</th>
                            <th scope="col">Image</th>
                            <th scope="col">Delete</th>
                            <th scope="col">Update</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $pic = mysqli_query($conn, "SELECT * FROM `missions`");
                        while ($row = mysqli_fetch_array($pic)) {
                            echo "
                                <tr>
                                    <td>$row[mission_id]</td>
                                    <td>$row[ms_name]</td>
                                    <td>$row[category]</td>
                                    <td class='ms_details'>$row[ms_desc]</td>
                                    <td><img class='missionImg' src='uploaded_mission/mission_img/$row[ms_img]'></td>
                                    <td><a href='delete.php? Id= $row[mission_id]' class = 'btn'>Delete</a></td>
                                    <td><a href='update_mission.php? Id= $row[mission_id]' class = 'btn'>Update</a></td>
                                </tr>
                                ";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- -----------------------Add products ends here----------------------- -->

        </main>
    </div>
</body>

</html>