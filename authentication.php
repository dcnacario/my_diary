<?php

require('local_setting.php');

$userUsername = $_POST['username'];
$userPassword = $_POST['password'];

$fetchQuery = "SELECT * FROM user ";

$result = mysqli_query($conn, $fetchQuery);
if (mysqli_num_rows($result) > 0) {
    while($userResult = mysqli_fetch_array($result)) {
        if($userUsername == $userResult['username'] && $userPassword == $userResult['password']) {
            // 0 = User Exists
            $currentDate = date("Y-m-d");
            $sqlQuery = "UPDATE user SET last_logindate = '{$currentDate}' 
            WHERE user_id = '{$userResult['user_id']}'";
            $queryResult = mysqli_query($conn,$sqlQuery);
            echo json_encode($userResult['user_id']);
        }
    }
}
?>