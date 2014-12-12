<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>
<?php $user_type = user_type_set (); ?>
<?php checking_authority(); ?>
<?php confirm_logged_in(); ?>
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
                $menu_name = mysql_prep($_POST['menu_name']);
                $position = mysql_prep($_POST['position']);
                $visible = mysql_prep($_POST['visible']);
                $content = mysql_prep ($_POST['content']);
                $id=$_GET['page'];
		
		$result_for_check = get_page_by_id($id);
		
		if ($result_for_check['position'] == $position) {
			$query = "UPDATE pages SET
				menu_name='$menu_name', position=$position , visible = $visible, content = '$content'
				WHERE id=$id";
			$result = mysql_query($query , $connection);
			if (mysql_affected_rows() == 1) {
			       $messege = 1;
			} else {
			       $messege = 0;
			}
		} else {
			$ids = array();
			$result_set = get_all_pages_for_subject($result_for_check['subject_id'],"admins");
			$page_count = mysql_num_rows($result_set);
			while ($result = mysql_fetch_array($result_set)) {
				$ids[$result['position']] = $result['id'];
			}
			
			$position_target = $_POST['position'];
			$position_old = $result_for_check['position'];
			$position_temp = $page_count+1;
			
			$query = "UPDATE pages
				SET menu_name='$menu_name', position=$position_temp , visible = $visible, content = '$content'
				WHERE id=$id";

			$error_check = mysql_query($query,$connection);
			confirm_query($error_check);
			if ($position_old > $position_target) {
				$i = $position_old-1;
				for (;$i >= $position_target;$i--) {
					$query = "UPDATE pages
						SET position=$i+1
						WHERE id=$ids[$i]";
					$error_check = mysql_query($query,$connection);
					confirm_query($error_check);
				}
			} else if ($position_old < $position_target) {
				$i = $position_old+1;	
				for (;$i <= $position_target;$i++) {
					$query = "UPDATE pages
						SET position=$i-1
						WHERE id=$ids[$i]";
					$error_check = mysql_query($query,$connection);
					confirm_query($error_check);
				}
			}

			$query = "UPDATE pages
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
                redirect_to ("delete_page.php?page={$_GET['page']}");
        }
?>
<?php set_up_variables($user_type); ?>
<link rel="stylesheet" href="css/public1.css" type="text/css" media="all">

<div id="main">
    <table id="structure">
        <tr>
            <td id="navigation">
            <?php content_navigation ($user_type,$sel_page); ?>
            <br/>
            </td>
            <td id="page">
                    <h2>Edit page:  <?php echo $sel_page['menu_name']; ?> </h2>
                    <form action="edit_page.php?page=<?php echo $_GET['page']; ?>&&sub_id=<?php echo $_GET['sub_id']; ?>" method="post">
                        <?php
                                if (!empty ($messege) && $messege == 1) {
                                        redirect_to("messege.php?value=$messege && name=page && type=edit");
                                } else if (!empty ($messege) && $messege == 0)
                                        echo "The page was not succesfully edited.";
                        ?>
                            <p>Page name:
                                    <input type="text" name="menu_name" value="<?php echo $sel_page['menu_name']; ?>" id="menu_name" />
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
                                            $subject_id = $_GET['sub_id'];
                                            $page_set =get_all_pages_for_subject($subject_id, $user_type);
                                            $page_count = mysql_num_rows($page_set);
                                            for ($count=1; $count <=$page_count; $count++) {
                                                    echo "<option value={$count}";
                                                    if ($count == $sel_page['position'])
                                                        echo " selected";
                                                    echo ">{$count}</option>";
                                            }
                                            if (!isset($sel_page)) {
                                                $count= $page_count+1;
						echo "<option value=\"{$count}\" selected>{$count}</option>";
                                            }
                                    ?>        
                                    </select>
                            </p>
                            
                            <p>Visible:
                                    <input type="radio" name="visible" value="0"
                                    <?php if (isset($sel_page)) {if ($sel_page['visible']==0) echo "checked";} ?>/>No
                                    &nbsp;
                                    <input type="radio" name="visible" value="1"
                                    <?php if (isset($sel_page)) {if ($sel_page['visible']==1) echo "checked";} else echo" checked"; ?>/> Yes
                            </p>
                            
                            <p>Content: <br/><br/>
                                <textarea name="content" rows="20" cols="80"><?php echo $sel_page['content']; ?> </textarea>
                            </p>
                            <input type="submit" name="submit" value="Edit page" onclick="return confirm('Are you sure you want to edit this page?');"/>
                            <input type="submit" name="submit2" value="Delete page" onclick="return confirm('Are you sure you want to delete this page?');"/>
                            <br/>
                            </form>
                        <a href="content.php">Cancel</a>
                    
            </td>
                <td id="m_navigation">
                    <h3><a href="content.php" id="select">Home</a></h3>
                    <h3><a href="profile.php">Profile</a></h3>
                   
                    <h3><a href="admin.php">Admin's Page</a></h3>                    		    
                    <h3><a href="content.php" id="select">View Contents</a></h3>		    
                    <h3><a href="log_out.php">Logout</a></h3>
                </td>

        </tr>
    </table>
</div>
<?php include("includes/footer.php"); ?>