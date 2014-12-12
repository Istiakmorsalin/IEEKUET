<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php $user_type=user_type_set(); ?>
<?php set_up_variables("$user_type"); ?>
<?php cookie_auth("log_in"); ?>
<?php
    if (logged_in()) {
        die("You are all ready logged in");
    } 
?>
<?php
    if(isset($_GET['logout']) && $_GET['logout']==1) {
        $messege2="You are now logged out.";
    }
?>
<?php
//Form validation
        $errors = array();
        $required_fields = array('user_name','password');
        foreach ($required_fields as $field_name){
                if (!isset($_POST[$field_name]) || empty($_POST[$field_name]) ) {
                        $errors[] = $field_name;
                }
        }

?>
<?php

?>
<?php
    if (isset($_POST['submit']) && empty($errors)) {

        $user_name= trim(mysql_prep($_POST['user_name']));
        $password= trim(mysql_prep($_POST['password']));
        $hashed_password = sha1($password);
        
        $query = "SELECT id, user_name, admin_value
                FROM users
                WHERE user_name='{$user_name}'
                AND hashed_password='{$hashed_password}'";

        $result_set = mysql_query($query,$connection);
        confirm_query($result_set);
		//echo "<div style='color: #fff'>jamy</a>";
        if ( mysql_num_rows($result_set)==1 ) {
            //echo "jamy";
			$result = mysql_fetch_array($result_set);
			if($result['validation']!=1){ 
				$messege = "you are waiting for the admin confirmation";
			}
            else{
				$_SESSION['user_name'] = $result['user_name'];
				$_SESSION['user_id'] = $result['id'];
				$_SESSION['admin_value'] = $result['admin_value'];
				$user_type= user_type_set();
            
				if (isset ($_POST['rmbr_pass'])) {
					setcookie("remember" , ab_jg($result['id']) , time()+(7*24*60*60));
				}
				redirect_to("indexd.php?user_name={$_SESSION['user_name']}");
			}
        } else {
            $messege = "Username/password combination incorrect.<br />
                Please make sure that the caps lock key of your keyboard is off and try again.";
        }
    } else {
        $user_name="";
        $password="";
    }
?>
<?php include("includes/header.php"); ?>
<link rel="stylesheet" href="css/public.css" type="text/css" media="all">
    <div id="main">
        <table id="structure">
            <tr>
                <td id="navigation">
                <ul class="pages">
                   <!-- <li><a href="indexd.php">Return to home</a></li> -->
                </ul>
                </td>
                <td id="page">
                    <h2>
                        User login.
                    </h2>
                    <h3>
                        <?php if (isset ($messege2))echo $messege2; ?>
                        <?php if (isset ($messege))echo $messege; ?>   
						<?php if (isset ($_GET['m']))echo "your request has been sent to admin Pleas wait for the approval"; ?>  
                    </h3>
                    <form action="log_in.php" method="post">
                        <p>User name:
                            <input type="text" name="user_name"  maxlength="30" value="<?php echo htmlentities($user_name); ?>" />
                            <?php 
                                if (isset($_POST['submit']) && !empty($errors) ) {
                                    foreach ($errors as $error) {
                                        if ($error == "user_name") {
                                            echo "Please type the user name.";
                                        }
                                    }
                                }
                            ?>
                            
                        </p>
                        
                        <p>Password:
                            <input type="password" name="password"  maxlength="30" value="" />
                            <?php 
                                if (isset($_POST['submit']) && !empty($errors) ) {
                                    foreach ($errors as $error) {
                                        if ($error == "password") {
                                            echo "Please type the password.";
                                        }
                                    }
                                }
                            ?>                                                        
                        </p>

                        <input type="checkbox" name="rmbr_pass" value="1" />Remember me <br/><br/>
                        <input type="submit" name="submit" value="Log in" />
						&nbsp or &nbsp
						
											
						<a href="new_user.php" style="padding: 5px; color: #333;">want to register?</a>
						
                    </form>
                </td>
                <td id="m_navigation">
                </td>                
            </tr>
        </table>
    </div>
<?php include("includes/footer.php"); ?>