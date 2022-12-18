    const formElement = document.querySelector("form"); // saves first <form> element to variable
    formElement.addEventListener("submit", validateall); // everytime a form is submitted, validateall() is called

    //selected by queryselector variables and invalid element messages
    var email = document.querySelector("#email");
    var nickname = document.querySelector("#nickname");
    var password = document.querySelector("#password");
    var repeat_password = document.querySelector("#repeat_password");
    var favorite_type_select = document.querySelector("#favorite_type_select");
    var invalid_length_password = document.querySelector("#invalid_length_password");
    var invalid_match_password = document.querySelector("#invalid_match_password");
    var invalid_taken_nickname = document.querySelector("#invalid_taken_nickname"); //invalid taken nickname add later
    var invalid_length_nickname = document.querySelector("#invalid_length_nickname");
    var invalid_email = document.querySelector("#invalid_email");
    var invalid_select = document.querySelector("#invalid_select");
    var invalid_required = document.querySelector("#invalid_required");

    
    
    //keyup event listeners
    email.addEventListener("keyup", timeremail);
    nickname.addEventListener("keyup", timernickname);
    password.addEventListener("keyup", timerpassword);
    repeat_password.addEventListener("keyup", timerpassword);
    // favorite_type_select.addEventListener("change", timerfavorite_type_select); //not required field

    


    


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

    function timernickname(e){
        if (timer != null) {
            clearTimeout(timer);
            timer = null;
        }
        timer = setTimeout(function() {validatenickname(e)}, 300);
    }

    // function timerfavorite_type_select(e){ //favorite select not required
    //     if (timer != null) {
    //         clearTimeout(timer);
    //         timer = null;
    //     }
    //     timer = setTimeout(function() {validatefavorite_type_select(e)}, 300);
    // }

    //functions that validate each input after timer is done
    function validatepassword(e){
        if (password.value.length != 0){
            if (password.value.length < 8) 
            {
                invalid_length_password.style.display = "block";
            }
            else{
                invalid_length_password.style.display = "none";
                
            }
            if (repeat_password.value.length < 8) 
            {
                invalid_length_password.style.display = "block";
            }
            else{
                invalid_length_password.style.display = "none";
                
            }
            if (password.value != repeat_password.value) 
            {
                invalid_match_password.style.display = "block";
            }
            else{
                invalid_match_password.style.display = "none";
                
            }
        }
        else{
            invalid_length_password.style.display = "none";
            invalid_match_password.style.display = "none";
            
        }
        checkrequired();
    }

    function validatenickname(e){ //later add nickname check if already taken
        if (nickname.value.length != 0){
            if (nickname.value.length < 5)
            {
                invalid_length_nickname.style.display = "block";

            }
            else{
                invalid_length_nickname.style.display = "none";
                
            }
        }
        else{
            invalid_length_nickname.style.display = "none";
            
        }
        checkrequired();
    }

    function validateemail(e){
        if (email.value.length != 0){
            if (email.value.includes("@") == false || email.value.includes(".") == false || email.value.length < 8)
            {
                invalid_email.style.display = "block";
            }
            else{
                invalid_email.style.display = "none";
            }
        }
        checkrequired();
    }

    function checkrequired() {
    console.log("checkrequired")
    if (email.value.length != 0 && nickname.value.length != 0 && password.value.length != 0 && repeat_password.value.length != 0)
    {
        invalid_required.style.display = "none";
    } else {
        invalid_required.style.display = "block";
    }
    }

    //final function that checks if all inputs are valid whne submit button is pressed
    function validateall(e){
        e.preventDefault();
        if (invalid_length_password.style.display == "block" || invalid_match_password.style.display == "block" || invalid_length_nickname.style.display == "block" || invalid_email.style.display == "block" || password.value.length == 0 || nickname.value.length == 0 || email.value.length == 0)
        {
            invalid_form.style.display = "block";
        }
        else {
            alert("Form submitted"); //later add what it does when correct form is submitted
        }
    }

