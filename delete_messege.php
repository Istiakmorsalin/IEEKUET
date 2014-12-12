<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php  $user_type=user_type_set(); ?>
<?php set_up_variables($user_type); ?>
<?php confirm_logged_in(); ?>

<?php
    if (isset($_GET['id'])) {
        $query = "DELETE FROM messeges
                WHERE id = {$_GET['id']}";
        $result = mysql_query($query, $connection);
        if ($result) {
            if ($_GET['from'] == "all") {
            redirect_to("messeges.php?delete=1");
            }else if ($_GET['from'] == "sent") {
            redirect_to("sent_messeges.php?delete=1");
            }else if ($_GET['from'] == "received") {
            redirect_to("recieved_messeges.php?delete=1");
            }
        } else {
            echo "database error" . mysql_error();
        }
    }
?>

<?php mysql_close($connection); ?>