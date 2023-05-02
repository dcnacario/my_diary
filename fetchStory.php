<?php 
    require('local_setting.php');
    $diaryID = $_REQUEST['diaryID'];
    $queryFetchStory = "SELECT * FROM story 
        INNER JOIN diary ON story.diary_id = diary.diary_id 
        WHERE story.diary_id = {$diaryID}";

    $resultFetchStory = mysqli_query($conn,$queryFetchStory);

?>