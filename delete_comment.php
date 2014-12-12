<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php
    $id = mysql_prep($_GET['id']);
    $page = $_GET['page'];
    $query = "DELETE FROM comments
            WHERE id={$id}";
    echo $query;
    $result = mysql_query($query,$connection);
    if ($result) {
        redirect_to("index.php?page={$page}&&messege=delet");
    } else {
        echo "database error" . mysql_error();
    }
?>
