<?php
require('local_setting.php');
$userID = $_REQUEST['userID'];
$storyID = $_REQUEST['storyID'];

$fetchStorySearchArray = array();

$queryFetchStorySearch = "SELECT * FROM story";

$resultFetchStorySearch = mysqli_query($conn, $queryFetchStorySearch);

while ($fetchStorySearchResult = mysqli_fetch_array($resultFetchStorySearch)) {
    $fetchStorySearchArray[] = $fetchStorySearchResult['story_id'];
}

$userReaction = getUserReaction($conn, $storyID);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['reaction'])) {
        $reaction = $_POST['reaction'];

        if ($userReaction) {
            updateReaction($conn, $storyID, $reaction);
        } else {
            insertReaction($conn, $storyID, $reaction);
        }

        // Instead of redirecting, you can return a JSON response
        $response = array(
            'success' => true,
            'message' => 'Reaction updated successfully'
        );
        echo json_encode($response);
        exit();
    }
}

function getUserReaction($conn, $storyID)
{
    $userID = $_REQUEST['userID'];
    $sql = "SELECT reaction FROM reactions WHERE user_id = '{$userID}' AND story_id = '{$storyID}'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            return $row['reaction'];
        }
    }
    return null;
}

function updateReaction($conn, $storyID, $reaction)
{
    $userID = $_REQUEST['userID'];
    $sql = "UPDATE reactions SET reaction = '{$reaction}' WHERE user_id = '{$userID}' AND story_id = '{$storyID}'";
    $result = mysqli_query($conn, $sql);
}

function insertReaction($conn, $storyID, $reaction)
{
    $userID = $_REQUEST['userID'];
    $sql = "INSERT INTO reactions (user_id,story_id,reaction) VALUES ('$userID','$storyID','$reaction')";
    $result = mysqli_query($conn, $sql);
}

$conn->close();
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
            <p class="diary_title">Menu</p>
            <p><a href="#" onclick="searchBarHidden()"><i class='bx bxs-notepad'></i> Story </a></p>
            <p> <a href="#" onclick="searchBar()"><i class='bx bx-search'></i> Search</a></p>
            <form action="main.php?userID=<?php echo $userID ?>" method="POST">
                <button type="submit" name="backButton" class="btn_back"><i class='bx bx-arrow-back'></i> Back</button>
            </form>
        </div>
        <div class="search_container" id="search">
            <form action="searchStory.php?diaryID=<?php echo $diaryID ?>" method="POST">
                <input type="hidden" name="storyID" value="<?php echo $fetchStorySearchArray['story_id'] ?>">
                <input type="hidden" name="userID" value="<?php echo $userID ?>">
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
                    <th>Reactions</th>
                </tr>
                <?php
                require('fetchStoryWall.php');
                if (mysqli_num_rows($resultFetchStory) > 0) {
                    while ($storyResult = mysqli_fetch_array($resultFetchStory)) {
                        ?>
                        <tr>
                            <td><?php echo $storyResult['story_id'] ?></td>
                            <td><?php echo $storyResult['story_date'] ?></td>
                            <td><?php echo $storyResult['story_message'] ?></td>
                            <td>
                                <div class="group_right">
                                    <form method="POST" action="view_story.php?storyID=<?php echo $storyResult['story_id'] ?>">
                                        <input type="hidden" name="diaryID" value="<?php echo $diaryID ?>">
                                        <input type="hidden" name="userID" value="<?php echo $userID ?>">
                                        <button type="submit" class="btn_right_go">
                                            <i class='bx bxs-book-content'></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <div>
                                <form class="reaction-form">
                                    <input type="hidden" name="reaction" value="like">
                                    <input type="hidden" name="userID" value="<?php echo $userID ?>">
                                    <input type="hidden" name="diaryID" value="<?php echo $diaryID ?>">
                                    <input type="hidden" name="storyID" value="<?php echo $storyResult['story_id'] ?>">
                                    <button type="submit" <?php if ($userReaction === 'like') echo 'disabled'; ?>><i class='bx bx-like'></i></button>
                                </form>
                                </div>
                                <div>
                                <form class="reaction-form">
                                    <input type="hidden" name="reaction" value="heart">
                                    <input type="hidden" name="userID" value="<?php echo $userID ?>">
                                    <input type="hidden" name="diaryID" value="<?php echo $diaryID ?>">
                                    <input type="hidden" name="storyID" value="<?php echo $storyResult['story_id'] ?>">
                                    <button type="submit" <?php if ($userReaction === 'heart') echo 'disabled'; ?>><i class='bx bx-heart'></i></button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
        $('.reaction-form').submit(function(e) {
            e.preventDefault();

            // Get the form data
            var formData = $(this).serialize();

            // Get the clicked button and its value
            var clickedButton = $(this).find('button[type="submit"]:focus');
            var clickedValue = clickedButton.val();

            // Enable all reaction buttons
            var reactionButtons = $(this).find('button[type="submit"]');
            reactionButtons.prop('disabled', false);

            // Disable the clicked button
            clickedButton.prop('disabled', true);

            // Send an AJAX request to update the reaction
            $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                // Handle the response
                if (response.success) {
                alert(response.message);
                // Perform any necessary UI updates
                // ...
                } else {
                alert('Failed to update reaction.');
                // Re-enable all reaction buttons if there was an error
                reactionButtons.prop('disabled', false);
                }
            },
            error: function() {
                alert('An error occurred while updating the reaction.');
                // Re-enable all reaction buttons if there was an error
                reactionButtons.prop('disabled', false);
            }
            });
        });
        });
    </script>
</body>
<script rel="text/javascript" src="search.js"></script>

</html>
