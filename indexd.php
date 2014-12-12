<?php
session_start();
if(!isset($_SESSION['user_name'])){
//echo "sdf".$_SESSION['user_name'];
header("location: log_in.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>IEEE Student Branch KUET</title>

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
								<li class="current"><a href="indexd.php">Home</a></li>
								<li><a href="services.php">Publications</a></li>
								<li><a href="profile.php">Profile</a></li>
								
								<li><a href="notice.php">Notice Board</a></li>
								<li><a href="presentation.php">Presentaion</a></li>
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
			<div id="faded">
				<ul class="slides">
					<li><img src="images/slide-title1.gif"><a href="#"><span><span>Learn More</span></span></a></li>
					<li><img src="images/slide-title4.gif"><a href="#"><span><span>Learn More</span></span></a></li>
					<li><img src="images/slide-title3.gif"><a href="#"><span><span>Learn More</span></span></a></li>
					<li><img src="images/slide-title2.gif"><a href="#"><span><span>Learn More</span></span></a></li>
				</ul>
				<ul class="pagination">
					<li><a href="#" rel="0"><span>Coming events</span><small>Get more information</small></a></li>
					<li><a href="#" rel="1"><span>Conferences</span><small>Get more information</small></a></li>
					<li><a href="#" rel="2"><span>Projects</span><small>Get more information</small></a></li>
					<li><a href="#" rel="3"><span>Membership</span><small>Get more information</small></a></li>
				</ul>
			</div>
			
				<div class="inside1">
					<div class="wrap row-2">
						<article class="col-1">
							<h2> what is IEEE?</h2>
							<ul class="solutions">
								<li><p>IEEE stands for The Institute of Electrical and Electronics Engineers (IEEE, read I-Triple-E) is a professional association, headquartered in New York City,is dedicated to advancing technological innovation and excellence,has more than 400,000 members in more than 160 countries </p></li>
								
							</ul>
						</article>
						<article class="col-2">
							
							</form>
							<?php if(isset($_GET['user_name'])){ echo "<h2 style='color: #000000;'>You Have Successfully Logged in!</h2>";} ?>
							<h2>IEEE Vision @ KUET</h2>
							<p> The KUET IEEE provides learning opportunities within the engineering sciences, research, and technology. The goal of the IEEE education programs is to ensure the growth of skill and knowledge in the electricity-related technical professions and to foster individual commitment to continuing education among IEEE members, the engineering and scientific communities, and the general public.</p>
							<h2>IEEE Career & facilites @ KUET</h2>
							<p> KUET IEEE eLearning Library is a collection of online educational courses designed for self-paced learning. Education Partners, exclusive for IEEE members, offers on-line degree programs, certifications and courses at a 10% discount. A student who is a member oF IEEE can easily get a big platform to enlighten his experimental Engineering Ideas and smart solutions throughout the world.</p>
							<h2>IEEE important Contacts at KUET</h2>
							<p>	Swagata Prateek (CSE 2K8) <br> mobile no:	
01674 699472</p>
<p>Imtiaz Hossain  (EEE 2k8)<br> Mobile no:01674212476</p>
							<a href="http://www.ieee.org/index.html" class="link2"><span><span>Read More</span></span></a>
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