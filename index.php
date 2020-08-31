
<?php include('includes/header.php') ?>

<div class="mainTitle"><h1>Deep dive into beautiful music</h1></div>

<div class="gridViewContainer">
     <?php
        $stmt = $pdo->query("SELECT * FROM album ORDER BY RAND() LIMIT 10");

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // print_r($row["images_path"]);
            // echo "<img src=";
            // ;
            
            $album = <<<DELIMETER
            <div class="gridViewItem">
                <a href='album.php?id={$row["album_id"]}'>
                    <img src="{$row["images_path"]}" style="width:300px; height:260px">
                    <div class="gridViewInfo">
                        {$row["title"]}
                    </div>
                </a>
            </div>
            DELIMETER;
            echo $album;
            
        }
       
    ?>
</div>
<?php include("includes/footer.php"); ?>
