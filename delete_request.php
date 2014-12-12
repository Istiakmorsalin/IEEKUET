<?php
require_once("includes/connection.php");
$id = $_GET['id'];


$query = "delete from users where id='$id'";
        if(mysql_query($query , $connection)){
			header("location: request.php");
		}
		else{
		echo mysql_error();
		}

?>