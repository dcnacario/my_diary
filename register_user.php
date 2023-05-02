<?php 
    require('local_setting.php');
    $username = $_POST['user'];
    $password = $_POST['user_pass'];
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $date = date("Y-m-d");

    $registerQuery = "INSERT INTO user VALUES ('','{$username}','{$password}','{$fName}','{$lName}','{$date}')";
    $resultQuery = mysqli_query($conn,$registerQuery);

    $lastInsertUser = mysqli_insert_id($conn);

    header("Location: main.php?userID=". $lastInsertUser);
?>