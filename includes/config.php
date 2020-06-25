<?php 
// output buffering
ob_start();

$timezone = date_default_timezone_set("Africa/Casablanca");

$con = mysqli_connect("localhost", "root", "","musicloud", "3306");
if(mysqli_connect_errno()){
    echo "Failed to connect: " .mysqli_connect_error();
}
?>