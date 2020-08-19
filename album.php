
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
?>

<div class="entityInfo">
    <div class="leftSection">
        <img src="<?php echo $album->getImagesPath();?>">  
    </div>
    <div class="rightSection">
        <h2><?php echo $album->getTitle(); ?></h2>
        <span><?php echo $artist->getName(); ?></span>
    </div>

</div>






<?php include('includes/footer.php') ?>
