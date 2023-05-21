<?php 
    require('local_setting.php');
    $diaryID = $_REQUEST['diaryID'];
    $userID = $_REQUEST['userID'];

    $fetchStorySearchArray = array();

    $queryFetchStorySearch = "SELECT * FROM story 
        INNER JOIN diary ON story.diary_id = diary.diary_id 
        WHERE story.diary_id = {$diaryID}";
 
    $resultFetchStorySearch = mysqli_query($conn,$queryFetchStorySearch);
 
    while($fetchStorySearchResult = mysqli_fetch_array($resultFetchStorySearch)){
         $fetchStorySearchArray['story_id'] = $fetchStorySearchResult['story_id'];
    }
?>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="style5.css"> 
    </head>
    <body>
        <div class="headercontainer">
            <h2 class="style2">my.</h2>
            <h2 class="style3">diary</h2>
        </div>
        <div class="container">
            <div class="control_container">
                <form method="post" action="new_story.php?diaryID=<?php echo $diaryID?>&userID=<?php echo $userID?>">
                <button type="submit" class="btn" id="btnDiary"><i class='bx bx-notepad'></i>Create Story</button>
                </form>
                <p class="diary_title">Menu</p>
                <p><a href="#" onclick="searchBarHidden()"><i class='bx bxs-notepad' ></i> Story </a></p>
                <p> <a href="#"  onclick="searchBar()"><i class='bx bx-search'></i> Search</a></p>
                <div>
                    <form action="story_wall.php" method="post">
                        <input type="hidden" name="userID" value="<?php echo $userID?>">
                        <input type="hidden" name="diaryID" value="<?php echo $diaryID?>">
                        <input type="hidden" name="storyID" value="<?php echo $storyID?>">
                        <button type="submit" class="wallBtn">Public Wall</button>
                    </form>
                </div>
                <form action="main.php?userID=<?php echo $userID?>" method="POST">
                    <button type="submit" name="backButton" class="btn_back"><i class='bx bx-arrow-back'></i> Back</button>
                </form>
            </div>
            <div class="search_container" id="search">
                <form action="searchStory.php?diaryID=<?php echo $diaryID?>" method="POST">
                    <input type="hidden" name="storyID" value="<?php echo  $fetchStorySearchArray['story_id']?>">
                    <input type="hidden" name="userID" value="<?php echo $userID?>">
                    <input type="text" name="searchbar" id="searchbar" class="input">
                    <button type="submit" name="searchbtn" class="btn_search"><i class='bx bx-search'></i></button>
                </form>
            </div>
            <div class="side_container">
                <table class="diary">
                    <tr>
                        <th>No.</th>
                        <th>Story Date</th>
                        <th>Story Message</th>
                        <th>Action</th>
                    </tr>
                    <?php 
                    require('fetchStory.php');
                    if (mysqli_num_rows($resultFetchStory) > 0) {
                        while($storyResult = mysqli_fetch_array($resultFetchStory)) {
                    ?>
                    <tr>   
                        <td><?php echo $storyResult['story_id']?></td>
                        <td><?php echo $storyResult['story_date']?></td>
                        <td><?php echo $storyResult['story_message']?></td>
                        <td>
                        <div class="group_right">
                        <form  method="POST" action="deleteStory.php?storyID=<?php echo $storyResult['story_id']?>">
                        <input type="hidden" name="userID" value="<?php echo $userID?>">
                        <input type="hidden" name="diaryID" value="<?php echo $diaryID?>">
                        <button type="submit" class="btn_right_delete">
                        <i class='bx bxs-trash' ></i></button>
                        </form>
                        <form method="POST" action="view_story.php?storyID=<?php echo $storyResult['story_id']?>">
                        <input type="hidden" name="diaryID" value="<?php echo $diaryID?>">
                        <input type="hidden" name="userID" value="<?php echo $userID?>">
                        <button type="submit" class="btn_right_go">
                        <i class='bx bxs-book-content'></i></button>
                        </form>
                        </div>
                        </td>     
                    </tr>
                   <?php 
                        }
                    }
                   ?>
                </table>
            </div>
        </div>
    </body>
    <script rel="text/javascript" src="search.js"></script>
</html>