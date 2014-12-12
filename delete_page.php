<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php $user_type= user_type_set(); ?>
<?php checking_authority(); ?>
<?php confirm_logged_in(); ?>

<?php
    if (intval($_GET['page'])==0)
        redirect_to("content.php");
        $id=$_GET['page'];
        $page = get_page_by_id($id);
        $position_target= $page['position'];
        
            if (!empty($page)) {
                $subject_id = $page['subject_id'];
                $result_set = get_all_pages_for_subject($subject_id,"admins");
                $page_count = mysql_num_rows($result_set);
                
                if ($page['position'] == $page_count) {
                    $query = "DELETE FROM pages WHERE id=$id";
                    $result = mysql_query($query,$connection);
		    $result1 = delete_all_comments_for_page($id, $connection);		    
                    if ($result && $result1) {
                    redirect_to("messege.php?value=1 && name=page && type=delet");                
                    } else {
                    redirect_to("messege.php?value=0 && name=page && type=delet");                
                    }
                } else {
        	    $ids = array();
        	    while ($result = mysql_fetch_array($result_set)) {
        		$ids[$result['position']] = $result['id'];
        	    }
                    $query = "DELETE FROM pages WHERE id={$id}";
		    $result2 = delete_all_comments_for_page($id, $connection);
                    $result1 = mysql_query($query, $connection);
                    if (mysql_affected_rows()==1) {
                        $result = 1;
                    } else {
                        redirect_to("messege.php?value=0 && name=subject && type=delet");
                    }
                    $i=$position_target+1;
                    for (;$i<=$page_count;$i++) {
                    $query = "UPDATE pages
                            SET position=$i-1
                            WHERE id=$ids[$i]";
                    $error_check = mysql_query($query,$connection);
                    confirm_query($error_check);
                    }
                    
                    if ($result == 1 && $result2) {
                        redirect_to("messege.php?value=1 && name=page &&type=delet");
                    }  else echo "nothing happened";
                }
                    
            }
?>
<?php mysql_close($connection); ?>