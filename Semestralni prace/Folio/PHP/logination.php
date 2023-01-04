<?php
    class LoginUser{
   private $email;
   private $password;
   public $error;
   public $success;
   private $storage = "JSON/users.json";
   private $stored_users; //array of users

   // Constructor to initialize the class, and transform inputs against XSS
   public function __construct($email, $password){
    $this->email = htmlspecialchars(trim($email));
    $this->password = htmlspecialchars(trim($password));
    $this->stored_users = json_decode(file_get_contents($this->storage), true);
    $this->login();
 }
    // Function to check if the user exists and if the password is correct
    public function login(){
        foreach ($this->stored_users as $user) {
        if($user['email'] == $this->email){
            if(password_verify($this->password, $user['password'])){
                $this->success = "You are loged in";
                return true;
            }
        }
        }
        $this->error = "Wrong email or password";
        return false;  
 }
    // Function to check if the user exists and if the password is correct
    public function loginSession(){
        foreach ($this->stored_users as $user) {
        if($user['email'] == $this->email){
            if(password_verify($this->password, $user['password'])){
            //logs in user via session start
            $_SESSION['uid'] = $user['uid'];
                $this->success = "You are loged in";
                return true;
            }
        }
        }
        $this->error = "Wrong email or password";
        return false;  
} 
    }
    //function that returns the user by uid
    function getUserByUid($uid){
        $users = json_decode(file_get_contents("JSON/users.json"), true);
        foreach($users as $user){
            if($user["uid"] == $uid){
                return $user;
            }
        }
        return false;
    }
?>