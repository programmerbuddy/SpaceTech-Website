<?php
session_start();
include("config.php");

if (isset($_POST['Login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $select_users = mysqli_query($conn, "select* from account where email='$email'");
  if (mysqli_num_rows($select_users) > 0) {
    $row = mysqli_fetch_assoc($select_users);
    if ($row['password'] === $_POST['password']) {
      if ($row['user_type'] == 'user') {
        $_SESSION['username'] = $row['username'];
        $_SESSION['useremail'] = $row['email'];
        $_SESSION['userid'] = $row['id'];
        header('location: home.php');
      } elseif ($row['user_type'] == 'admin') {
        $_SESSION['adminname'] = $row['username'];
        $_SESSION['adminemail'] = $row['email'];
        $_SESSION['admin_id'] = $row['id'];
        header('location: admin_page.php');
      } else {
        echo "<script type='text/javascript'>alert('invalid password')</script>";
      }
    }
  } else {
    echo "<script type='text/javascript'>alert('invalid username')</script>";
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
  <title>Login Form</title>

</head>

<body>
  <?php
  @include('nav/header.php');
  ?>

  <div class="container">
    <div class="form">
      <span class="loginTitle">Login</span>
      <form action="" method="post">
        <div class="inputForm">
          <input type="email" placeholder="Enter your Email" name="email" required>
        </div>
        <div class="inputForm">
          <input type="password" placeholder="Enter your password" name="password" required>
        </div>

        <div class="fpass">
          <a href="forgot.php">Forgot password?</a>
        </div>
        <div class="loginBtn">
          <input type="submit" name="Login" value="Login Now">
        </div>
      </form>
      <div class="signup">
        <span>Not a member?
          <a href="regis.php">Sign up</a>
        </span>
      </div>
    </div>
  </div>

</body>

<?php @include 'footer.php'; ?>

</html>