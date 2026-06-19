function login(){

    const username = "skydyadmin";
    const password = "skydycoworkingspace";

    var x = document.getElementById("username").value;
    var y = document.getElementById("password").value;
    
    
    if (x == username && y == password){
        window.open("../Admin/index.php", "_self")
    } else {
        alert("incorrect username or password")
    }
}