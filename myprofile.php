<?php
@include('config.php');
session_start();
$user_id = $_SESSION['userid'];
if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $educations = $_POST['education'];

    if (!empty($username)) {
        mysqli_query($conn, "UPDATE `account` SET username = '$username' WHERE id = '$user_id'") or die(mysqli_error($conn));
    }
    if (!empty($mobile)) {
        mysqli_query($conn, "UPDATE `account` SET mobile = '$mobile' WHERE id = '$user_id'") or die(mysqli_error($conn));
    }
    if (!empty($email)) {
        mysqli_query($conn, "UPDATE `account` SET email = '$email' WHERE id = '$user_id'") or die(mysqli_error($conn));
    }
    if (!empty($education)) {
        mysqli_query($conn, "UPDATE `account` SET education = '$educations' WHERE id = '$user_id'") or die(mysqli_error($conn));
    }

    // Fetch the updated user information from the database and update session variables
    $result = mysqli_query($conn, "SELECT * FROM `account` WHERE id = '$user_id'");
    $row = mysqli_fetch_assoc($result);
    $_SESSION['username'] = $row['username'];
    $_SESSION['userMobile'] = $row['mobile'];
    $_SESSION['educations'] = $row['education'];
    $_SESSION['useremail'] = $row['email'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style2.css">
    <title>User Registration Form</title>
    <style>
        /* Styles for User Registration Form */

        .update-form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(16, 18, 54, 0.8);
            /* Adjust transparency here */
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.7);
            color: #fff;
        }

        .update-form h2 {
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
            color: #70efbf;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 18px;
            margin-bottom: 6px;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="tel"],
        .form-group select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-bottom: 2px solid #70efbf;
            background-color: rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            color: #fff;
            outline: none;
        }

        .form-group select {
            appearance: none;
            /* Remove default select styles */
            -webkit-appearance: none;
            -moz-appearance: none;
            background-repeat: no-repeat;
            background-position: right center;
            background-size: 20px;
            padding-right: 30px;
        }

        .form-group input[type="text"]::placeholder,
        .form-group input[type="email"]::placeholder,
        .form-group input[type="tel"]::placeholder,
        .form-group select::placeholder {
            color: #cdc6c3;
        }

        .form-group button[type="submit"],
        .form-group button[type="button"] {
            width: 100%;
            padding: 10px;
            font-weight: bold;
            border: none;
            background: linear-gradient(180deg, #70efbf 0, #21c69a 100%);
            border-radius: 10px;
            cursor: pointer;
            color: #000;
            font-size: 16px;
            transition: all 0.4s ease;
            margin-top: 10px;
        }

        .form-group button[type="submit"]:hover,
        .form-group button[type="button"]:hover {
            background: linear-gradient(180deg, #70efbf 0, #12bd7b 100%);
            box-shadow: 0 3px 9px #25b981;
            color: #fff;
        }
    </style>
</head>

<body>

    <?php
    @include('nav/header.php');
    ?>

    <div class="update-form">
        <h2>User Registration</h2>
        <form action="#" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="mobile">Mobile Number:</label>
                <input type="tel" id="mobile" name="mobile">
            </div>
            <div class="form-group">
                <label for="education">Education:</label>
                <select id="education" name="education">
                    <option value="" disabled selected>Select your Qualification</option>
                    <option value="10th" name='10th'>10th</option>
                    <option value="12th" name='12th'>12th</option>
                    <option value="undergraduate" name='undergraduate'>Undergraduate</option>
                    <option value="postgraduate" name='postgraduate'>Postgraduate</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" name="update">Submit</button>
                <button type="button" onclick="window.location.href='profile_header.php'">Cancel</button>
            </div>
        </form>
    </div>
</body>

</html>