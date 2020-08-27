<?php 
include("../../config.php");

if(isset($_POST['albumId'])){

    $albumId= $_POST['albumId'];
    $query = $pdo->query("SELECT * FROM album WHERE album_id='$albumId' ");
    $resultArray = $query->fetch(PDO::FETCH_ASSOC);
    echo json_encode($resultArray);
    
}


?>