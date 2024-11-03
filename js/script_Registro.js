const mens = document.getElementById("formulario_error");
const input = document.querySelector("#pass1");

var password = document.getElementById('pass');
var password1 = document.getElementById('pass1');

function logKey(e) {
    var pass = ` ${password.value}`;
    var pass1 = ` ${password1.value}`;

    if(pass == pass1){
        document.getElementById('formulario_error').style.display ="none";
    }else{
        document.getElementById('formulario_error').style.display ="block";
    }
}


if (input) {
    input.addEventListener("keyup", logKey);  
}

