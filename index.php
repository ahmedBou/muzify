
<?php  include("./includes/config.php");?>
<?php include('includes/header.php') ?>

<div class="mainTitle"><h1>Music that will rise your head</h1></div>

<div class="gridViewContainer">
    <?php
  

        $stmt = $pdo->query("SELECT * FROM album ORDER BY RAND() LIMIT 10");

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // print_r($row["images_path"]);
            // echo "<img src=";
            // ;
            
            $album = <<<DELIMETER
            <div class="gridViewItem">
                <img src="{$row["images_path"]}" style="width:300px; height:260px">
                <div class="gridViewInfo">
                    {$row["title"]}
                </div>
            </div>
            DELIMETER;
            echo $album;
            
        }
       
    ?>
</div>




<?php include('includes/footer.php') ?>

