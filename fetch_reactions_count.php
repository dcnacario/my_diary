<?php
// fetch_reaction_counts.php

require('local_setting.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $storyID = $_POST['storyID'];

    $likeCount = getReactionCount($conn, $storyID, 'like');
    $heartCount = getReactionCount($conn, $storyID, 'heart');

    $response = array(
        'success' => true,
        'storyID' => $storyID,
        'likeCount' => $likeCount,
        'heartCount' => $heartCount
    );

    echo json_encode($response);
}

function getReactionCount($conn, $storyID, $reactionType)
{
    $sql = "SELECT COUNT(*) AS count FROM reactions WHERE story_id = '{$storyID}' AND reaction = '{$reactionType}'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['count'];
    }

    return 0;
}

$conn->close();
?>