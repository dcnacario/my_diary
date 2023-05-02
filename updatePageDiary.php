<?php 
    require('local_setting.php');
    $userID = $_POST['userID'];
    $diaryID = $_GET['diaryID'];
    $diaryDetails = array();
    $queryFetchDiary = "SELECT * FROM diary 
        INNER JOIN user ON diary.user_id = user.user_id 
        WHERE user.user_id = {$userID}";

    $resultFetchDiary = mysqli_query($conn,$queryFetchDiary);

    if (mysqli_num_rows($resultFetchDiary) > 0) {
        while($diaryResult = mysqli_fetch_array($resultFetchDiary)) {
            $diaryDetails['diary_id'] = $diaryResult['diary_id']; 
            $diaryDetails['diary_name'] = $diaryResult['diary_name']; 
            $diaryDetails['date_created'] = $diaryResult['date_created']; 
            $diaryDetails['status'] = $diaryResult['status']; 
        }
    }
?>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
        <link rel="stylesheet" href="style4.css"> 
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <script rel="text/javascript" src="search.js"></script>
    </head>
    <body>
    <div class="headercontainer">
        <h2 class="style2">my.</h2>
        <h2 class="style3">diary</h2>
    </div>
    <div class="container">
        <form>
            <h2 style="text-align:left"><i class='bx bxs-note'></i>Update Diary</h2>
            <div class="inputbox">
                <select name="status" id="status" class="inputtext">
                    <option value="ACTIVE">ACTIVE</option>
                    <option value="FORGOTTEN">FORGOTTEN</option>
                </select>
            </div>
            <div class="inputbox">
                <input type="text" name="diaryName" id="diaryName" class="inputtext" placeholder="Name of Diary" value="<?php echo $diaryDetails['diary_name']?>">
            </div>
            <div class="inputbox">
                <input type="date" name="diaryDate" class="inputtext" value="<?php echo date("Y-m-d")?>" readonly>;
            </div>
            <input type="hidden" name="userID" value="<?php echo $userID?>">
            <button class="btn" type="submit" formaction="updateDiary.php?diaryID=<?php echo $diaryID?>" formmethod="post">Update</button>
        </form>
    </div>

    </body>
</html>