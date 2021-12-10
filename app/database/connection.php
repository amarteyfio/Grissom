<?php
define('SERVER' , 'localhost');
define('USERNAME' , 'root');
define('PASSWORD' , '');
define('DB_NAME' , 'grissom');

$db = mysqli_connect(SERVER,USERNAME,PASSWORD,DB_NAME);

//Checking connection
if($db === false){
    die("Error: connection error. " . mysqli_connect_error());
}

?>