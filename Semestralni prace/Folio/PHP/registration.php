<?php
// class user, for creation of new user
class RegisterUser{
    private $email;
    private $raw_password;
    private $raw_password_repeat;
    private $encrypted_password;
    public $error;
    public $success;
    private $username;
    private $favoriteType;
    private $storage = "JSON/users.json";
    private $stored_users;
    private $new_user;


    //creates new user contructor
    public function __construct($username, $raw_password, $raw_password_repeat, $email, $favoriteType){
        $this -> favoriteType = $favoriteType;
        $this->email =htmlspecialchars(trim($email));
        $this->username = htmlspecialchars(trim($username));
        $this->raw_password = htmlspecialchars(trim($raw_password));
        $this->raw_password_repeat = htmlspecialchars(trim($raw_password_repeat));
        $this->encrypted_password = password_hash($this->raw_password, PASSWORD_DEFAULT);
        $this->stored_users = json_decode(file_get_contents($this->storage), true);
        $this->new_user = [
            "username" => $this->username,
            "password" => $this->encrypted_password,
            "email" => $this->email,
            "favoriteType" => $this->favoriteType,
            "uid" => uniqid()
            ];
        if($this->checkFieldValues()){
            $this->insertUser();
        }
    }

    //Login and registration validation
    //email validation
    function validateEmail() {
        if (strpos($this->email, '@') &&  strlen($this->email) >= 8 && strpos($this->email, '.') ? true : false){
            return true;
        }else{
            $this->error = "Please enter a valid email";
            return false;
    }
        }
    
    //password validation
    function validatePassword() {
        if(strlen($this->raw_password) >= 8){
            return true;
        }else{
            $this->error = "Password must be at least 8 characters long";
            return false;
        }
    }

    //nickname validation
    function validateNickname() {
        if (strlen($this->username) >= 5 && strlen($this->username) <= 20){
            return true;
        }else{
            $this->error = "Nickname must be at least 5 characters long and not longer than 20 characters";
            return false;
        }
    }

    //repeated password validation
    function validateRepeatPassword() {
        if ($this-> raw_password == $this->raw_password_repeat){
            return true;
        }else{
            $this->error = "Passwords do not match";
            return false;
        }
    }

    private function checkFieldValues(){
        if($this->validateEmail() == false || $this->validatePassword() == false || $this->validateNickname() == false || $this->validateRepeatPassword() == false){
            return false;
        }else{
            return true;
        }
        }

    //checks if username already exists
    function usernameExists($username){
        $users = json_decode(file_get_contents("JSON/users.json"), true);
        foreach($this->stored_users as $user){
            if($user["username"] == $this->username){
                $this -> error = "Nickname already exists";
                return true;
            }
        }
        return false;
    }

    //checks if email already exists
    function emailExists($email){
        $users = json_decode(file_get_contents("JSON/users.json"), true);
        foreach($this->stored_users as $user){
            if($user["email"] == $this->email){
                $this -> error = "Email already exists";
                return true;
            }
        }
        return false;
    }

    //inserts new user into json file
    public function insertUser(){
        if (($this ->usernameExists($this -> username) == FALSE) && ($this ->emailExists($this -> email) == FALSE)){
        array_unshift($this->stored_users, $this->new_user);
            if(file_put_contents($this->storage, json_encode($this->stored_users))){
                $this->success = "Your registration was successful";
                $_SESSION['uid'] = $this -> new_user['uid'];
                header('Location: mypositions.php');
                return true;
        }else{
            $this->error = "Something went wrong";
            return false;
        }
        } else {
            return false;
        }
    }
}
?>
