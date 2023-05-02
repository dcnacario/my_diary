<?php 
    require('local_setting.php');

    $diaryID = $_REQUEST['diaryID'];
    $diaryID = (int)$diaryID;
    $storyDate = $_POST['storyDate'];
    $storyMessage = $_POST['storyMessage'];

    $userDetails = array();

    $queryStory = "INSERT INTO story VALUES ('','{$storyDate}',{$diaryID},'{$storyMessage}')";
    $queryResult = mysqli_query($conn,$queryStory);

    $queryFetch = "SELECT user.user_id FROM user 
        INNER JOIN diary 
        ON user.user_id = diary.user_id
        INNER JOIN story 
        ON diary.diary_id = story.diary_id
        WHERE diary.diary_id = {$diaryID}";
    
    $queryResultFetch = mysqli_query($conn,$queryFetch);

    if (mysqli_num_rows($queryResultFetch) > 0) {
        while($userResult = mysqli_fetch_array($queryResultFetch)) {
           $userDetails['user_id'] = $userResult['user_id'];
           $userDetails['username'] = $userResult['username'];
           $userDetails['password'] = $userResult['password'];
           $userDetails['first_name'] = $userResult['first_name'];
           $userDetails['last_name'] = $userResult['last_name'];
        }
    }

    header("Location: main.php?userID=".$userDetails['user_id']);
?>