<?php require_once("includes/session.php");

function checking_authority () {
      if (isset ($_SESSION['admin_value']) && $_SESSION['admin_value'] ==1) {
		 return true;
      }
	  else return false;
   }
?>
<?php if(!checking_authority()){ header("location: a_message.php");} ?>
<?php confirm_logged_in(); ?>
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
								<li><a href="contacts.html">Presentaion</a></li>
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
                        &nbsp;
                </td>
                <td id="page">
                    <h2>Admin Menu</h2>
                    <h3>
                        <?php
                            if (isset($_GET['messege']) && $_GET['messege']=="success") {
                                echo "\"{$_GET['user_name']}\" has successfully added as an admin.";
                            }
                        ?>
                    </h3>
                    <p>Welcome to the Admin area.</p>
                    <ul>
					
                       
                        <li><a href="add_another_admin.php">Add Another Admin</a></li>
						<li><a href="addnotice.php">Add Notice</a></li>
						<li><a href="request.php">Member Reqest</a></li>
                        <li><a href="indexd.php">Return to Home</a></li>
                        <li><a href="log_out.php">Logout</a></li>                        
                    </ul>
					
                </td>
                <td id="m_navigation">
                </td>                
            </tr>
        </table>
    </div>
<?php include("includes/footer.php"); ?>