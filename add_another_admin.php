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
                    Add another admin
                    <hr/>
                </h2>
                <?php
                    if ($state == 1) {
                        $user_name= get_username_by_id($_GET['user_id'],$connection);
                        echo "<p>Do you really want to make \"{$user_name}\" admin?</p>";
                        echo "<form action='add_another_admin.php?id={$_GET['user_id']}' method='post' />";
                        echo "&nbsp;&nbsp;<input type=\"submit\" name=\"value\" value=\"yes\" />&nbsp;";
                        echo "<input type=\"submit\" name=\"value\" value=\"no\" />";
                        echo "</form>";
                    } else if ($state == 4) {
                        $query = "SELECT user_name, id
                                FROM users
                                WHERE admin_value = 0 and validation = 1
                                ORDER BY id ASC";
                        $result_set = mysql_query($query, $connection) ;
                        echo "<form action=\"add_another_admin.php\" method=\"post\">";
                        echo "<h3>Select a user:</h3>";
                        echo "<select name='id' id=\"select_s\">";
                        while ($result = mysql_fetch_array($result_set)) {
                            echo "<option value=\"{$result['id']}\">{$result['user_name']}</option>";
                        }
                        echo "</select>";                        
                        echo "<input type=\"submit\" name=\"submit\" value=\"add as admin\" id=\"submit\" onclick=\"return confirm('Are you sure you want to add this user as an admin?');\"/>";
                        echo "</form>";
                    }
                    echo "<hr id=\"end\">";                                           
                ?>
            </td>
            <td id="m_navigation">
            </td>                
            </tr>
        </table>
    </div>
<?php include("includes/footer.php"); ?>
