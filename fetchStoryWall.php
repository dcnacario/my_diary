<?php 
    require('local_setting.php');
    $diaryID = $_REQUEST['diaryID'];
    $queryFetchStory = "SELECT * FROM story";

    $resultFetchStory = mysqli_query($conn,$queryFetchStory);

?>