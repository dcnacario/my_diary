<?php 
    $userID = $_GET['userID'];
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
    <div>
        <form action="main.php?userID=<?php echo $userID?>">
            <input type="hidden" name="userID" value="<?php echo $userID?>">
            <button type="submit" class="button_back"><i class='bx bxs-left-arrow' ></i> Back</button>
        </form>
        </div>
        <form>
            <h2 style="text-align:left"><i class='bx bxs-note'></i>New Diary</h2>
            <div class="inputbox">
                <input type="text" name="status" id="status" class="inputtext" value="ACTIVE" style="text-align: center;" readonly>
            </div>
            <div class="inputbox">
                <input type="text" name="diaryName" id="diaryName" class="inputtext" placeholder="Name of Diary">
            </div>
            <div class="inputbox">
                <input type="date" name="diaryDate" class="inputtext" value="<?php echo date("Y-m-d")?>">;
            </div>
            <button class="btn" type="submit" formaction="insertDiary.php?userID=<?php echo $userID?>" formmethod="post">Create Diary</button>
        </form>
    </div>

    </body>
</html>