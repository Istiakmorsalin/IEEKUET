<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php $user_type= user_type_set(); ?>
<?php checking_authority(); ?>
<?php confirm_logged_in(); ?>
<?php
    if (intval($_GET['id'])==0)
        redirect_to("content.php");
    $subject= get_subject_by_id($_GET['id']);
   
    if (!empty($subject)) {
	$result_set = get_all_subjects($user_type);
	$subject_count = mysql_num_rows($result_set);
        $id=$_GET['id'];
        $result_for_check = get_subject_by_id($id);
        $position_target=$result_for_check['position'];
        
        if ($position_target == $subject_count) {
            $query = "DELETE FROM subjects WHERE id={$id}";
            $result1 = mysql_query($query, $connection);
            if (mysql_affected_rows()==1) {
                $result = 1;
            } else {
                redirect_to("messege.php?value=0 && name=subject && type=delet");
            }
        } else {
	    $ids = array();
	    while ($result = mysql_fetch_array($result_set)) {
		$ids[$result['position']] = $result['id'];
	    }
            $query = "DELETE FROM subjects WHERE id={$id}";
            $result1 = mysql_query($query, $connection);
            if (mysql_affected_rows()==1) {
                $result = 1;
            } else {
                redirect_to("messege.php?value=0 && name=subject && type=delet");
            }
            
            $i=$position_target+1;
            for (;$i<=$subject_count;$i++) {
                $query = "UPDATE subjects
                        SET position=$i-1
                        WHERE id=$ids[$i]";
                $error_check = mysql_query($query,$connection);
                confirm_query($error_check);
            }           
        }
        
        $page = get_all_pages_for_subject($id,$user_type);
            if (!empty($page)) {
                $subject_id = $id;
		while ($page_set = mysql_fetch_array($page)) {
		    $result3 = delete_all_comments_for_page ($page_set['id'] , $connection);		    
		}
                $query = "DELETE FROM pages WHERE subject_id=$subject_id";
                $result2 = mysql_query($query,$connection);
                if (!$result2) {
                redirect_to("messege.php?value=0 && name=subject && type=delet");                
                } else if ($result == 1) {
                    redirect_to("messege.php?value=1 && name=subject && type=delet");                
                }
            }
    }
?>
<?php mysql_close($connection); ?>