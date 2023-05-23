<?php 
    require('local_setting.php');
    $storyID = $_REQUEST['storyID'];
    $diaryID = $_REQUEST['diaryID'];
    $userID = $_REQUEST['userID'];
    $storyDetails = array();
    $queryFetchStory = "SELECT * FROM story 
        INNER JOIN diary ON story.diary_id = diary.diary_id 
        WHERE story.story_id = {$storyID}";

    $resultFetchStory = mysqli_query($conn,$queryFetchStory);

    if (mysqli_num_rows($resultFetchStory) > 0) {
        while($storyResult = mysqli_fetch_array($resultFetchStory)) {
            $storyDetails['story_id'] = $storyResult['story_id']; 
            $storyDetails['story_date'] = $storyResult['story_date']; 
            $storyDetails['story_message'] = $storyResult['story_message']; 
            $storyDetails['diary_id'] = $storyResult['diary_id']; 
        }
    }
?>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
        <link rel="stylesheet" href="style6.css"> 
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>
    <body>
    <div class="headercontainer">
        <h2 class="style2">my.</h2>
        <h2 class="style3">diary</h2>
    </div>
    <div class="container">
        <form>
            <h2 style="text-align:left">Story</h2>
            <div class="inputbox">
                <input type="date" name="storyDate" class="inputtext_date" value="<?php echo $storyDetails['story_date']?>" readonly>
            </div>
            <div class="inputbox">
                <textarea name="storyMessage" id="storyMessage" cols="30" rows="10" class="storyMessage" readonly><?php echo $storyDetails['story_message']?></textarea>
            </div>
            <br>
            <button class="btn" type="submit" formaction="story_main.php?diaryID=<?php echo $diaryID?>&userID=<?php echo $userID?>" formmethod="post">Back</button>
        </form>
    </div>
    </body>
</html>