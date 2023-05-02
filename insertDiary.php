<?php 
    require('local_setting.php');
    $userID = $_GET['userID'];
    $userID = (int)$userID;
    $dateCreated = $_POST['diaryDate'];
    $diaryName = $_POST['diaryName'];
    $status = $_POST['status'];

    $queryDiary = "INSERT INTO diary VALUES ('','{$dateCreated}','{$diaryName}',{$userID},'{$status}')";
    $queryResult = mysqli_query($conn,$queryDiary);

    $lastInsertID = mysqli_insert_id($conn);

    header("Location: new_story.php?diaryID=$lastInsertID");

?>