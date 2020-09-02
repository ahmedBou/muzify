
<!-- so i'm gonna create an artist class , just to save us having to do this every single time we want 
to use an artist  -->

<?php
	class Album {

        private $pdo;
        private $id;
        private $title;
        private $artistId;
    
        private $images_path; 

        // there is to ways:1. have a bunch of class variables , then we do one query , which selects all the data
        // and then we assign all the data to the class variables, then when we get this data we just return these
        // variables.
        //  in the artist i did it slight different way, where we only have the two class variable, but when we want
        // to retrieve something,getName() for example we do a new query on its own and return that to me.
        // we can do it either way it depends whether you want to get how class variables , do a bunch of class 
        // variables like in album, or i can just do a sperarate query every time i want to retrieve some data and then
        // just return getName().
		public function __construct($pdo, $id) {
			$this->pdo = $pdo;
            $this->id = $id;
            $albumQuery = $this->pdo->query("SELECT * FROM album WHERE album_id='$this->id'");
            $album = $albumQuery->fetch(PDO::FETCH_ASSOC);

            $this->title = $album['title'];
            $this->artistId = $album['artist_id'];
            $this->images_path = $album['images_path'];
        }

        public function getTitle(){
            return $this->title;
        }
        public function getArtist(){
            // instead of returning the artistId we can use the artistId to return artist object,the artist itself
            return new Artist($this->pdo, $this->artistId);
        }

        public function getImagesPath(){
            return $this->images_path;
        }
        
        public function getNumberOfTrack(){
            $numberTrack = $this->pdo->query("SELECT COUNT(track_id) from track WHERE album_id ='$this->id'");
            return $numberTrack->fetchColumn();
        }

        public function getSongId(){
            $songQuery = $this->pdo->query("SELECT track_id from track WHERE album_id ='$this->id'");
            
            $array = array();
            while($row = $songQuery->fetch(PDO::FETCH_ASSOC)){
                // echo $row['track_id'];
                array_push($array, $row['track_id']);

            }
            return $array;
        }
    }
?>