<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php  $user_type=user_type_set(); ?>
<?php set_up_variables($user_type); ?>
<?php confirm_logged_in(); ?>
<?php include("includes/header.php"); ?>
<?php
    $option = 0;
    $level = 0;
    $state = 0;
    if (isset ($_POST['submit'])) {
        $level = 1;
        $state = 1;
        $option = 0;
    }
?>
<?php
//Form validation
    if ($level == 1) {
        $errors = array();
        $required_fields = array('password');
        foreach ($required_fields as $field_name){
                if (!isset($_POST[$field_name]) || empty($_POST[$field_name]) ) {
                        $errors[] = $field_name;
                }
        }
    }
    if (!empty ($errors)) {
        $state = 0;
    } else {
        $state = 1;
    }
?>
<?php
    if ($level == 1 && $state == 1) {
        $password = $_POST['password'];
        $hashed_password = sha1($password);
        $query = "SELECT user_name
                FROM users
                WHERE hashed_password = '{$hashed_password}'
                AND id = {$_SESSION['user_id']}";
        $result = mysql_query($query , $connection);
        $user_name = mysql_fetch_array($result);
        if ($user_name['user_name']==$_SESSION['user_name']) {
            $state = 1;
            $level = 2;
            $option = 1;
        } else {
            $level = 2;
            $state = 0;
            $option = 0;
        }
    }
?>
<?php
    if(isset($_POST['submit_yes'])) {
        $query = "DELETE FROM users
                WHERE id ={$_SESSION['user_id']}";
        $result = mysql_query ($query ,$connection);
        if ($result) {
            $query = "DELETE FROM comments
                    WHERE user_id={$_SESSION['user_id']}";
            $result = mysql_query ($query ,$connection);
            if ($result) {
                $query = "DELETE FROM messeges
                    WHERE sender_id={$_SESSION['user_id']}
                    OR reciever_id = {$_SESSION['user_id']}";
                $result = mysql_query ($query ,$connection);
                if ($result) {
                    $_SESSION= array();
                    if (isset($_COOKIE[session_name()])) {
                        setcookie(session_name(), '' , time()-10000 , '/');
                    }
                    session_destroy();             
                    redirect_to ("indexd.php?dltmsg=1");
                } else {
                    echo "database error" . mysql_error();
                }
            } else {
                echo "database error" . mysql_error();                
            }
        } else {
            echo "database error" . mysql_error();
        } 
    } else if (isset($_POST['submit_no'])) {       
        redirect_to ("indexd.php");
    }
?>
<link rel="stylesheet" href="css/public1.css" type="text/css" media="all">
<div id="main">
    <table id="structure">
        <tr>
            <td id="navigation">
                <ul class="subjects">
                    <li class="selected"><a href="profile.php">Profile: </a></li>
                    <ul class="pages">
                        <li><a href="profile.php">View profile</a></li>
                        <li><a href="edit_profile.php">Edit profile</a></li>
                        <li><a href="edit_username_pass.php?state=1">Change Username/Password</a></li>
                        <li class="selected"><a href="delete_profile.php">Delete profile</a></li>                        
                    </ul>
                </ul>
            </td>
            <td id="page">
                <h2>
                    Delete Profile<hr/>
                </h2>
            <p>
                <?php
                    if ($option == 0) {
                        if ($level == 2 && $state == 0) {
                            echo "<h3>You have entered wrong password!! <br/>Please enter your right password.</h3>";
                        } else {
                            echo "<h3>Please enter your current password.</h3>";
                        }
                        echo "<form action=\"delete_profile.php\" method=\"post\">";
                        echo "<p>Password: ";
                        echo "<input type=\"password\" name=\"password\" value=\"\" />";
                        if ($level == 1 && $state == 0) {
                            echo " ** please type your current password.";
                        }
                        echo "</p>";
                        echo "<input type=\"submit\" name=\"submit\" value=\"submit\" />";
                        echo "</form>";
                    } else if ($option == 1) {
                        if ($level == 2 && $state == 1) {
                            echo "<p> Do you really want to delete your profile? <br/>";
                            echo "<form action=\"delete_profile.php\" method=\"post\">";
                                echo "<input type=\"submit\" name=\"submit_no\" value=\"No\"/>";
                                echo "<input type=\"submit\" name=\"submit_yes\" value=\"Yes\"/>";
                            echo "</form>";
                            echo "</p>";
                        }
                    }
                ?>
            </p>
            </td>
            <td id="m_navigation">
                <h3><a href="indexd.php" id="select">Home</a></h3>
                <h3><a href="profile.php">Profile</a></h3>
                <?php if ($user_type=="admins") {
                echo "<h3><a href=\"admin.php\">Admin's Page</a></h3>"; }
                ?>
               
                <h3><a href="log_out.php">Logout</a></h3>
            </td>                
            </tr>
        </table>
    </div>
<?php include("includes/footer.php"); ?>
