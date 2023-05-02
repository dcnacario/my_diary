<?php 
    $diaryID = $_GET['diaryID'];
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
        <form action="story_main.php">
            <input type="hidden" name="userID" value="<?php echo $userID?>">
            <input type="hidden" name="diaryID" value="<?php echo $diaryID?>">
            <button type="submit" class="button_back"><i class='bx bxs-left-arrow' ></i> Back</button>
        </form>
        </div>
        <form>
            <h2 style="text-align:left">New Story</h2>
            <div class="inputbox">
                <input type="date" name="storyDate" class="inputtext_date" value="<?php echo date("Y-m-d")?>">;
            </div>
            <div class="inputbox">
                <textarea name="storyMessage" id="storyMessage" cols="30" rows="10" class="storyMessage"></textarea>
            </div>
            <br>
            <button class="btn" type="submit" formaction="insertStory.php?diaryID=<?php echo $diaryID?>" formmethod="post">Create Story</button>
        </form>
    </div>

    </body>
</html>