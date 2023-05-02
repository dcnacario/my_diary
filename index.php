<?php 
    require('local_setting.php');
    if(isset($_GET['authentication'])){
        $authStatus = $_GET['authentication'];
    }
    else{
        $authStatus = '';
    } 
?>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
        <link rel="stylesheet" href="style.css"> 
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js" rel="text/javascript"></script>
    </head>
    <body>
        <div class="headercontainer">
            <h1 class="style2">my.</h1>
            <h1 class="style3">diary</h1>
        </div>
        <h1 class="style">login</h1>
        <div class="container">
            <p id="response"></p>
            <div class="inputbox">
            <i class='bx bx-user-circle'></i>
            <input type="text" name="user" id="user" class="input" placeholder="Username">
            </div>
            <div class="inputbox">
            <i class='bx bx-lock'></i>
            <input type="password" name="user_pass" id="user_pass" class="input" placeholder="Password">
            </div>
            <br><br>
            <button type="button" class="btn" onclick="authenticateUser()">Login</button>
            <br><br>
            <a href="register.html">Create an account</a>
        </div>
        <img src="diary.webp">
    </body>
    <script>

    function authenticateUser() {
    var dataForm = new FormData();

    var userUsername = document.getElementById("user").value;
    var userPassword = $("#user_pass").val();

    dataForm.append('username', userUsername);
    dataForm.append('password', userPassword);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "authentication.php");
    xhr.onload = function(){
        //response
        location.href = "main.php?userID="+JSON.parse(this.response);
    }
    xhr.send(dataForm);
    }
    </script>
</html>