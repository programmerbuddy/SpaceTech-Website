<?php
@include 'config.php';
session_start();

if (isset($_POST['send_msg'])) {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $message = $_POST['messages'];
    $user_id = $_SESSION['id'];

    if ($name && $email && $message) {

        $query = "INSERT INTO message (id,name, email, message) VALUES ('$user_id','$name', '$email', '$message')";
        if (mysqli_query($conn, $query)) {
            echo "Message sent successfully!";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Please fill in all the required fields.";
    }
}

?>
<!-- #region -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SpaceTech - Contact Us</title>
    <link rel="stylesheet" href="css/style2.css">
</head>
<?php
@include('nav/header.php');
?>

<body>
    <div class="contact-section">

        <div class="grid-container">
            <div class="left-section">
                <img src="img/contactbg.png" alt="Contact Image">
            </div>
            <div class="right-section">
                <form method='POST'>
                    <h1>Contact Us</h1>
                    <div class="inputForm">
                        <input type="text" name="username" placeholder="Your Name" required>
                    </div>
                    <div class="inputForm">
                        <input type="email" name="email" placeholder="Your Email" required>
                    </div>
                    <div class="inputForm">
                        <textarea name="messages" placeholder="Your Message" required></textarea>
                    </div>
                    <div class="btn-container">
                        <button class="btn" name="send_msg" type="submit">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>



</body>
<style>
    /* Add the provided CSS code here */
    body {
        font-family: Arial, sans-serif;
        background-color: #111;
        color: #fff;
    }

    .grid-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        margin-top: 40px;
    }

    .left-section img {
        max-width: 100%;
        border-radius: 10px;
    }

    .right-section {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    /* Rest of the provided CSS styles */
    .contact-section {
        padding: 100px 12%;
    }

    .contact-section h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: var(--hover-color);
    }

    .contact-section p {
        font-size: 1.2rem;
        line-height: 1.6;
    }

    .contact-section form {
        margin-top: 2rem;
    }

    .contact-section .inputForm {
        margin-bottom: 1.5rem;
        position: relative;
        height: 50px;
    }

    .contact-section input[type="text"],
    .contact-section input[type="email"],
    .contact-section textarea {
        outline: none;
        height: 100%;
        position: absolute;
        width: 100%;
        border: none;
        border-bottom: 2px solid #70efbf;
        border-top: 2px solid transparent;
        background: none;
        color: #fff;
        padding: 5px;
        font-size: 16px;
    }

    .contact-section input[type="text"]::placeholder,
    .contact-section input[type="email"]::placeholder,
    .contact-section textarea::placeholder {
        color: #cdc6c3;
    }

    .contact-section .btn-container {
        margin-top: 2rem;
        text-align: center;
    }

    .contact-section .btn {
        display: inline-block;
        background: linear-gradient(180deg, #70efbf 0, #21c69a 100%);
        color: #000;
        font-size: 1rem;
        font-weight: 700;
        padding: 10px 30px;
        border-radius: 10px;
        cursor: pointer;
        text-align: center;
        transition: all 0.4s ease;
    }

    .contact-section .btn:hover {
        background: linear-gradient(180deg, #70efbf 0, #12bd7b 100%);
        box-shadow: 0 3px 9px #25b981;
        color: #fff;
    }

    /* Hover Animation */
    .btn:hover {
        transform: scale(1.05);
    }
</style>


<?php @include 'nav/footer.php'; ?>

</html>