<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php set_up_variables("members"); ?>
<?php confirm_logged_in(); ?>
<?php //include("includes/header.php"); ?>
<?php
    if (isset($_POST['submit2'])) {
        if (isset($_COOKIE['remember'])) {
            setcookie("remember" , "" , time()-(7*24*60*60));
        }
        $_SESSION= array();
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '' , time()-10000 , '/');
        }
        session_destroy();        
        redirect_to("log_in.php?logout=1");
    } else if (isset($_POST['submit'])) {
        redirect_to("index.php");
    }
?>
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

</head>
<body id="page1" onLoad="new ElementMaxHeight();">
<body id="page2">

<!-- header -->
	<header>
		<div class="container">
			<div class="header-box">
				<div class="left">
					<div class="right">
						<nav>
							<ul>
								<li class="current"><a href="indexd.php">Home</a></li>
								<li><a href="services.php">Publications</a></li>
								<li><a href="profile.php">Profile</a></li>
								
								<li><a href="notice.php">Notice Board</a></li>
								<li><a href="contacts.html">Contacts</a></li>
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
                </td>
                <td id="page">
                    <h2>
                        Logout.
                    </h2>
                    <p> Do you really want to log out? <br/>
                    <form action="log_out.php" method="post">
                        <input type="submit" name="submit" value="No"/>
                        <input type="submit" name="submit2" value="Yes"/>
                    </form>
                    </p>
                </td>
                <td id="m_navigation">
                </td>                
            </tr>
        </table>
    </div>
<?php include("includes/footer.php"); ?>