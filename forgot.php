<?php
session_start();
include("config.php");

// Initialize a boolean variable to control the display of the password update fields
$showPasswordUpdateForm = false;
$message = ""; // Initialize the message variable

if (isset($_POST['reset_pass'])) {
  $email = $_POST['u_email'];
  $user_id = $_POST['id'];

  $result = mysqli_query($conn, "SELECT * FROM account WHERE email='$email' AND id='$user_id'");

  if (mysqli_num_rows($result) > 0) {
    $showPasswordUpdateForm = true; // Set to true when the email and user ID are correct
  } else {
    $message = "Invalid email or user ID.";
  }
}

if (isset($_POST['update_password'])) {
    $new_pass = $_POST['new_password'];
    $con_pass = $_POST['confirm_password'];

    // Retrieve the user ID again from the form
    $user_id = $_POST['id'];

    if ($new_pass == $con_pass) {
        // Update the password using a simple SQL statement
        $update_query = "UPDATE account SET password='$new_pass' WHERE id='$user_id'";
        $update_result = mysqli_query($conn, $update_query);

        if ($update_result) {
            $message = "Password updated successfully.";
        } else {
            $message = "Failed to update password.";
        }
    } else {
        $message = "Passwords must match.";
    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Password Reset</title>
  <link rel="stylesheet" href="css/style2.css">
</head>
<body>
<?php
include('nav/header.php');
?>
  <div class="container">
    <?php
    if ($showPasswordUpdateForm) {
      // Display the password update form when the email and user ID are correct
    ?>
    <form method="POST">
      <p style="color: rgb(238, 44, 44);"><?php echo $message; ?></p>
      <label for="chk" aria-hidden="true">Update Password</label>
      <div class="inputForm">
      <input type="password" name="new_password" placeholder="New Password" required="">
      </div>
      <div class="inputForm">
      <input type="password" name="confirm_password" placeholder="Confirm New Password" required="">
      </div>
      <input type="hidden" name="id" value="<?php echo $user_id; ?>"> <!-- Add a hidden field to store the user ID -->
      <div class="loginBtn">
      <input type="submit" name="update_password"></input>
      </div>
    </form>
    <?php
    } else {
      // Display the initial form for email and user ID input
    ?>
    <form method="POST">
      <p style="color: rgb(238, 44, 44);"><?php echo $message; ?></p>
      <label for="chk" aria-hidden="true">Forgot Password</label>
      <div class="inputForm">
        <input type="email" name="u_email" placeholder="Email" required="">
      </div>
      <div class="inputForm">
        <input type="text" name="id" placeholder="User ID" required="">
      </div>
      <div class="loginBtn">
      <input type="submit" name="reset_pass"></input>
      </div>
    </form>
    <?php
    }
    ?>
    <div class="fpass">
    <a href="login.php">Login</a>
    </div>
  </div>
</body>
</html>

  <script>
    function hideMessage() {
      var errorMessage = document.querySelector('.error-message');
      errorMessage.style.display = 'none';
    }
  </script>
</body>


</html>
<style>
  @import url('css/colorCodes.css');
  .container{
    margin-top: 11%;
    left: 35%;
    max-width: 380px;
    width: 100%;
    border-radius: 11px;
    background-color: rgba(0, 0, 0, 0.7);
    box-shadow: 0 5px 10px black;
    position: relative;
    padding: 30px;
    color: #fff;
  }
  
  .container .loginTitle { 
    font-weight: bolder;
    color: #70efbf;
    font-size: 35px;
    font-family: 'Bruno Ace SC', 'sans-serif';
    text-align: center;
  }
  
  .container .inputForm {
    margin-top: 30px;
    position: relative;
    height: 50px;
    width: 100%;
  }
  
  .container input[type="email"],
  .container input[type="password"],
  .container input[type="text"],
  {
      width: 95%;
      margin-top: 10px;
      padding: 10px;
      font-size: 16px;
      border: none;
      border-bottom: 2px solid #70efbf;
      border-top: 2px solid transparent;
      background-color: rgba(0, 0, 0, 0.3);
      border-radius: 10px;
      color:white;
      outline: none;
    }

    .container input[type="text"]
  {
      width: 95%;
      margin-top: 10px;
      padding: 10px;
      font-size: 16px;
      border: none;
      border-bottom: 2px solid #70efbf;
      border-top: 2px solid transparent;
      background-color: rgba(0, 0, 0, 0.3);
      border-radius: 10px;
      color:white;
      outline: none;
    }

  
  .container input[type="email"]::placeholder,
  .container input[type="password"]::placeholder {
    color: #cdc6c3;
  }
  
  .container .fpass {
    margin-top: 15px;
    font-size: 15px;
    text-align: center;
  }
  
  .container .fpass a {
    color: #70efbf;
    text-decoration: none;
  }
  
  .container .fpass a:hover {
    text-decoration: underline;
  }
  
  .container .loginBtn {
    padding: 10px 0px 10px 0px;
    text-align: center;
  }
  
  .container input[type="submit"] {
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
  
  .container input[type="submit"]:hover {
    background: linear-gradient(180deg, #70efbf 0, #12bd7b 100%);
    box-shadow: 0 3px 9px #25b981;
    color: #fff;
  }
  
  .container .signup {
    text-align: center;
  }
  
  .container .signup a {
    color: #fff;
    text-decoration: none;
  }
  
  .container .signup a:hover {
    text-decoration: underline;
  }
    </style>
