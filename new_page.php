<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php checking_authority(); ?>
<?php confirm_logged_in(); ?>
<?php $user_type=user_type_set(); ?>
<?php set_up_variables($user_type); ?>
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
                $menu_name = mysql_prep($_POST['menu_name']);
                $position = mysql_prep($_POST['position']);
                $visible = mysql_prep($_POST['visible']);
                $content = mysql_prep ($_POST['content']);
                $id=$_GET['subj'];
	
		$page_set = get_all_pages_for_subject($id,"admins");
		$page_count = mysql_num_rows($page_set);
                $UT = time()+(60*60*6);
                $date = strftime("%d %B %Y", $UT);
                $time = strftime("%I:%M %p", $UT);
                
		if ($position == $page_count+1) {
			$query = "INSERT INTO pages (
				subject_id ,menu_name, position, date, visible, content
				) VALUES (
				{$id} ,'{$menu_name}', {$position}, '{$date}',  {$visible}, '{$content}'
				)";
			$result = mysql_query($query, $connection);
			if ($result) {
				redirect_to("content.php");
			}
			else {
				echo "<p>Page creation failed</p>";
				echo "<p>" . mysql_error() . "</p>";
			}
		} else {
			$ids = array ();
			$page_set = get_all_pages_for_subject($id,"admins");
			
			while ($page = mysql_fetch_array($page_set)) {
				$ids[$page['position']]=$page['id'];
			}
			
			$i = $page_count;
			for (; $i>=$position; $i--) {
				$query = "UPDATE pages
					SET position = $i+1
					WHERE id = $ids[$i]";
				$error_check = mysql_query($query,$connection);
				confirm_query($error_check);
			}

			$query = "INSERT INTO pages (
				subject_id ,menu_name, position, visible, content
				) VALUES (
				{$id} ,'{$menu_name}', {$position}, {$visible}, '{$content}'
				)";
			$result = mysql_query($query, $connection);
			if ($result) {
				redirect_to("content.php");
			}
			else {
				echo "<p>Page creation failed</p>";
				echo "<p>" . mysql_error() . "</p>";
			}
			
		}
        }
?>

    <div id="main">
        <table id="structure">
            <tr>
                <td id="navigation">
                <?php content_navigation ("admins",$sel_page); ?>
                <br/>
                </td>
                <td id="page">
                        <h2>Add new page to <?php echo $sel_subject['menu_name']; ?><hr/></h2>
                        <form action="new_page.php?subj=<?php echo $sel_subject['id']; ?>" method="post">
                                <p>Page name:
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
                                                $page_set = get_all_pages_for_subject($_GET['subj'],"admins");
                                                $page_count = mysql_num_rows($page_set);
                                                for ($count=1; $count <=$page_count; $count++) {
                                                        echo "<option value={$count}>{$count}</option>";
                                                }
                                                $count= $page_count+1;
						echo "<option value=\"{$count}\" selected>{$count}</option>";
                                                
                                        ?>        
                                        </select>
                                </p>
                                
                                <p>Visible:
                                        <input type="radio" name="visible" value="0"/>No
                                        &nbsp;
					<input type="radio" name="visible" value="1" checked/> Yes
				</p>
                                
                                <p>Content: <br/><br/>
                                    <textarea name="content" rows="20" cols="80"></textarea>
                                </p>
                                
                                <input type="submit" name="submit" value="Add page" />
                                
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