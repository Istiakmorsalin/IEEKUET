<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php  $user_type=user_type_set(); ?>
<?php set_up_variables($user_type); ?>
<?php confirm_logged_in(); ?>
<?php include("includes/header.php"); ?>
<?php
//Form validation
    if (isset ($_POST['submit'])) {
        $errors = array();
        $required_fields = array('content');
        foreach ($required_fields as $field_name){
                if (!isset($_POST[$field_name]) || empty($_POST[$field_name]) ) {
                        $errors[] = $field_name;
                }
        }
    } else {
        $errors = array();
    }
?>

<?php
    if (isset($_POST['submit']) && empty($errors)) {
        if ($_POST['id'] != 0) {
            $sender_id = $_SESSION['user_id'];
            $reciever_id = $_POST['id'];
            
            $UT = time()+(60*60*6);
            $date = strftime("%d %B %Y", $UT);
            $time = strftime("%I:%M %p", $UT);
            
            $messege_set = get_all_messeges($connection);
            $count = mysql_num_rows($messege_set);
            $position = $count+1;
            $content = mysql_prep ($_POST['content']);
            
            $query = "INSERT INTO messeges(
                sender_id, reciever_id, date, time, position, status, content
                ) VALUES (
                {$sender_id}, {$reciever_id}, '{$date}', '{$time}', {$position}, 0, '{$content}')";
            $result = mysql_query($query , $connection);
            if ($result) {
                redirect_to ("sent_messeges.php?messege=1&&id={$reciever_id}");
            } else {
                echo "database error" . mysql_error();
            }
        }
    }
?>

<div id="main">
    <table id="structure">
        <tr>
            <td id="navigation">
                <ul class="subjects">
                    <li class="selected"><a href="messeges.php">Messeges: </a></li>
                    <ul class="pages">
                        <li><a href="messeges.php">All</a></li>
                        <li><a href="sent_messeges.php">Sent</a></li>
                        <li><a href="recieved_messeges.php">Recieved</a></li>
                     </ul>
                </ul>
            </td>
            <td id="page">
                <h2>
                    Send a new messeges.<hr/>
                </h2>
                <form action="new_messege.php" method="post">
                    <p>To:
                        <select name="id">
                            <option value=\"0\"></option>                            
                            <?php
                                $query = "SELECT user_name, id
                                        FROM  users
                                        WHERE id != {$_SESSION['user_id']}
                                        ORDER BY id ASC";
                                $result_set = mysql_query($query,$connection);
                                while ($result = mysql_fetch_array($result_set)) {
                                    echo "<option value=\"{$result['id']}\"";
                                    if (isset($_POST['id'])) {
                                        if ($_POST['id'] == $result['id'])
                                        echo " selected";
                                    }
                                    echo ">{$result['user_name']}</option>";
                                }                                
                            ?>
                        </select>
                        <?php
                            if (isset($_POST['id'])) {
                                if ($_POST['id'] == 0) 
                                echo "** Please select a user";
                            }
                        ?>
                    </p>
                    <p>Content:
                        <textarea rows="15" cols="73" name="content" id="messege_content"><?php if (isset($_POST['content'])) echo $_POST['content']; ?></textarea><br/>
                            <?php
                                if (error_checking_in_form("content",$errors)) {
                                    echo " ** Please type the messege.";
                                }
                            ?>                        
                    </p>
                    <p>
                        <input type="submit" name="submit" value="Send" id="send_messege"/>
                    </p>
                </form>
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