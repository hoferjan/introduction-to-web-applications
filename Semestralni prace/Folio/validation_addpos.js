//queryselector variables and invalid element messages
const formElement = document.querySelector("form:nth-of-type(2)");
formElement.addEventListener("submit", validateall);

// query selector
var namee = document.querySelector("#name");
var ticker = document.querySelector("#ticker");
var long_short_select = document.querySelector("#long_short_select");
var date = document.querySelector("#date");
var currency_select = document.querySelector("#currency_select");
var amount = document.querySelector("#amount");
var open_price = document.querySelector("#open_price");
var close_price = document.querySelector("#close_price");
var private_public_select = document.querySelector("#private_public_select");

//invalid query selector
var invalid_name = document.querySelector("#invalid_name");
var invalid_ticker = document.querySelector("#invalid_ticker");
var invalid_amount = document.querySelector("#invalid_amount");
var invalid_open_price = document.querySelector("#invalid_open_price");
var invalid_close_price = document.querySelector("#invalid_close_price");
var invalid_required = document.querySelector("#invalid_required");

// adding event listeners
namee.addEventListener("keyup", timername);
ticker.addEventListener("keyup", timerticker);
// long_short_select.addEventListener("change", timerlong_short_select);
// date.addEventListener("change", timerdate);
// currency_select.addEventListener("change", timercurrency_select);
amount.addEventListener("keyup", timeramount);
open_price.addEventListener("keyup", timeropen_price);
close_price.addEventListener("keyup", timerclose_price);
// private_public_select.addEventListener("change", timerprivate_public_select);

// functions that run timer for each input
var timer = null;
function timername(e){ 
    if (timer != null) {
        clearTimeout(timer);
        timer = null;
    };
    timer = setTimeout(function() {validatename(e)}, 300);
}

function timerticker(e){
    if (timer != null) {
        clearTimeout(timer);
        timer = null;
    }
    timer = setTimeout(function() {validateticker(e)}, 300);
}

function timeramount(e){
    if (timer != null) {
        clearTimeout(timer);
        timer = null;
    }
    timer = setTimeout(function() {validateamount(e)}, 300);
}

function timeropen_price(e){
    if (timer != null) {
        clearTimeout(timer);
        timer = null;
    }
    timer = setTimeout(function() {validate_open_price(e)}, 300);
}

function timerclose_price(e){
    if (timer != null) {
        clearTimeout(timer);
        timer = null;
    }
    timer = setTimeout(function() {validate_close_price(e)}, 300);
}

//validation functions
function validatename(e){
    if (namee.value.length != 0) {
        if (namee.value.length < 3 || namee.value.length > 15) {
            invalid_name.style.display = "block";
        } else {
            invalid_name.style.display = "none";
        }
    } else {
        invalid_name.style.display = "none";
    }
    checkrequired();
}

function validateticker(e){ 
    if (ticker.value.length != 0) {
        if (ticker.value.length < 2 || ticker.value.length > 10) {
            invalid_ticker.style.display = "block";
        } else {
            invalid_ticker.style.display = "none";
        }
        if (ticker.value != ticker.value.toUpperCase()) { //ticker must be uppercase
            ticker.value = ticker.value.toUpperCase();
        }
    } else {
        invalid_ticker.style.display = "none";
    }
    checkrequired();
}

function validateamount(e){
    if (amount.value.length != 0) {
        console.log(amount.value)
        if (amount.value < 1) {
            invalid_amount.style.display = "block";
        } else {
            invalid_amount.style.display = "none";
        }
    } else {
        invalid_amount.style.display = "none";
    }
    checkrequired();
}
//not necessery because user can just open position and not close it
// function validate_close_price(e){
//     if (close_price.value.length != 0) {
//         if (close_price.value < 1) {
//             invalid_close_price.style.display = "block";
//         } else {
//             invalid_close_price.style.display = "none";
//         }
//     } else {
//         invalid_close_price.style.display = "none";
//     }
//     checkrequired();
// }

function validate_open_price(e){
    if (open_price.value.length != 0) {
        if (open_price.value < 1) {
            invalid_open_price.style.display = "block";
        } else {
            invalid_open_price.style.display = "none";
        }
    } else {
        invalid_open_price.style.display = "none";
    }
    checkrequired();
}

//check if all fields have amount
function checkrequired(){
    if (namee.value.length == 0 || ticker.value.length == 0 || long_short_select.value.length == 0 || date.value.length == 0 || currency_select.value.length == 0 || amount.value.length == 0 || open_price.value.length == 0 || close_price.value.length == 0 || private_public_select.value.length == 0) {
        invalid_required.style.display = "block";
    } else {
        invalid_required.style.display = "none";
    }
}

//validate before submitting
function validateall(e){
    if (ticker.value.length == 0 || long_short_select.value.length == 0 || date.value.length == 0 || currency_select.value.length == 0 || amount.value.length == 0 || open_price.value.length == 0 || close_price.value.length == 0 || private_public_select.value.length == 0 || invalid_name.style.display == "block" || invalid_ticker.style.display == "block" || invalid_amount.style.display == "block" || invalid_open_price.style.display == "block" || invalid_close_price.style.display == "block") {
        invalid_required.style.display = "block";
        e.preventDefault();
    } else {
        alert("Form submitted")
    }
}