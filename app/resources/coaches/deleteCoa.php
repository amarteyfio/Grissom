<?php
include '../../database/connection.php';


//Initialize the session
session_start();
 
// Check if the user is already logged in
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("Location: ../../../login.php");
    exit;
}

if (isset($_GET['delete_id'])) {
	$id = $_GET['delete_id'];
	mysqli_query($db, "DELETE FROM coaches WHERE id=$id");

    header("location: ../../../coaches.php");
	
}
?>