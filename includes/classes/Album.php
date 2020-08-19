
<!-- so i'm gonna create an artist class , just to save us having to do this every single time we want 
to use an artist  -->

<?php
	class Album {

        private $pdo;
        private $id;
        private $title;
        private $artistId;
    
        private $images_path; 


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
            // instead of returning the artistId we can use the artistId to return artist object 
            return new Artist($this->pdo, $this->artistId);
        }

        public function getImagesPath(){
            return $this->images_path;
        }
    }
?>