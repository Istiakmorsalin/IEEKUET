<?php
require_once("includes/connection.php");
$title = $_POST['title'];
$sub = $_POST['sub'];


$query = "insert into notice_board(title,subject) values('$title','$sub')";
        if(mysql_query($query , $connection)){
			header("location: addnotice.php?m=success!");
		}
		else{
		echo mysql_error();
		}

?>