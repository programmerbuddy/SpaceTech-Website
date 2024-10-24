<?php
@include('config.php');
session_start();

if(isset($_GET['Id'])){
    $msn_id = $_GET['Id'];
    $delete_mission = "DELETE FROM missions WHERE mission_id = $msn_id";
    $result = mysqli_query($conn, $delete_mission);
    header('location:admin_page.php');
}


if(isset($_GET['userId'])){
    $msg_id = $_GET['userId'];
    $delete_message = "DELETE FROM message WHERE id = $msg_id";
    $result = mysqli_query($conn, $delete_message);
    header('location:admin_page.php');
}



if (isset($_GET['user_Id'])) {
    $user_id_to_delete = $_GET['user_Id'];

    // Delete user's research data based on their user_id (assuming a foreign key relationship).
    $delete_research_query = "DELETE FROM research WHERE user_id = '$user_id_to_delete'";
    $result_research = mysqli_query($conn, $delete_research_query);

    if ($result_research) {
        // Research data deleted successfully, now delete the user's account.
        $delete_user_query = "DELETE FROM account WHERE id = $user_id_to_delete";
        $result_user = mysqli_query($conn, $delete_user_query);

        if ($result_user) {
            // Commit the transaction if both queries are successful.
            mysqli_commit($conn);
            // Redirect back to the admin page with a success message.
            header("Location: admin_page.php?message=success");
            exit;
        } else {
            // Rollback the transaction if user account deletion fails.
            mysqli_rollback($conn);
            // Redirect back to the admin page with an error message.
            header("Location: admin_page.php?message=error");
            exit;
        }
    } else {
        // Rollback the transaction if research data deletion fails.
        mysqli_rollback($conn);
        // Redirect back to the admin page with an error message.
        header("Location: admin_page.php?message=error");
        exit;
    }
}
?>
