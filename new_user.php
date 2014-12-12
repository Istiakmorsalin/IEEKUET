<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
    if (isset($_SESSION['user_name'])) {
        redirect_to("a_messege.php?msg=\"new_user\"");
    }
?>
<?php
//Form validation
        if (isset ($_POST['submit'])) {
            $errors = array();
            $required_fields = array('first_name','last_name',
                                     'c_address','c_mn','p_address','p_city',
                                     'email','job','user_name','password','confirm_password');
            foreach ($required_fields as $field_name){
                    if (!isset($_POST[$field_name]) || empty($_POST[$field_name]) ) {
                            $errors[] = $field_name;
                    }
            }
        } else {
            $errors = array ();
        }

    if (isset ($_POST['submit'])) {
        $submit_value = 1;
        if (empty($errors)) {
            $user_name= trim(mysql_prep($_POST['user_name']));            
            $password= trim(mysql_prep($_POST['password']));
            $confirm_password = trim(mysql_prep($_POST['confirm_password']));
            
            $user_name_check = matching_user_name($user_name, $connection);
            if ($user_name_check == 1) {
                if ($password == $confirm_password) {
                    
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
                    $c_pn=  mysql_prep($_POST['c_pn']);
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
                    
                    $hashed_password= sha1($password);
                    
                    $query = "INSERT INTO users (";
                    $query .= " first_name, last_name, ";
                    
                    if (!empty($country)) {
                        $query .= " country,";
                    }
                    
                    $query .= " sex, ";
                    
                    if ($date!=1 && $month!='jan' && $year!=1971) {
                        $query .= " date, month, year,";
                    }
                    
                    $query .= " c_address, ";
                    
                    if (!empty($c_city)) {
                        $query .= " c_city,";
                    }                
                    
                    if (!empty($c_pc)) {
                        $query .= " c_pc,";
                    }
                    if (!empty($c_pn)) {
                        $query .= " c_pn,";
                    }
                    
                    $query .= " c_mn, p_address, p_city,";
                    
                    if (!empty($p_pc)) {
                        $query .= " p_pc,";
                    }
                    if (!empty($p_pn)) {
                        $query .= " p_pn,";
                    }
                    if (!empty($p_mn)) {
                        $query .= " p_mn,";
                    }
                    
                    $query .=" email, job, interest,";
                    
                    if (!empty($known)) {
                        $query .= " known,";
                    }                
                    
                    if (!empty($about)) {
                        $query .= " about,";
                    }
                    
                    $query .= " user_name, hashed_password, admin_value)";
                    
                    $query .= " VALUES ( '{$first_name}', '{$last_name}',";
                    
                    if (!empty($country)) {
                        $query .= " '{$country}',";
                    }
                    
                    $query .= " '{$sex}',";
                    
                    if ($date!=1 && $month!='jan' && $year!=1971) {
                        $query .= " {$date}, '{$month}', {$year},";
                    }
                    
                    $query .= " '{$c_address}',";
                    
                    if (!empty($c_city)) {
                        $query .= " '{$c_city}',";
                    }    
                    if (!empty($c_pc)) {
                        $query .= " '{$c_pc}',";
                    }
                    if (!empty($c_pn)) {
                        $query .= " '{$c_pn}',";
                    }
                    
                    $query .= " '{$c_mn}', '{$p_address}', '{$p_city}',";
                    
                    if (!empty($p_pc)) {
                        $query .= " '{$p_pc}',";
                    }
                    if (!empty($p_pn)) {
                        $query .= " '{$p_pn}',";
                    }
                    if (!empty($p_mn)) {
                        $query .= " '{$p_mn}',";
                    }
                    
                    $query .=" '{$email}', '{$job}', '{$interest}',";
                    
                    if (!empty($known)) {
                        $query .= " '{$known}',";
                    }    
                    if (!empty($about)) {
                        $query .= " '{$about}',";
                    }
                    
                    $query .= " '{$user_name}', '{$hashed_password}', 0)";
                    $result = mysql_query($query, $connection);
                    if (mysql_affected_rows($connection)==1){
                        $query = "SELECT id, user_name, admin_value
                                FROM users
                                WHERE user_name='{$user_name}'
                                AND hashed_password='{$hashed_password}'";
                        $result_set = mysql_query($query,$connection);
                        confirm_query($result_set);
                        if ( mysql_num_rows($result_set)==1 ) {
                            $result = mysql_fetch_array($result_set);
                                            
                            redirect_to("log_in.php?m=1");
                        } 
                    }else {
                        echo $query;
                        echo "database error" . mysql_error();
                    }
                }
            }
        }
    } else {
        $submit_value = 0;
    }
?>
<link rel="stylesheet" href="css/public1.css" type="text/css" media="all">

<?php include("includes/header.php"); ?>


    <div id="main_ex">
        <table id="structure">
            <tr>
                <td id="navigation">
                    <!--Left Navigation-->
                    <a href="indexd.php" id="select">Return to home page</a>
                </td>
                
                <td id="page">
                    <h2>
                        Create a new user <hr/>
                    <br/>
                    </h2>
                    
                <form action="new_user.php" method="post">
                    <h3 class="form_header">
                        Basic informations:
                    </h3>
                        <p><b>First name*:</b>
                            <input type="text" maxlength= "50" name="first_name" value="<?php if ($submit_value==1) echo $_POST['first_name']; ?>" id="first_name"/>&nbsp;&nbsp;
                            <b>Last name*:</b>
                                <input type="text" maxlength= "50" name="last_name" value="<?php if ($submit_value==1) echo $_POST['last_name']; ?>" id="last_name"/>
                            <b><br/><?php
                                if (error_checking_in_form("first_name",$errors)) {
                                    echo "** Please type your first name.";
                                }
                                if (error_checking_in_form("last_name",$errors)) {
                                    echo "<br/>** Please type your last name.";
                                }                                
                            ?></b>
                        </p>
                                
                        <p>
                            <b>Country:</b>
                                <input type="text" name="country" value="<?php if ($submit_value==1) echo $_POST['country']; ?>" id="country" />&nbsp;&nbsp;
                            <b>Sex:</b>
                                <input type="radio" name="sex" value="Male" checked />Male &nbsp;
                                <input type="radio" name="sex" value="Female" />Female
                        </p>
                                
                        <p>
                            <b>Birthdate:</b>
                                <select name="date" id="date">
                                    <?php
                                        for ($i=1;$i<=31;$i++) {
                                            echo "<option value={$i}";
                                            if ($submit_value==1 && $_POST['date']==$i) echo " selected";
                                            echo ">$i</option>";
                                        }
                                    ?>
                                </select>
                                
                                <select name="month" id="month">
                                    <?php
                                        $months = array('Jan','Feb','Mar','Apr','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
                                        foreach($months as $month) {
                                            echo "<option value={$month}";
                                            if ($submit_value==1 && $_POST['month']==$month) echo " selected";                                            
                                            echo">{$month}</option>";
                                        }
                                    ?>
                                </select>
                                
                                <select name="year" id="year">
                                    <?php
                                        for ($i=1971;$i<=2021;$i++) {
                                            echo "<option value={$i}";
                                            if ($submit_value==1 && $_POST['year']==$i) echo " selected";                                            
                                            echo">$i</option>";
                                        }
                                    ?>
                                </select><br/><br/>   
                        </p>                    
                    <h3 class="form_header">
                        Contact informations:
                    </h3>                    
                        <p><b>Current address*:</b>
                            <input type="text" name="c_address" value="<?php if ($submit_value==1) echo $_POST['c_address']; ?>" id="c_address" />
                            <b><br/><?php
                                if (error_checking_in_form("c_address",$errors)) {
                                    echo "** Please type your current address.";
                                }
                            ?></b>                            
                        </p>
                        <p><b>Current city:</b>
                            <input type="text" value="<?php if ($submit_value==1) echo $_POST['c_city']; ?>" name="c_city" id="c_city" />&nbsp;&nbsp;
                            <b>Postal code:</b>
                            <input type="text" value="<?php if ($submit_value==1) echo $_POST['c_pc']; ?>" name="c_pc" id="c_pc" />
                        </p>
                        <p><b></b>
                            <b>Phone no:</b>
                            <input type="text" value="<?php if ($submit_value==1) echo $_POST['c_pn']; ?>" name="c_pn" class="c_pn" />&nbsp;&nbsp;
                            <b>Mobile no*:</b>
                            <input type="text" value="<?php if ($submit_value==1) echo $_POST['c_mn']; ?>" name="c_mn" class="c_mn" />
                            <b><br/><?php
                                if (error_checking_in_form("c_mn",$errors)) {
                                    echo "** Please type you mobile number.";
                                }
                            ?></b>                            

                        </p>
                        <p><b>Parmanent address*:</b>
                            <input type="text" name="p_address" value="<?php if ($submit_value==1) echo $_POST['p_address']; ?>" id="p_address" />
                            <b><br/><?php
                                if (error_checking_in_form("p_address",$errors)) {
                                    echo "** Please type your parmanent address.";
                                }
                            ?></b>                            
                            
                        </p>
                        <p><b>Parmanent city*:</b>
                            <input type="text" value="<?php if ($submit_value==1) echo $_POST['p_city']; ?>" name="p_city" id="p_city" />&nbsp;&nbsp;
                            <b>Postal code:</b>
                            <input type="text" value="<?php if ($submit_value==1) echo $_POST['p_pc']; ?>" name="p_pc" id="p_pc" />
                            <b><br/><?php
                                if (error_checking_in_form("p_city",$errors)) {
                                    echo "** Please type your parmanent city name.";
                                }                                
                            ?></b>
                            
                        </p>
                        <p><b></b>
                            <b>Phone no:</b>
                            <input type="text" value="<?php if ($submit_value==1) echo $_POST['p_pn']; ?>" name="p_pn" class="c_pn" />&nbsp;&nbsp;
                            <b>Mobile no:</b>
                            <input type="text" value="<?php if ($submit_value==1) echo $_POST['p_mn']; ?>" name="p_mn" id="p_mn" />                            
                        </p>
                        <p><b>Email*:</b>
                            <input type="text" value="<?php if ($submit_value==1) echo $_POST['email']; ?>" name="email" id="c_en" />&nbsp;&nbsp;
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
                        <p><b>Job*:</b>
                            <select name="job">
                                <?php
                                    $jobs = array ('Student', 'Teacher' , 'Developer', 'Others');
                                    foreach ($jobs as $job) {
                                        echo "<option value={$job}>{$job}</option>";
                                    }
                                ?>
                            </select>&nbsp;&nbsp;
                            <b>Interested in:</b>
                                <input type="radio" name="interest" value="Develop" checked/>Developing &nbsp;
                                <input type="radio" name="interest" value="Program" />Programing
                            <b><br/><?php
                                if (error_checking_in_form("job",$errors)) {
                                    echo "** Please select your job.";
                                }
                            ?></b>                                                        
                                
                        </p>
                        <p><b>Known languages(programming):</b>
                            <input type="text" name="known" value="<?php if ($submit_value==1) echo $_POST['known']; ?>">
                            &nbsp;
                        </p>
                        <p><b>About you:</b>
                            <br/><br/><textarea name="about" rows="10" cols="73"><?php if ($submit_value==1) echo $_POST['about']; ?></textarea>
                        </p><br/>
                        
                    <h3 class="form_header">
                        Login informations:
                    </h3>                    
                        <p><b>Username*:</b>
                            <input type="text" name="user_name"  maxlength="30" value="<?php if ($submit_value==1) echo $_POST['user_name']; ?>" id="user_name"/>
                            <b><br/><?php
                                if (error_checking_in_form("user_name",$errors)) {
                                    echo "** Please type your desired username";
                                }
                            ?></b>                                                        
                            <b><br/><?php
                                if (isset($user_name_check)) {
                                    if ($user_name_check == 0)
                                    echo "** This user name is already taken. Please enter another user name.";
                                }
                            ?></b>                            
                        </p>
                            
                        <p><b>Password*:</b>
                            <input type="password" name="password"  maxlength="30" value="" id="password" />
                            <b><br/><?php
                                if (error_checking_in_form("password",$errors)) {
                                    echo "** Please type your desired password";
                                }
                            ?></b>                                                        
                            
                        </p>
                        <p><b>Confirm Password*:</b>
                            <input type="password" name="confirm_password"  maxlength="30" value="" id="confirm_password" />
                            <b><br/><?php
                                if (error_checking_in_form("confirm_password",$errors)) {
                                    echo "** Please re-type the password you entered";
                                }
                            ?></b>                                                        
                            
                        </p>                        
                        <br/>
                        
                        <p><hr/><b>N.B.</b> Please fill all the fields which are ended with a '*' sign.
                        </p>
                        <input type="submit" name="submit" value="Create user" />
                    <br/><br><br/><br><br/><br><br/><br>
                </form>
                
                </td>
                <td id="m_navigation">
                </td>
                
            </tr>
        </table>
    </div>
<?php include("includes/footer.php"); ?>