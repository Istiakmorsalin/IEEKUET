<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
    if (intval($_GET['id'])==0)
        redirect_to("content.php");
    if (get_subject_by_id($_GET['id'])) {
        $id=$_GET['id'];
        $query = "DELETE FROM subjects WHERE id={$id}";
        $result = mysql_query($query, $connection);
        if (mysql_affected_rows()==1) {
            redirect_to("messege.php?value=1 && name=subject && type=delet");
        } else {
            redirect_to("messege.php?value=0 && name=subject && type=delet");
        }
    }
?>
<?php mysql_close($connection); ?>
<link rel="stylesheet" href="css/public1.css" type="text/css" media="all">