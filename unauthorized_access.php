<?php
@include('config.php');
session_start();
?>
<?php
if (isset($_POST['delete'])) {
    $user_id_to_delete = $_POST['user_id'];

    // Start a database transaction.
    mysqli_autocommit($conn, false);

    // Delete user's research data first (assuming a foreign key relationship).
    $delete_research_query = "DELETE FROM research WHERE userid = $user_id_to_delete";
    $result = mysqli_query($conn, $delete_research_query);

    if ($result) {
        // Research data deleted successfully, now delete the user's account.
        $delete_user_query = "DELETE FROM users WHERE id = $user_id_to_delete";
        $result = mysqli_query($conn, $delete_user_query);

        if ($result) {
            // Commit the transaction.
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
