<?php 
require 'db_connect.php';

extract($_POST);
$sql = "UPDATE users SET name='$name', username='$username', password='$password', user_type='$user_type' WHERE id=$id";
if(mysqli_query($conn, $sql)) {
	echo json_encode(array('status'=>1));
} else {

}
?>