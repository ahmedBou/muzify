<?php 
include("../../config.php");

if(isset($_POST['artistId'])){
    $artistId = $_POST['artistId'];

    $query = $pdo->query("SELECT * FROM artist WHERE artist_id = '$artistId' ");
    $resultArray = $query->fetch(PDO::FETCH_ASSOC);
    echo json_encode($resultArray);

}
?>