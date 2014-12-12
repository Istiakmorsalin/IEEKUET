<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php  $user_type=user_type_set(); ?>
<?php set_up_variables($user_type); ?>
<?php confirm_logged_in(); ?>
<?php include("includes/header.php"); ?>




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
               <?php 
				$query = "select * from users where validation =0";
				$result=mysql_query($query);
				while($row=mysql_fetch_array($result)){
					echo "<div style='padding: 10px; margin: 5px; border:1px solid #aaa;'>";
					echo $row['user_name'];
					echo "<br><br><a href='accept_request.php?id=".urlencode($row['id'])."'>Accept</a>";
					echo "<a href='delete_request.php?id=".urlencode($row['id'])."'>&nbsp&nbsp decline</a>";
					echo "</div>";
				}
			   ?>
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
