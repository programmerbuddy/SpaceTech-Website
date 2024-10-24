<?php
@include 'config.php';

if (isset($_POST['register'])) {

  $name = $_POST['name'];
  $email = $_POST['email'];
  $pass = $_POST['password'];
  $cpass = $_POST['cpassword'];
  $mobile = $_POST['mobile'];
  $education = $_POST['education'];

  $select_users = mysqli_query($conn, "SELECT * FROM account WHERE email = '$email'") or die('Query failed');

  if (mysqli_num_rows($select_users) > 0) {
    $message[] = 'User already exists!';
  } else {
    if ($pass != $cpass) {
      $message[] = 'Confirm password does not match!';
    } else {
      mysqli_query($conn, "INSERT INTO `account`(username, email, password, mobile, education) VALUES('$name', '$email', '$pass', '$mobile', '$education')") or die('Query failed');
      $message[] = 'Registered successfully!';
      header('location: login.php');
    }
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
<html>

<head>
  <link href='https://fonts.googleapis.com/css?family=Bruno Ace SC' rel='stylesheet'>
  <link rel="stylesheet" href="css/style2.css">
  <title>Registration Form</title>
  <style>
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

    /* Style for the container */
/* Style for the container */
/* Style for the container */
.container1 {
  background-color: rgba(0, 0, 0, 0.7);
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 5px 10px black;
  width: 700px;
  max-width: 1000px; /* Maximum width for the container */
  height: auto; /* Set height to auto */
  margin: 12% auto; /* Center the container horizontally */
}


/* Style for the form title */
.logintitle {
  font-weight: bolder;
  color: #70efbf;
  font-size: 30px;
  margin-bottom: 15px;
  font-family: 'Bruno Ace SC', 'sans-serif';
  text-align: center;
}

/* Style for each input row */
.inputRow {
  display: flex;
  justify-content: space-evenly;
  margin-bottom: 50px;
  margin-left: -80px;
}

/* Style for input fields and select */
.inputForm1 input,
.inputForm1 select {
  flex: 1; /* Distribute equal width within the row */
  margin-top: 10px;
  padding: 10px;
  width: 130%;
  font-size: 16px;
  border: none;
  border-bottom: 2px solid #70efbf;
  border-top: 2px solid transparent;
  background-color: rgba(0, 0, 0, 0.3);
  border-radius: 10px;
  color: white;
  outline: none;
}

/* Style for input placeholders */
.inputForm1 input::placeholder {
  color: #cdc6c3;
}

/* Style for the submit button */
.loginbtn {
  margin-top: 20px;
  text-align: center;
}

.container1 input[type="submit"] {
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
}

.container1 input[type="submit"]:hover {
  background: linear-gradient(180deg, #70efbf 0, #12bd7b 100%);
  box-shadow: 0 3px 9px #25b981;
  color: #fff;
}

/* Style for the signup link */
.signup1 {
  text-align: center;
  color: #70efbf;
}

.container1 .signup1 a {
  color: #fff;
  text-decoration: none;
}

.container1 .signup1 a:hover {
  text-decoration: underline;
}

  </style>
</head>

<body>


    <?php
    @include('nav/header.php');
    ?>

<div class="container1">
    <div class="form1">
        <form action="" method="post">
            <span class="logintitle">Register</span>
            
            <!-- First Row -->
            <div class="inputRow">
                <div class="inputForm1">
                    <input type="text" placeholder="Enter your Name" name="name" required>
                </div>
                <div class="inputForm1">
                    <input type="email" placeholder="Enter your Email" name="email" required>
                </div>
            </div>
            
            <!-- Second Row -->
            <div class="inputRow">
                <div class="inputForm1">
                    <input type="tel" placeholder="Enter your Mobile Number" name="mobile" required>
                </div>
                <div class="inputForm1">
                    <input type="password" placeholder="Enter your password" name="password" required>
                </div>
            </div>
            
            <!-- Third Row -->
            <div class="inputRow">
                <div class="inputForm1">
                    <input type="password" placeholder="Confirm password" name="cpassword" required>
                </div>
                <div class="inputForm1">
                    <select name="education" required>
                        <option value="" disabled selected>Select your Qualification</option>
                        <option value="10th">10th</option>
                        <option value="12th">12th</option>
                        <option value="undergraduate">Undergraduate</option>
                        <option value="postgraduate">Postgraduate</option>
                    </select>
                </div>
            </div>

            <div class="loginbtn">
                <input type="submit" name="register" value="Register Now">
            </div>
        </form>
    </div>
</div>


  </body>

  </html>

