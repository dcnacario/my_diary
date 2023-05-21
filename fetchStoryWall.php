<?php 
    require('local_setting.php');
    $queryFetchStory = "SELECT * FROM story";

    $resultFetchStory = mysqli_query($conn,$queryFetchStory);

?>