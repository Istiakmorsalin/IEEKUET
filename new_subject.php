<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php checking_authority(); ?>
<?php confirm_logged_in(); ?>
<?php set_up_variables("admins"); ?>
<?php include("includes/header.php"); ?>

<?php
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
		$result_set = get_all_subjects("admins");
		$subject_count = mysql_num_rows($result_set);
		$position_target=$position;
		
		if ($subject_count+1==$position_target) {
			$query = "INSERT INTO subjects (
	                        menu_name, position, visible
	                        ) VALUES (
	                        '{$menu_name}', {$position}, {$visible}
	                        )";
	                $result = mysql_query($query, $connection);
	                if ($result) {
	                        redirect_to("content.php");
	                }
	                else {
	                        echo "<p>Subject creation failed</p>";
	                        echo "<p>" . mysql_error() . "</p>";
	                }
		} else {
			$ids = array();
			while ($result = mysql_fetch_array($result_set)) {
				$ids[$result['position']] = $result['id'];
			}
			$i = $subject_count;
			for (;$i>=$position_target;$i--) {
				$query = "UPDATE subjects
					SET position=$i+1
					WHERE id=$ids[$i]";
				$error_check = mysql_query($query,$connection);
				confirm_query($error_check);
			}

			$query = "INSERT INTO subjects (
	                        menu_name, position, visible
	                        ) VALUES (
	                        '{$menu_name}', {$position}, {$visible}
	                        )";
	                $result1 = mysql_query($query, $connection);
	                if ($result1) {
	                        redirect_to("content.php");
	                }
	                else {
	                        echo "<p>Subject creation failed</p>";
	                        echo "<p>" . mysql_error() . "</p>";
	                }
			
		}
        }
?>
<link rel="stylesheet" href="css/public1.css" type="text/css" media="all">
    <div id="main">
        <table id="structure">
            <tr>
                <td id="navigation">
                <?php content_navigation ("admins",$sel_page); ?>
                <br/>
                </td>
                <td id="page">
                        <h2>Add new subject<hr/></h2>
                        <form action="new_subject.php" method="post">
                                <p>Subject name:
                                        <input type="text" name="menu_name" value="" id="menu_name" />
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
                                                $subject_set = get_all_subjects ("admins");
                                                $subject_count = mysql_num_rows($subject_set);
                                                for ($count=1; $count <=$subject_count; $count++) {
                                                        echo "<option value={$count}>{$count}</option>";
                                                }
                                                $count= $subject_count+1;
						echo "<option value=\"{$count}\" selected>{$count}</option>";
                                                
                                        ?>        
                                        </select>
                                </p>
                                
                                <p>Visible:
                                        <input type="radio" name="visible" value="0"/>No
                                        &nbsp;
					<input type="radio" name="visible" value="1" checked/> Yes
				</p>
                                
                                <input type="submit" name="submit" value="Add subject" />
                                
                        </form>

			<a href="content.php">Cancel</a>
                        
                </td>
                <td id="m_navigation">
                    <h3><a href="content.php" id="select">Home</a></h3>
                    <h3><a href="profile.php">Profile</a></h3>
                 
                    <h3><a href="content.php" id="select">View Contents</a></h3>		    
                    <h3><a href="admin.php">Admin's Page</a></h3>                    		    
		    <h3><a href="log_out.php">Logout</a></h3>
                </td>
		
            </tr>
        </table>
    </div>
<?php include("includes/footer.php"); ?>