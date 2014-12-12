<?php
require_once("includes/connection.php");
$id = $_GET['id'];


$query = "update users set validation = '1' where id='$id'";
        if(mysql_query($query , $connection)){
			header("location: request.php");
		}
		else{
		echo mysql_error();
		}

?>