//queryselector variables and invalid element messages
const formElement = document.querySelector("form");
formElement.addEventListener("submit", validateall);

// query selector
var email = document.querySelector("#email");
var password = document.querySelector("#password");
var invalid_email = document.querySelector("#invalid_email");
var invalid_password = document.querySelector("#invalid_password");

//call timers
email.addEventListener("keyup", timeremail);
password.addEventListener("keyup", timerpassword);

//functions that run timer for each input
var timer = null;
function timeremail(e){
    if (timer != null) {
        clearTimeout(timer);
        timer = null;
    };
    timer = setTimeout(function() {validateemail(e)}, 300);
}   
function timerpassword(e){
    if (timer != null) {
        clearTimeout(timer);
        timer = null;
    }
    timer = setTimeout(function() {validatepassword(e)}, 300);
}
function validateall(e){
    validateemail(e);
    validatepassword(e);
    if (invalid_email.innerHTML != "" || invalid_password.innerHTML != ""){
        e.preventDefault();
    }
}

//validation for inputs
function validateemail(e){
    if (email.value.length != 0){
        if (email.value.includes("@") == false)
        {
            invalid_email.style.display = "block";
        }
        else{
            invalid_email.style.display = "none";
            
        }
        if (email.value.includes(".") == false)
        {
            invalid_email.style.display = "block";
        }
        else{
            invalid_email.style.display = "none";
            ;
        }
        if (email.value.length < 10)
        {
            invalid_email.style.display = "block";
            
        }
        else{
            invalid_email.style.display = "none";
        }
    }
    else{
        invalid_email.style.display = "none";
    }
}

function validatepassword(e){
    if (password.value.length < 8){
        invalid_password.style.display = "block";
    }
    else{
        invalid_password.style.display = "none";
    }
}
