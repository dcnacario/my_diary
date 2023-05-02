<?php 
    require("local_setting.php");

    $currentUserPk = $_REQUEST['userID'];
    $currentUserPk = (int)$currentUserPk;
    $userDetails = array();

    $fetchQuery = "SELECT * 
        FROM user WHERE user_id = {$currentUserPk}";

    $result = mysqli_query($conn, $fetchQuery);

if (mysqli_num_rows($result) > 0) {
    while($userResult = mysqli_fetch_array($result)) {
       $userDetails['user_id'] = $userResult['user_id'];
       $userDetails['username'] = $userResult['username'];
       $userDetails['password'] = $userResult['password'];
       $userDetails['first_name'] = $userResult['first_name'];
       $userDetails['last_name'] = $userResult['last_name'];
    }
}

    
?>