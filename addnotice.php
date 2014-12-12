<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php  $user_type=user_type_set(); ?>
<?php set_up_variables($user_type); ?>
<?php confirm_logged_in(); ?>
<?php include("includes/header.php"); ?>
<?php if (isset($_GET['user_id'])) {
        $state = 1;
    } else if(isset($_POST['submit'])) {
        $state = 2;
    } else if (isset($_POST['value'])) {
        $state = 3;
    } else {
        $state = 4;
    }
?>

<?php
    if ($state == 2) {
        $id= mysql_prep($_POST['id']);
        $query = "UPDATE users SET
                admin_value = 1
                WHERE id= {$id}";
        $result = mysql_query($query , $connection);
        $user_name = get_username_by_id($id,$connection);
        if ($result) {
            redirect_to("admin.php?messege=success&&user_name={$user_name}");
        } else {
            echo "database error" . mysql_error();
        }
    }
?>
<?php
    if ($state == 3) {
        $id= mysql_prep($_GET['id']);
        $query = "UPDATE users SET
                admin_value = 1
                WHERE id= {$id}";
        $result = mysql_query($query , $connection);
        $user_name = get_username_by_id($id,$connection);
        if ($result) {
            redirect_to("admin.php?messege=success&&user_name={$user_name}");
        } else {
            echo "database error" . mysql_error();
        }        
    }
?>
<link rel="stylesheet" href="css/public1.css" type="text/css" media="all">
<div id="main">
    <table id="structure">
        <tr>
            <td id="navigation">
                <ul class="pages">
                    <li><a href="indexd.php">Return to home</a></li>
                </ul>
            </td>
            <td id="page">
                <h2>
                    Add Notice Board
                    <hr/>
                </h2>
				<?php if(!$_GET['m']){ ?>
                <form action="addnoticedb.php" method="post">
					Title:<input type='text' size='' name='title'><br>
					Subject:<br><textarea cols='50' rows='20' name='sub'></textarea><br>
					<input type='submit' size='' name='submit' value='submit'><br>
				</form>
				<?php } 
				else if($_GET['m']){
					echo "<h1> You Have Successfully posted a notice</h1><br><a href='addnotice.php'>add another notice</a>";
				}
				?>
            </td>
            <td id="m_navigation">
            </td>                
            </tr>
        </table>
    </div>
<?php include("includes/footer.php"); ?>
