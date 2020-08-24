
<!-- so i'm gonna create an artist class , just to save us having to do this every single time we want 
to use an artist  -->

<?php
//   $pdo = new PDO('mysql:host=localhost; port=3306; dbname=musicloud', 'root','root');

  // see the error folder for more detail
//   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
    }
?>