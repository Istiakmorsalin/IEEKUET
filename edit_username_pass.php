<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php  $user_type=user_type_set(); ?>
<?php set_up_variables($user_type); ?>
<?php confirm_logged_in(); ?>
<?php include("includes/header.php"); ?>
<?php
    if (isset($_GET['state']) && $_GET['state'] == 1) {
        $state=1;
    }
    if (isset($_POST['submit'])) {
        $state=1;
    }
    if (isset($_GET['state2']) && $_GET['state2'] == 2) {
        $state=2;
    }
    if (isset($_POST['edit'])) {
        $state=2;
    }
?>

<?php
//Form validation
        if (isset ($_POST['submit'])) {
            $errors = array();
            $required_fields = array('password');
            foreach ($required_fields as $field_name){
                    if (!isset($_POST[$field_name]) || empty($_POST[$field_name]) ) {
                            $errors[] = $field_name;
                    }
            }
        } else {
            $errors = array ();
        }
?>

<?php
//Form validation
        if (isset ($_POST['edit'])) {
            $errors = array();
            $required_fields = array('user_name','password');
            foreach ($required_fields as $field_name){
                    if (!isset($_POST[$field_name]) || empty($_POST[$field_name]) ) {
                            $errors[] = $field_name;
                    }
            }
        }
?>

<?php
    if (empty ($errors) && isset($_POST['submit'])) {
        $password = trim(mysql_prep($_POST['password']));
        $user_name = $_SESSION['user_name'];
        
        $hashed_password = sha1($password);
        
        $query= "SELECT id, user_name
                FROM users
                WHERE hashed_password = '{$hashed_password}'
                AND user_name = '{$user_name}'";
        $result = mysql_query($query, $connection);
        if (mysql_affected_rows($connection) == 1) {
            $state = 2;
            $messege = "right";
        } else {
            $state=1;
            $messege = "wrong";
        }
    }    
?>

<?php
    if (empty ($errors) && isset($_POST['edit'])) {
        $password = trim(mysql_prep($_POST['password']));
        $user_name = $_POST['user_name'];
        $id= $_SESSION['user_id'];
        $admin_value = $_SESSION['admin_value'];
        
        $hashed_password = sha1($password);
        
        $query= "UPDATE users SET
                hashed_password = '{$hashed_password}',
                user_name = '{$user_name}'
                WHERE id = {$_SESSION['user_id']}";
        $result_set = mysql_query($query, $connection);
        if (mysql_affected_rows($connection) == 1) {

            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_id'] = $id;
            $_SESSION['admin_value'] = $admin_value;
            
            redirect_to("profile.php?messege=\"edit\"");
        } else {
                echo mysql_error($connection);
        }
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
                        <li class="selected"><a href="edit_username_pass.php?state=1">Change Username/Password</a></li>                        
                        <li><a href="delete_profile.php">Delete profile</a></li>                        
                    </ul>
                </ul>
                <br/>
            </td>
            <td id="page">
                <h2>Change Username/Password:<?php echo "\"" . $_SESSION['user_name'] . "\""; ?><hr/>
                </h2>
                <?php if (isset($state) && $state==1) {
                    if (isset($messege) && $messege=="wrong") {
                        echo "<h3>You have entered wrong password!! <br/>Please enter your right password.</h3>";
                    } else {
                        echo "<h3>Please enter your current password.</h3>";
                    }
                    echo "<form action=\"edit_username_pass.php\" method=\"post\">";
                    echo "<p>Password: ";
                    echo "<input type=\"password\" name=\"password\" value=\"\" />";
                    if (error_checking_in_form("password",$errors)) {
                        echo " &nbsp;&nbsp;*Please type your current password.";
                    }
                    echo "</p>";
                    echo "<input type=\"submit\" name=\"submit\" value=\"submit\" />";
                    echo "</form>";                    
                }
                ?>
                
                <?php
                    if (isset($state) && $state==2) {                    
                        echo "<h3>Enter your desired username & password.</h3>";                                        
                        echo "<form action=\"edit_username_pass.php?state2=2\" method=\"post\">";
                        echo "<p>Username: ";
                        echo "<input type=\"text\" name=\"user_name\" value=\"{$_SESSION['user_name']}\" />";
                        if (error_checking_in_form("user_name",$errors)) {
                            echo " &nbsp;&nbsp;*Please type your desired username.";
                        }                                            
                        echo "</p>";
                        echo "<p>Password: ";
                        echo "<input type=\"password\" name=\"password\" value=\"\" />";
                        if (error_checking_in_form("password",$errors)) {
                            echo " &nbsp;&nbsp;*Please type your desired password.";
                        }                    
                        echo "</p>";
                        echo "<input type=\"submit\" name=\"edit\" value=\"submit\" />";
                        echo "</form>";
                    }

                ?>
            </td>
            <td id="m_navigation">
                <h3><a href="index.php" id="select">Home</a></h3>
                <h3><a href="profile.php">Profile</a></h3>
                <?php if ($user_type=="admins") {
                echo "<h3><a href=\"admin.php\">Admin's Page</a></h3>"; }
                ?>
                <h3><a href="messeges.php">Messeges</a></h3>
                <h3><a href="log_out.php">Logout</a></h3>
            </td>                
            </tr>
        </table>
    </div>
<?php include("includes/footer.php"); ?>
