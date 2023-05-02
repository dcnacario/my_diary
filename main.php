<?php 
    require('fetchUser.php');
    $userID = $_REQUEST['userID'];

    $fetchDiarySearchArray = array();
    $queryFetchDiarySearch = "SELECT * FROM diary 
        INNER JOIN user ON diary.user_id = user.user_id 
        WHERE user.user_id = {$userID}";

    $resultFetchDiarySearch = mysqli_query($conn,$queryFetchDiarySearch);

    while($fetchDiarySearchResult = mysqli_fetch_array($resultFetchDiarySearch)){
            $fetchDiarySearchArray['diary_id'] = $fetchDiarySearchResult['diary_id'];
            $fetchDiarySearchArray['status'] = $fetchDiarySearchResult['status'];
    }
?>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
        <link rel="stylesheet" href="style3.css"> 
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>
    <body onload="disableView()">
        <div class="headercontainer">
            <h2 class="style2">my.</h2>
            <h2 class="style3">diary</h2>
        </div>
        <div class="container">
            <div class="control_container">
                <form method="post" action="new_diary.php?userID=<?php echo $userDetails['user_id']?>">
                <button type="submit" class="btn" id="btnDiary"><i class='bx bx-notepad'></i>Create Diary</button>
                </form>
                <p class="diary_title">Menu</p>
                <p><a href="#" onclick="searchBarHidden()"><i class='bx bxs-notepad' ></i> Diary </a></p>
                <p> <a href="#"  onclick="searchBar()"><i class='bx bx-search'></i> Search</a></p>
                <div>
                <form action="logout.php">
                    <button type="submit" class="button_logout"><i class='bx bxs-log-out bx-fade-left-hover'></i>Sign out</button>
                </form>
                </div>
            </div>
            <div class="search_container" id="search">
                <form action="searchDiary.php?diaryID=<?php echo  $fetchDiarySearchArray['diary_id']?>" method="POST">
                    <input type="hidden" name="userID" value="<?php echo $userID?>">
                    <input type="text" name="searchbar" id="searchbar" class="input">
                    <Button type="submit" name="searchBtn" class="searchbtn"><i class='bx bx-search'></i></Button>
                </form>
            </div>
            <div class="side_container">
                <table class="diary">
                    <tr>
                        <th>No.</th>
                        <th>Diary Name</th>
                        <th>Date Created</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <?php 
                       require('fetchDiary.php');
                       if (mysqli_num_rows($resultFetchDiary) > 0) {
                           while($diaryResult = mysqli_fetch_array($resultFetchDiary)) {
                    ?> 
                    <tr>   
                        <td><?php echo $diaryResult['diary_id']?></td>
                        <td><?php echo $diaryResult['diary_name']?></td>
                        <td><?php echo $diaryResult['date_created']?></td>
                        <input type="hidden" id="status" value="<?php echo $diaryResult['status']?>">
                        <td><?php echo $diaryResult['status']?></td>
                        <td>
                        <div class="group_right">
                        <form>
                        <input type="hidden" name="userID" value="<?php echo $userID?>">
                        <button formaction="deleteDiary.php?diaryID=<?php echo $diaryResult['diary_id']?>" formmethod="post" class="btn_right_delete">
                        <i class='bx bxs-trash' ></i></button>
                        </form>
                        <form>
                        <input type="hidden" name="userID" value="<?php echo $userID?>">
                        <button formaction="updatePageDiary.php?diaryID=<?php echo $diaryResult['diary_id']?>" formmethod="post" class="btn_right">
                        <i class='bx bxs-edit' ></i></button>
                        </form>
                        <form>
                        <input type="hidden" name="userID" value="<?php echo $userID?>">
                        <button formaction="story_main.php?diaryID=<?php echo $diaryResult['diary_id']?>" formmethod="post" class="btn_right_go" id="storyBtn">
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
    <script>
        function disableView(){
            var status = document.getElementById('status').value;
            var storyView = document.getElementById('storyBtn');
            if (status == "FORGOTTEN"){
                storyView.disabled = true;
                storyView.addEventListener("mouseover",function(){
                    storyView.style.backgroundColor="rgba(220,222,247)";
                });
            }
            else {
                storyView.disabled = false;
                storyView.addEventListener("mouseout",function(){
                    storyView.style.backgroundColor="rgba(210,87,87)";
                });
            }
        }
    </script>
</html>