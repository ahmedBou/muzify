<?php
if(isset($_GET['id'])){
    $artistId = $_GET['id'];
}else{
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
    <ul class="trackList">
   
        <?php 
        // TODO: create getSongId() in artist.php
            // $trackIdArray = $artist->getSongId();
            // echo $trackIdArray;
            $i= 1;
            foreach($trackIdArray as $trackId){
                // echo $trackId ."<br>";
                if($i>5){
                    break;
                }

                $albumTrack = new Track($pdo, $trackId);
                // echo $albumTrack->getTitle();
                // $albumArtist = $albumTrack->getArtist();
                // echo $albumArtist;
          
                echo  "<li class='tracklistRow'>
                            <div class='trackCount'>
                                <div class='playIcon'><i class='fa fa-play-circle'></i></div>
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
