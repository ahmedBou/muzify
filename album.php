
<?php include('includes/header.php');

if(isset($_GET['id'])){
    $albumId = $_GET['id'];
}else{
    header("Location: index.php");
}
// $albumQuery = $pdo->query("SELECT * FROM album WHERE album_id= '$albumId' ");
// $single_album = $albumQuery->fetch(PDO::FETCH_ASSOC);
// echo $single_album['title'] . "<br>";

$album = new Album($pdo, $albumId);
// echo $album->getTitle() ."<br>";

// $artistId = $single_album['artist_id'];

// $artistQuery = $pdo->query("SELECT * FROM artist WHERE artist_id='$artistId'");
// $artist = $artistQuery->fetch(PDO::FETCH_ASSOC);
// echo $artist['name'];

// $artist = new Artist($pdo, $album['artist_id']);
// echo $artist->getName();
$artist = $album->getArtist();
// echo $artist->getName() ;

$track = new Track($pdo, $albumId);
// echo $track->getTitle();
?>

<div class="entityInfo">
    <div class="leftSection">
        <img src="<?php echo $album->getImagesPath();?>">  
    </div>
    <div class="rightSection">
        <h2><?php echo $album->getTitle(); ?></h2>
        <p><?php echo $artist->getName(); ?></p>
        <p><?php echo $album->getNumberOfTrack()?> songs</p>
    </div>

</div>

<div class="trackListContainer">
    <ul class="trackList">
   
        <?php 
            $trackIdArray = $album->getSongId();
            // echo $trackIdArray;
            $i= 1;
            foreach($trackIdArray as $trackId){
                // echo $trackId ."<br>";
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







<?php include('includes/footer.php') ?>
