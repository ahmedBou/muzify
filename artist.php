<?php include('includes/header.php');

if(isset($_GET['id'])){
    $artistId = $_GET['id'];
}
else{
    header("Location: index.php");
}
$artist = new Artist($pdo, $artistId)
?>

<div class="entityInfo">
    <div class="centerSecion">
        <div class="artistInfo">
            <h1><?php echo $artist->getName() ?></h1>
        </div>
    </div>

</div>

<div class="trackListContainer">
    <h3>Popular</h3>
    <ul class="trackList">
   
    <?php 
        $trackIdArray = $artist->getSongId();

  
        // echo '<script type="text/javascript">alert("'.$trackIdArray.'");</script>';

        $i= 1;

        foreach($trackIdArray as $trackId){
            // echo $trackId ."<br>";
            $albumTrack = new Track($pdo, $trackId);
            // echo $albumTrack->getTitle();
            $albumArtist = $albumTrack->getArtist();
            // echo $albumArtist;
        
            echo "<li class='tracklistRow'>

                        <div class='trackCount'>
                            <div class='playIcon' >
                            <i class='fa fa-play-circle' onclick='setTrack(\"" . $albumTrack->getId() . "\", tempPlaylist, true)'></i>
                            </div>
                            <span class='trackNumber'>$i</span>
                        </div>

                        <div class='trackInfo'>
                            <span class='trackName'>". $albumTrack->getTitle() ."</span>
                            
                        </div>

                        <div class='trackOptions'>    
                            <span class='iconOption'><i class='fa fa-ellipsis-h'></i></span>
                            <div class='trackDuration'>
                            <span class='duration'>". $albumTrack->getDuration() ."</span>
                            </div>
                        </div>

                </li>";
            $i++;
        }
        ?>
    </ul>
</div>

<?php include('includes/footer.php') ?>
