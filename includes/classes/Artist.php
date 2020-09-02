
<!-- so i'm gonna create an artist class , just to save us having to do this every single time we want 
to use an artist  -->

<?php

	class Artist{

        private $pdo;
        private $id;

		public function __construct($pdo, $id){
			$this->pdo = $pdo;
			$this->id = $id;
        }

		
        public function getName(){
            $artistQuery = $this->pdo->query("SELECT * FROM artist WHERE artist_id= '$this->id' ");
            $artist = $artistQuery->fetch(PDO::FETCH_ASSOC);
            return $artist['name'];
        }
        public function getId() {
			return $this->id;
		}

        public function getSongId(){
            $songQuery = $this->pdo->query("SELECT track_id from track WHERE artist_id = '$this->id' ORDER BY COUNT DESC");        
            $array = array();

            while($row = $songQuery->fetch(PDO::FETCH_ASSOC)){
                echo $row['track_id'];
                array_push($array, $row['track_id']);
            }
            return $array;

        }

    }
?>