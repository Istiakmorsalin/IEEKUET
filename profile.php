<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php  $user_type=user_type_set(); ?>
<?php set_up_variables($user_type); ?>
<?php confirm_logged_in(); ?>
<?php   if (isset($_GET['user_id'])) $user_id = $_GET['user_id'];
        else $user_id = $_SESSION['user_id'];
?>
<?php $result_set= get_everything_of_user($user_id,$connection); ?>
<!DOCTYPE html>
<html lang="en">
<head>


<meta charset="utf-8">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<script type="text/javascript" src="js/maxheight.js"></script>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/cufon-replace.js"></script>
<script type="text/javascript" src="js/Myriad_Pro_300.font.js"></script>
<script type="text/javascript" src="js/Myriad_Pro_400.font.js"></script>
<script type="text/javascript" src="js/jquery.faded.js"></script>
<script type="text/javascript" src="js/jquery.jqtransform.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript">
	$(function(){
		$("#faded").faded({
			speed: 500,
			crossfade: true,
			autoplay: 10000,
			autopagination:false
		});
		
		$('#domain-form').jqTransform({imgPath:'jqtransformplugin/img/'});
	});
</script>
<!--[if lt IE 7]>
<script type="text/javascript" src="http://info.template-help.com/files/ie6_warning/ie6_script_other.js"></script>
<![endif]-->
<!--[if lt IE 9]>
<script type="text/javascript" src="js/html5.js"></script>
<![endif]-->
</head>



<!-- header -->
	<header>
		<div class="container">
			<div class="header-box">
				<div class="left">
					<div class="right">
						<nav>
							<ul>
								<li><a href="indexd.php">Home</a></li>
								<li><a href="services.php">Publications</a></li>
								<li class="current" ><a href="profile.php">Profile</a></li>
								
								<li><a href="notice.php">Notice Board</a></li>
								<li><a href="presentation.php">Presentaion</a></li>
							</ul>
						</nav>
						<h1><a href="indexd.php"><span>IEEE </span>KUET</a></h1>
					</div>
				</div>
			</div>
			
		</div>
		
				
				
			
				

<link rel="stylesheet" href="css/public1.css" type="text/css" media="all">

<div id="main">
    <table id="structure">
        <tr>
            <td id="navigation">
                <ul class="subjects">
                    <li class="selected"><a href="profile.php">Profile: </a></li>
                    <ul class="pages">
                        <li class="selected"><a href="profile.php">View profile</a></li>
                        <li><a href="edit_profile.php">Edit profile</a></li>
                        <li><a href="edit_username_pass.php?state=1">Change Username/Password</a></li>
                        <li><a href="delete_profile.php">Delete profile</a></li>                                                
                     </ul>
                </ul>
                <br/>
				<div class="inside1">
					<div class="wrap row-2">
						<article class="col-1">
							<ul class="solutions">
							
                <?php
                    if ($_SESSION['admin_value']==1 && (isset($_GET['user_id']) && $result_set['admin_value']!=1))
                        echo "<a href=\"add_another_admin.php?user_id={$_GET['user_id']}\">Add {$result_set['user_name']} as admin</a>";
                ?>
            </td>
            <td id="page">
                <h2>
                    Profile of <?php echo "\"" . $result_set['user_name'] . "\""; ?>
                <?php if (!isset ($_GET['messege'])) echo "<hr/>" ; ?>
                </h2>
                <h3>
                    <?php if (isset ($_GET['messege'])) echo "Your profile has successfully edited.<hr/>";
                        if (isset($_GET['user'])) echo "Your profile has successfully created."; ?>
                </h3>
                
                <!--informations of user-->
                    <p class="profile"><br/><b>Name:</b> 
                            <?php echo $result_set['first_name'] . " " . $result_set['last_name'] . "."; ?>
                    </p>
                    
                    <?php
                        if (isset($result_set['country']) && !empty($result_set['country'])) {
                            echo "<p class=\"profile\"><b>Country: </b>";
                            echo $result_set['country'] . ".";
                            echo "</p>";
                        }
                    ?>
                    
                    <p class="profile"><b>Sex:</b> 
                        <?php echo $result_set['sex'] . "."; ?>
                    </p>
                    <?php
                        if ((isset($result_set['date']) && $result_set['date'] != 0) && (isset($result_set['date']) && $result_set['date'] != 0) && isset($result_set['date'])) {
                            echo "<p class=\"profile\"><b>Birthdate: </b>";
                            echo $result_set['date'] . " " . $result_set['month'] . " " . $result_set['year'] . ".";
                            echo "</p>";
                        }
                    ?>
                    <p class="profile"><b>Current Address:</b> 
                        <?php echo $result_set['c_address'] . ".";?>
                    </p>
                    <?php
                        if (isset($result_set['c_city']) && !empty($result_set['c_city'])) {
                            echo "<p class=\"profile\"><b>Current City: </b>";
                            echo $result_set['c_city'] . ".";
                            echo "</p>";
                        }
                    ?>
                    <?php
                        if (isset($result_set['c_pn']) && !empty($result_set['c_pn'])) {
                            echo "<p class=\"profile\"><b>Phone No(Current): </b>";
                            echo $result_set['c_pn'] . ".";
                            echo "</p>";
                        }
                    ?>
                    <p class="profile"><b>Mobile No(Current):</b> 
                        <?php echo $result_set['c_mn'] . ".";?>
                    </p>                                          

                    <p class="profile"><b>Parmanent Address:</b> 
                        <?php echo $result_set['p_address'] . ".";?>
                    </p>
                    <p class="profile"><b>Parmanent City:</b> 
                        <?php echo $result_set['p_city'] . ".";?>
                    </p>
                    <p>
                    <?php
                        if (isset($result_set['p_pn']) && !empty($result_set['p_pn'])) {                        
                            echo "<p class=\"profile\"><b>Phone No(Parmanent): </b>";
                            echo $result_set['p_pn'] . ".";
                            echo "</p>";
                        }
                    ?>
                    <?php
                        if (isset($result_set['p_mn']) && !empty($result_set['p_mn'])) {
                            echo "<p class=\"profile\"><b>Mobile No(Parmanent): </b>";
                            echo $result_set['p_mn'] . ".";
                            echo "</p>";
                        }
                    ?>
                    </p>                    
                    <p class="profile"><b>Email:</b> 
                        <?php echo $result_set['email'] . ".";?>
                    </p>
                    <p class="profile"><b>Job:</b> 
                        <?php echo $result_set['job'] . ".";?>
                    </p>                                          
                    <p class="profile"><b>Interested in:</b> 
                        <?php echo $result_set['interest'] . "ing.";?>
                    </p>                                          
                    <?php
                        if (isset($result_set['known']) && !empty($result_set['known'])) {
                            echo "<p class=\"profile\"><b>Mobile No(Parmanent): </b>";
                            echo  $result_set['known'] . ".";
                            echo "</p>";
                        }
                    ?>
                    <p class="profile">
                        <?php
                            if (isset($result_set['about']) && !empty($result_set['about'])) {
                                echo "<b>About \"{$result_set['user_name']}\": </b>";
                                echo $result_set['about'] . ".";
                            }
                        ?>
                    <br/><br/>
                    <?php if(!isset ($_GET['user_id'])) {
                                echo "<hr/><a href=\"edit_profile.php\">Edit your profile.</a>";
                                echo "<br/><a href=\"edit_username_pass.php?state=1\">Change Username/Password.</a>";
                                echo "</p>";                                          
                                echo "<h3>";
                        }   
                        ?>
                </h3>                    
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
