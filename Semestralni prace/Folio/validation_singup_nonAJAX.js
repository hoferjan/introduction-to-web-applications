function init()
{
    const formElement = document.querySelector("form"); // saves first <form> element to variable
    formElement.addEventListener("submit", validate); // everytime a form is submitted, validate() is called
}

function validate(event)
{
    // gets one input to its own variable
    var email = document.querySelector("#email");
    var nickname = document.querySelector("#nickname");
    var password = document.querySelector("#password");
    var repeat_password = document.querySelector("#repeat_password");
    var favorite_type_select = document.querySelector("#favorite_type_select");


    

    // here go error messages
    var errors = [];
    
    //email
    if (email.value.length < 6) 
    {
        errors.push("Please enter valid email address."); // adds text that shows later as error
    }

    if (String(email.value).indexOf("@") == -1){
        errors.push("Please enter valid email address.");
    }

    if (String(email.value).indexOf(".") == -1){
        errors.push("Please enter valid email address." );
    }


    //nickname + check if nickname is already taken
    if (nickname.value.length < 5) // check condition
    {
        errors.push("Nickname must be at least 6 characters long."); 
    }
    
   //check if name is already taken
    if (nickname.value == "test"){
        errors.push("Nickname is already taken.");
    }

    //password
    if (password.value.length < 8) 
    {
        errors.push("Password must be at least 8 characters long.");
        invalid_lenght_password.style.display = "block";
    }
    
    if (password.value != repeat_password.value) 
    {
        errors.push("Passwords do not match.");
        invalid_match_password.style.display = "block";
    }

    if (favorite_type_select.value == "none") 
    {
        errors.push("Please select your favorite type.");
    }

    // doesnt send the form until all errors are fixed
    if (errors.length !== 0)
    {
        event.preventDefault(); 
        errors.forEach(function (error) {

        });
    }

}
