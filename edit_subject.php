<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php checking_authority(); ?>
<?php confirm_logged_in(); ?>
<?php $user_type=user_type_set(); ?>
<?php include("includes/header.php"); ?>

<?php
//Form validation
        $errors = array();
        $required_fields = array('menu_name');
        foreach ($required_fields as $field_name){
                if (!isset($_POST[$field_name]) || empty($_POST[$field_name]) ) {
                        $errors[] = $field_name;
                }
        }

?>

<?php
        if (isset($_POST['submit']) && empty($errors) ) {
                $id = mysql_prep($_GET['subj']);
                $menu_name = mysql_prep($_POST['menu_name']);
                $position = mysql_prep($_POST['position']);
                $visible = mysql_prep($_POST['visible']);

		$result_for_check = get_subject_by_id($_GET['subj']);

		if ($result_for_check['position']==$position) {
			$query = "UPDATE subjects SET menu_name='$menu_name', position=$position , visible = $visible WHERE id=$id";
			$result = mysql_query($query , $connection);
			if (mysql_affected_rows() == 1) {
			       $messege = 1;
			} else {
			       $messege = 0;
			}
		} else {
			$ids = array();
			$result_set = get_all_subjects($user_type);
			$subject_count = mysql_num_rows($result_set);
			while ($result = mysql_fetch_array($result_set)) {
				$ids[$result['position']] = $result['id'];
			}
			
			$position_target = $_POST['position'];
			$position_old = $result_for_check['position'];
			$position_temp = $subject_count+1;
			
			$query = "UPDATE subjects
				SET menu_name='$menu_name', position=$position_temp , visible = $visible
				WHERE id=$id";
			
			$error_check = mysql_query($query,$connection);
			confirm_query($error_check);
			if ($position_old > $position_target) {
				$i = $position_old-1;
				for (;$i >= $position_target;$i--) {
					$query = "UPDATE subjects
						SET position=$i+1
						WHERE id=$ids[$i]";
					$error_check = mysql_query($query,$connection);
					confirm_query($error_check);
				}
			} else if ($position_old < $position_target) {
				$i = $position_old+1;	
				for (;$i <= $position_target;$i++) {
					$query = "UPDATE subjects
						SET position=$i-1
						WHERE id=$ids[$i]";
					$error_check = mysql_query($query,$connection);
					confirm_query($error_check);
				}
			}
			
			$query = "UPDATE subjects
				SET position=$position_target
				WHERE id=$id";
			mysql_query($query,$connection);
			if (mysql_affected_rows() == 1) {
			       $messege = 1;
			} else {
			       $messege = 0;
			}

		}
        }
?>

<?php
        if (isset($_POST['submit2']) && empty($errors) ) {
                redirect_to ("delete_subject.php?id={$_GET['subj']}");
        }
?>
<?php
        if (isset($_POST['submit3']) && empty($errors) ) {
                redirect_to ("new_page.php?subj={$_GET['subj']}");
        }
?>
<?php set_up_variables($user_type); ?>
<link rel="stylesheet" href="css/public1.css" type="text/css" media="all">
<div id="main_ex">
    <table id="structure">
        <tr>
            <td id="navigation">
            <?php content_navigation ($user_type,$sel_page); ?>
            <br/>
            </td>
            <td id="page">
                    <h2>Edit subject:  <?php echo $sel_subject['menu_name']; ?> </h2>
                    <form action="edit_subject.php?subj=<?php echo urlencode($_GET['subj']); ?>" method="post">
                        <?php
                                if (!empty ($messege) && $messege == 1) {
                                        redirect_to("messege.php?value=$messege && name=subject && type=edit");
                                } else if (!empty ($messege) && $messege == 0)
                                        echo "The subject was not succesfully edited.";
                        ?>
                            <p>Subject name:
                                    <input type="text" name="menu_name" value="<?php echo $sel_subject['menu_name']; ?>" id="menu_name" />
                                        <?php 
                                                if (isset($_POST['submit']) && !empty($errors) ) {
                                                        foreach ($errors as $error) {
                                                                if ($error == "menu_name") {
                                                                        echo "Please type menu name.";
                                                                }
                                                        }
                                                }
                                        ?>
                            </p>
                            
                            <p>Position:
                                    <select name="position">
                                    <?php
                                            $subject_set = get_all_subjects ($user_type);
                                            $subject_count = mysql_num_rows($subject_set);
                                            for ($count=1; $count <=$subject_count; $count++) {
                                                    echo "<option value={$count}";
                                                    if ($count == $sel_subject['position'])
                                                        echo " selected";
                                                    echo ">{$count}</option>";
                                            }
                                            if (!isset($sel_subject)) {
                                                $count= $subject_count+1;
						echo "<option value=\"{$count}\" selected>{$count}</option>";
                                            }
                                    ?>        
                                    </select>
                            </p>
                            
                            <p>Visible:
                                    <input type="radio" name="visible" value="0"
                                    <?php if (isset($sel_subject)) {if ($sel_subject['visible']==0) echo "checked";} ?>/>No
                                    &nbsp;
                                    <input type="radio" name="visible" value="1"
                                    <?php if (isset($sel_subject)) {if ($sel_subject['visible']==1) echo "checked";} else echo" checked"; ?>/> Yes
                            </p>
                            
                            <input type="submit" name="submit" value="Edit subject" onclick="return confirm('Are you sure you want to edit this subject?');"/>
                            <input type="submit" name="submit2" value="Delete subject" onclick="return confirm('Are you sure you want to delete this subject?');"/>
                            <br/><br/>
                            <hr/>
                            <h3>Pages in this subject:</h3>
                                <ul>
                                        <?php
                                             $page_se=get_all_pages_for_subject($_GET['subj'],"admins");
                                             while ($page_s=mysql_fetch_array($page_se)) {
                                                echo "<li>";
                                                echo "<a href=\"content.php?page={$page_s['id']}\">";
                                                echo "{$page_s['menu_name']}";
                                                echo "</a>";
                                                echo "</li>";
                                             }
                                        ?>
                                </ul>
                        <br/>
                            + <a href="new_page.php?subj=<?php echo $_GET['subj']; ?>">Add a new page to this subject</a>
                            
                        </form>
                        <a href="content.php">Cancel</a>
                    
            </td>
                <td id="m_navigation">
                    <h3><a href="content.php" id="select">Home</a></h3>
                    <h3><a href="profile.php">Profile</a></h3>
                    <h3><a href="messeges.php">Messeges</a></h3>
                    <h3><a href="content.php" id="select">View Contents</a></h3>		    
                    <h3><a href="admin.php">Admin's Page</a></h3>                    		    
		    <h3><a href="log_out.php">Logout</a></h3>
                </td>
        </tr>
    </table>
</div>
<?php include("includes/footer.php"); ?>