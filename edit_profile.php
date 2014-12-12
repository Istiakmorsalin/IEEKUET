<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php  $user_type=user_type_set(); ?>
<?php set_up_variables($user_type); ?>
<?php confirm_logged_in(); ?>
<?php include("includes/header.php"); ?>
<?php $user_id = $_SESSION['user_id']; ?>
<?php
//Form validation
        if (isset ($_POST['submit'])) {
            $errors = array();
            $required_fields = array('first_name','last_name','country',
                                     'c_address','c_city','c_mn','p_address','p_city',
                                     'email','job','known');
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
    if (isset ($_POST['submit'])) {
        $submit_value = 1;
        if (empty($errors)) {
            $first_name= trim(mysql_prep($_POST['first_name']));
            $last_name= trim(mysql_prep($_POST['last_name']));
            $country= trim(mysql_prep($_POST['country']));
            $sex= mysql_prep($_POST['sex']);
            $date= mysql_prep($_POST['date']);
            $month= mysql_prep($_POST['month']);
            $year= mysql_prep($_POST['year']);
            $c_address= trim(mysql_prep($_POST['c_address']));
            $c_city= trim(mysql_prep($_POST['c_city']));
            $c_pc= mysql_prep($_POST['c_pc']);
            $c_pn= mysql_prep($_POST['c_pn']);
            $c_mn= mysql_prep($_POST['c_mn']);
            $p_address= trim(mysql_prep($_POST['p_address']));
            $p_city= trim(mysql_prep($_POST['p_city']));
            $p_pc= mysql_prep($_POST['p_pc']);
            $p_pn= mysql_prep($_POST['p_pn']);
            $p_mn= mysql_prep($_POST['p_mn']);
            $email= trim(mysql_prep($_POST['email']));
            $job= mysql_prep($_POST['job']);
            $interest= mysql_prep($_POST['interest']);
            $known= trim(mysql_prep($_POST['known']));
            $about= trim(mysql_prep($_POST['about']));

            $query = "UPDATE users SET ";
            
            $query .= " first_name= '{$first_name}',";
            $query .= " last_name= '{$last_name}',";
            $query .= " country= '{$country}',";
            $query .= " sex= '{$sex}',";
           
          
            if (!empty($date)) {
                $query .= " date= {$date},";
            }             
            if (!empty($month)) {
                $query .= " month= '{$month}',";
            }
            
            if (!empty($year)) {
                $query .= " year= {$year},";
            }

            $query .= " c_address='{$c_address}',";
            $query .= " c_city= '{$c_city}',";
            
            if (!empty($c_pc)) {
                $query .= " c_pc= '{$c_pc}',";
            } else {
                $query .= " c_pc= '',";                
            }
            
            if (!empty($c_pn)) {
                $query .= " c_pn= '{$c_pn}',";
            }  else {
                $query .= " c_pn= '',";                
            }
            
            $query .= " c_mn= '{$c_mn}',";
            $query .= " p_address= '{$p_address}',";
            $query .= " p_city= '{$p_city}',";
            
            if (!empty($p_pc)) {
                $query .= " p_pc= '{$p_pc}',";
            }  else {
                $query .= " p_pc= '',";                
            }
            
            if (!empty($p_pn)) {
                $query .= " p_pn= '{$p_pn}',";
            }  else {
                $query .= " p_pn= '',";                
            }
            
            if (!empty($p_mn)) {
                $query .= " p_mn= '{$p_mn}',";
            }  else {
                $query .= " p_mn= '',";                
            }
            
            $query .= " email= '{$email}',";
            $query .= " job= '{$job}',";
            $query .= " interest= '{$interest}',";
            $query .= " known= '{$known}',";
            
            if (!empty($about)) {
                $query .= " about= '{$about}'";
            } else {
                $query .= " about= ''";                
            }
            
            $query .= " WHERE id = {$_SESSION['user_id']}";
            
            $result = mysql_query($query ,$connection);
            if (mysql_affected_rows($connection)==1) {
               redirect_to("profile.php?messege=\"edit\"");
            } else {
                echo mysql_error($connection);
            }           
        }
    } else {
        $submit_value = 0;
    }
?>

<?php $result_set= get_everything_of_user($user_id,$connection); ?>
<link rel="stylesheet" href="css/public1.css" type="text/css" media="all">
<div id="main_ex">
    <table id="structure">
        <tr>
            <td id="navigation">
                <ul class="subjects">
                    <li class="selected"><a href="profile.php">Profile: </a></li>
                    <ul class="pages">
                        <li><a href="profile.php">View profile</a></li>
                        <li class="selected"><a href="edit_profile.php">Edit profile</a></li>
                        <li><a href="edit_username_pass.php?state=1">Change Username/Password</a></li>
                        <li><a href="delete_profile.php">Delete profile</a></li>                                                
                     </ul>
                </ul>
            </td>
            <td id="page">
                <h2>
                    Edit Profile: <?php echo $_SESSION['user_name']; ?>
                <hr/>
                </h2>
            <form action="edit_profile.php" method="post">
                <h3 class="form_header">
                    <br/>Basic informations:
                </h3>
                    <p><b>First name:</b>
                        <input type="text" maxlength= "50" name="first_name" value="<?php echo $result_set['first_name']; ?>" id="first_name"/>&nbsp;&nbsp;
                        <b>Last name:</b>
                            <input type="text" maxlength= "50" name="last_name" value="<?php echo $result_set['last_name']; ?>" id="last_name"/>
                        <b><br/><?php
                            if (error_checking_in_form("first_name",$errors)) {
                                echo "** You can't remove your first name.";
                            }
                            if (error_checking_in_form("last_name",$errors)) {
                                echo "<br/>** You can't remove your last name.";
                            }                                
                        ?></b>
                    </p>
                            
                    <p>
                        <b>Country:</b>
                            <input type="text" name="country" value="<?php echo $result_set['country']; ?>" id="country" />&nbsp;&nbsp;
                        <b>Sex:</b>
                            <input type="radio" name="sex" value="Male" <?php if ($result_set['sex'] == "Male") echo " checked"; ?> />Male &nbsp;
                            <input type="radio" name="sex" value="Female" <?php if ($result_set['sex'] == "Female") echo " checked"; ?>/>Female
                        <b><br/><?php
                            if (error_checking_in_form("country",$errors)) {
                                echo "** You can't remove your country name.";
                            }
                        ?></b>
                    </p>
                            
                    <p>
                        <b>Birthdate:</b>
                            <select name="date" id="date">
                                <?php
                                    for ($i=1;$i<=31;$i++) {
                                        echo "<option value={$i}";
                                        if ($result_set['date']==$i) echo " selected";
                                        echo ">$i</option>";
                                    }
                                ?>
                            </select>
                            
                            <select name="month" id="month">
                                <?php
                                    $months = array('Jan','Feb','Mar','Apr','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
                                    foreach($months as $month) {
                                        echo "<option value={$month}";
                                        if ($result_set['month']==$month) echo " selected";                                            
                                        echo">{$month}</option>";
                                    }
                                ?>
                            </select>
                            
                            <select name="year" id="year">
                                <?php
                                    for ($i=1971;$i<=2021;$i++) {
                                        echo "<option value={$i}";
                                        if ($result_set['year']==$i) echo " selected";                                            
                                        echo">$i</option>";
                                    }
                                ?>
                            </select><br/><br/>   
                    </p>                    
                <h3 class="form_header">
                    Contact informations:
                </h3>                    
                    <p><b>Current address:</b>
                        <input type="text" name="c_address" value="<?php echo $result_set['c_address']; ?>" id="c_address" />
                        <b><br/><?php
                            if (error_checking_in_form("c_address",$errors)) {
                                echo "** You can't remove your current address.";
                            }
                        ?></b>                            
                    </p>
                    <p><b>Current city:</b>
                        <input type="text" value="<?php echo $result_set['c_city']; ?>" name="c_city" id="c_city" />&nbsp;&nbsp;
                        <b>Postal code:</b>
                        <input type="text" value="<?php echo $result_set['c_pc']; ?>" name="c_pc" id="c_pc" />
                        <b><br/><?php
                            if (error_checking_in_form("c_city",$errors)) {
                                echo "** You can't remove your current city name.";
                            }                                
                        ?></b>
                        
                    </p>
                    <p><b></b>
                        <b>Phone no:</b>
                        <input type="text" value="<?php echo $result_set['c_pn']; ?>" name="c_pn" class="c_pn" />&nbsp;&nbsp;
                        <b>Mobile no:</b>
                        <input type="text" value="<?php echo $result_set['c_mn']; ?>" name="c_mn" class="c_mn" />
                        <b><br/><?php
                            if (error_checking_in_form("c_mn",$errors)) {
                                echo "** You can't remove your mobile number.";
                            }
                        ?></b>                            

                    </p>
                    <p><b>Parmanent address:</b>
                        <input type="text" name="p_address" value="<?php echo $result_set['p_address']; ?>" id="p_address" />
                        <b><br/><?php
                            if (error_checking_in_form("p_address",$errors)) {
                                echo "** Please type your parmanent address.";
                            }
                        ?></b>                            
                        
                    </p>
                    <p><b>Parmanent city:</b>
                        <input type="text" value="<?php echo $result_set['p_city']; ?>" name="p_city" id="p_city" />&nbsp;&nbsp;
                        <b>Postal code:</b>
                        <input type="text" value="<?php echo $result_set['p_pc']; ?>" name="p_pc" id="p_pc" />
                        <b><br/><?php
                            if (error_checking_in_form("p_city",$errors)) {
                                echo "** Please type your parmanent city name.";
                            }                                
                        ?></b>
                        
                    </p>
                    <p><b></b>
                        <b>Phone no:</b>
                        <input type="text" value="<?php echo $result_set['p_pn']; ?>" name="p_pn" class="c_pn" />&nbsp;&nbsp;
                        <b>Mobile no:</b>
                        <input type="text" value="<?php echo $result_set['p_mn']; ?>" name="p_mn" id="p_mn_e" />                            
                    </p>
                    <p><b>Email:</b>
                        <input type="text" value="<?php echo $result_set['email']; ?>" name="email" id="c_en" />&nbsp;&nbsp;
                        <b><br/><?php
                            if (error_checking_in_form("email",$errors)) {
                                echo "** Please type your email account.";
                            }
                        ?></b>                                                        
                        <br/><br/>
                    </p>
                <h3 class="form_header">
                    Personal informations:
                </h3>                    
                    <p><b>Job:</b>
                        <select name="job">
                            <?php
                                $jobs = array ('Student', 'Teacher' , 'Developer', 'Others');
                                foreach ($jobs as $job) {
                                    echo "<option value={$job}";
                                    if ($result_set['job']==$job) echo " selected";
                                    echo ">{$job}</option>";
                                }
                            ?>
                        </select>&nbsp;&nbsp;
                        <b>Interested in:</b>
                            <input type="radio" name="interest" value="Develop" <?php if ($result_set['interest'] == "Develop") echo " checked"; ?>/>Developing &nbsp;
                            <input type="radio" name="interest" value="Program" <?php if ($result_set['interest'] == "Program") echo " checked"; ?>/>Programing
                        <b><br/><?php
                            if (error_checking_in_form("job",$errors)) {
                                echo "** Please select your job.";
                            }
                        ?></b>                                                        
                            
                    </p>
                    <p><b>Known languages(programming)*:</b>
                        <input type="text" name="known" value="<?php echo $result_set['known']; ?>">
                        <b><br/><?php
                            if (error_checking_in_form("known",$errors)) {
                                echo "** Please type the names of your known programming languages.";
                            }
                        ?></b>                                                        
                        
                        &nbsp;
                    </p>
                    <p><b>About you:</b>
                        <br/><br/><textarea name="about" rows="10" cols="73"><?php echo $result_set['about']; ?></textarea>
                    </p>
                    <input type="submit" name="submit" value="Edit profile" />
                <br/><br><br/><br><br/><br><br/><br>
            </form>                        
            </td>
            <td id="m_navigation">
                <h3><a href="index.php" id="select">Home</a></h3>
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