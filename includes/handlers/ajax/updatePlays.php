
<?php
include("../../config.php");
// before query the data we first have to retriev the songId variable that we passed in ajax call
if(isset($_POST['songId'])){
    $songId = $_POST['songId'];
    $query = $pdo->query("UPDATE track SET count = count+1 WHERE track_id = '$songId'");


}
?>