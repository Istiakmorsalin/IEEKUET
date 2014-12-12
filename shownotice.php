<?php
session_start();
if(!isset($_SESSION['user_name'])){
//echo "sdf".$_SESSION['user_name'];
header("location: log_in.php"); exit();
}
if(isset($_GET['id'])){
	$id = $_GET['id'];
}
else { die('id could not found');}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>IEEE Student Branch KUET</title>
<meta name="description" content="Place your description here">
<meta name="keywords" content="put, your, keyword, here">
<meta name="author" content="Templates.com - website templates provider">
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
<body id="page1" onLoad="new ElementMaxHeight();">
<div class="tail-top">
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
								<li><a href="profile.php">Profile</a></li>
								
								<li class="current"><a href="notice.php">Notice Board</a></li>
								<li><a href="contacts.html">Presentation</a></li>
							</ul>
						</nav>
						<h1><a href="indexd.php"><span>IEEE </span>KUET</a></h1>
					</div>
				</div>
			</div>
			
		</div>
	</header>
<!-- content -->
	<section id="content">
		<div class="container">
			<div class="inside">
				<div id="slogan">
					
				</div>
				
				
			
				<div class="inside1">
					<div class="wrap row-2">
						<article class="col-1">
							<h2> Notice Board</h2>
							<ul class="solutions">
								<li><p>Members' of IEEE Student Branch Kuet will get important notice update From here:</p></li>
								
							</ul>
						</article>
						<article class="col-2">
						<?php
							require_once("includes/connection.php");
							require_once("includes/functions.php");
							
							$query = "SELECT * FROM notice_board where id='$id' order by id desc";
							$result_set = mysql_query($query);
							$count =1;
							confirm_query($result_set);
							echo "<div style=''>";
							while($result = mysql_fetch_array($result_set)){
								if($count>5){break;}
								echo "<h2>".$result['title']."</h2><br>";
								echo "<h2>".$result['subject']."</h2><br>";
								$count++;
								
							}
							echo "<div>";
						?>
						</article>
						<div class="clear"></div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<!-- aside -->
<aside>
	<div class="container">
		<div class="inside">
			<div class="line-ver1">
				<div class="line-ver2">
					<div class="line-ver3">
						<div class="wrapper line-ver4">
							<ul class="list col-1">
								<br>
								<br>
								<br>
								<br>
								
							</ul>
							<ul class="list col-2">
							<br>
								<br>
								<br>
								<br>
								
							</ul>
							<ul class="list col-3">
							<br>
								<br>
								<br>
								<br>
								
							</ul>
							<ul class="list col-4">
							<br>
								<br>
								<br>
								<br>
								
							</ul>
							<ul class="list col-5">
							<br>
								<br>
								<br>
								<br>
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</aside>

<!-- footer -->
<footer>
	<div class="container">
		<div class="inside">
			
		</div>
	</div>
</footer>
<script type="text/javascript"> Cufon.now(); </script>
</body>
</html>