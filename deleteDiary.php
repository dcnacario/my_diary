<?php 
    require('local_setting.php');
    $diaryID = $_GET['diaryID'];
    $userID = $_POST['userID'];

    $deleteQuery = "DELETE FROM diary WHERE diary_id = '{$diaryID}'";

    $resultDeleteQuery = mysqli_query($conn,$deleteQuery);

    header("Location: main.php?userID=$userID");
?>