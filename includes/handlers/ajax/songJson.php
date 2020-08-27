<?php 
// echo "hello";
include("../../config.php");
// before query the data we first have to retriev the songId variable that we passed in ajax call
if(isset($_POST['songId'])){
    $songId = $_POST['songId'];

    $query = $pdo->query("SELECT * FROM track WHERE track_id = '$songId'");
    // this convert the result into and array
    $resultArray = $query->fetch(PDO::FETCH_ASSOC);
    // echoing is how would return data from an ajax call.

    echo json_encode($resultArray);
    // {"track_id":"7","title":"hey","duration":"5","rating":"200","path":"assets\/music\/hey.mp3","count":"0","album_id":"2","genre_id":"1"}
    // we just retrieved a song from db without refreshing the page.

}
?>