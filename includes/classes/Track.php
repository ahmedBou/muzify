<?php 

class Track{
    private $pdo;
    private $id;
    private $pdoData; // hold the result of the query, so we can comeback and access it at any time.
    private $title;
    private $albumId;
    private $genre;
    private $duration;
    private $path;
    private $count;

    public function __construct($pdo, $id)
    {
        $this->id = $id;
        $this->pdo = $pdo;

        $trackQuery = $this->pdo->query("SELECT * FROM track WHERE track_id = '$this->id'");
        $this->pdoData = $trackQuery->fetch(PDO::FETCH_ASSOC);

        $this->title = $this->pdoData["title"];
        $this->albumId = $this->pdoData["albumId"];
        $this->genre = $this->pdoData["genre"];
        $this->duration = $this->pdoData["duration"];
        $this->path = $this->pdoData["path"];
        $this->count = $this->pdoData["count"];
    }

    public function getTitle(){
        return $this->title;
    }   
    public function getAlbumId(){
        return new Album($this->pdo, $this->albumId);
    }     

    public function getArtist() {
        return new Artist($this->pdo, $this->artistId);
    }
    public function getId() {
        return $this->id;
    }
    public function getGenre(){
        return $this->genre;
    }  

    public function getDuration(){
        return $this->duration;
    }   
    public function getPath(){
        return $this->path;
    }   
    public function getPdoData(){
        return $this->pdoData;
    }

    public function getCount(){
        return $this->count;
    }   
}

?>