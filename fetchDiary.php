<?php 
    require('local_setting.php');
    $userID = $_REQUEST['userID'];
    $queryFetchDiary = "SELECT * FROM diary 
        INNER JOIN user ON diary.user_id = user.user_id 
        WHERE user.user_id = {$userID}";

    $resultFetchDiary = mysqli_query($conn,$queryFetchDiary);

?>