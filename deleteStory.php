<?php 
    require('local_setting.php');
    $storyID = $_GET['storyID'];
    $diaryID = $_POST['diaryID'];
    $userID = $_POST['userID'];

    $deleteQuery = "DELETE FROM story WHERE story_id = '{$storyID}'";

    $resultDeleteQuery = mysqli_query($conn,$deleteQuery);

    header("Location: story_main.php?diaryID=$diaryID&userID=$userID");
?>