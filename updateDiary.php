<?php 
    require('local_setting.php');

    $diaryName = $_POST['diaryName'];
    $userID = $_POST['userID'];
    $diaryID = $_GET['diaryID'];
    $status = $_POST['status'];

    $sqlUpdateQuery = "UPDATE diary SET diary_name = '{$diaryName}', status = '{$status}' WHERE diary_id = '{$diaryID}'";

    $resultUpdateQuery = mysqli_query($conn,$sqlUpdateQuery);

    header("Location: main.php?userID=$userID");
?>