<?php
require 'db_connect.php';
	
	$qry = $conn->query("SELECT * from users where id='".$_GET['id']."' ");
	if($qry){
		echo json_encode($qry->fetch_array());
	}
?>