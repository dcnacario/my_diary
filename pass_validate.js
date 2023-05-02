function verifyPassword() {
    var pw = document.getElementById("user_pass").value;
    var pw_con = document.getElementById("user_pass_con").value;

    if(pw == ""){
        alert("Please fill the password!");
    }
    else{
        if(pw == pw_con){
            document.getElementById("message").innerHTML = "Password matched!";
            document.getElementById("btn").disabled = false;
            document.getElementById("message").style = "rgba(226,225,241)";
        }
        else {
            document.getElementById("message").innerHTML = "Password does not matched!";
            document.getElementById("message").style = "color: rgba(202,90,90)";
            document.getElementById("btn").disabled = true;
        }
    }
}