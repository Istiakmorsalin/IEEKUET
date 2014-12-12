<html>
	<head>
		<title>IEEE KUET</title>
		<link rel="stylesheet" href="css/public1.css" type="text/css" media="all">
	</head>
	<body>
		<div id="header">
			<h1>IEEE KUET</h1>
		</div>
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
        <input type="text" maxlength= "50" name="first_name" value="" id="first_name"/>&nbsp;&nbsp;
        <b>Last name*:</b>
            <input type="text" maxlength= "50" name="last_name" value="" id="last_name"/>
    </p>
            
    <p>
        <b>Country*:</b>
            <input type="text" name="country" value="" id="country" />&nbsp;&nbsp;
        <b>Sex*:</b>
            <input type="radio" name="sex" value="male" />Male &nbsp;
            <input type="radio" name="sex" value="female" />Female
    </p>
            
    <p>
        <b>Birthdate*:</b>
            <select name="date" id="date">
                <?php
                    for ($i=1;$i<=31;$i++) {
                        echo "<option value={$i}>$i</option>";
                    }
                ?>
            </select>
            
            <select name="month" id="month">
                <?php
                    $months = array('Jan','Feb','Mar','Apr','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
                    foreach($months as $month) {
                        echo "<option value={$month}>{$month}</option>";
                    }
                ?>
            </select>
            
            <select name="year" id="year">
                <?php
                    for ($i=1971;$i<=2021;$i++) {
                        echo "<option value={$i}>$i</option>";
                    }
                ?>
            </select><br/><br/>                        
    </p>                    
<h3 class="form_header">
    Contact informations:
</h3>                    
    <p><b>Current address*:</b>
        <input type="text" value="" id="c_address" />
    </p>
    <p><b>Current city*:</b>
        <input type="text" value="" name="c_city" id="c_city" />&nbsp;&nbsp;
        <b>Postal code:</b>
        <input type="text" value="" name="c_pc" id="c_pc" />
    </p>
    <p><b></b>
        <b>Phone no:</b>
        <input type="text" value="" name="c_pn" class="c_pn" />&nbsp;&nbsp;
        <b>Mobile no*:</b>
        <input type="text" value="" name="c_mn" class="c_mn" />                            
    </p>
    <p><b>Parmanent address*:</b>
        <input type="text" value="" id="p_address" />
    </p>
    <p><b>Parmanent city*:</b>
        <input type="text" value="" name="p_city" id="p_city" />&nbsp;&nbsp;
        <b>Postal code:</b>
        <input type="text" value="" name="p_pc" id="p_pc" />
    </p>
    <p><b></b>
        <b>Phone no:</b>
        <input type="text" value="" name="c_pn" class="c_pn" />&nbsp;&nbsp;
        <b>Mobile no*:</b>
        <input type="text" value="" name="c_mn" class="c_mn" />                            
    </p>
    <p><b>Email no*:</b>
        <input type="text" value="" name="c_en" id="c_en" />&nbsp;&nbsp;<br/><br/>
    </p>
<h3 class="form_header">
    Personal informations:
</h3>                    
    <p><b>Job*:</b>
        <select name="job">
            <?php
                $jobs = array ('student', 'teacher' , 'developer', 'others');
                foreach ($jobs as $job) {
                    echo "<option value={$job}>{$job}</option>";
                }
            ?>
        </select>&nbsp;&nbsp;
        <b>Interested in*:</b>
        <input type="checkbox" name="interest" value="develop"> Developing &nbsp;
        <input type="checkbox" name="interest" value="program"> Programming &nbsp;
        <input type="checkbox" name="interest" value="none"> None of these                                        
    </p>
    <p><b>Known of*:</b>
        <input type="checkbox" name="known" value="c"> C/C++ &nbsp;
        <input type="checkbox" name="known" value="c_sharp"> C# &nbsp;                            
        <input type="checkbox" name="known" value="java"> Java &nbsp;
        <input type="checkbox" name="known" value="HTML"> HTML &nbsp;
        <input type="checkbox" name="known" value="php"> PHP &nbsp;                            
        <input type="checkbox" name="known" value="others"> Others &nbsp;
        <input type="checkbox" name="known" value="none"> None                            
    </p>
    <p><b>About you:</b>
        <br/><br/><textarea name="about" rows="10" cols="73"></textarea>
        
    </p><br/>
    
<h3 class="form_header">
    Login informations:
</h3>                    
    <p><b>Username*:</b>
        <input type="text" name="user_name"  maxlength="30" value="<?php echo htmlentities($user_name); ?>" id="user_name"/>
    </p>
        
    <p><b>Password*:</b>
        <input type="password" name="password"  maxlength="30" value="<?php echo htmlentities($password); ?>" id="password" />
		
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

