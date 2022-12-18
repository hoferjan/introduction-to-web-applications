<?php
//LOGIN
    //email validation
    function validateEmail($email) {
        return strpos($email, '@') &&  strlen($email) >= 8 && strpos($email, '.') ? true : false;
    }

    //password validation
    function validatePassword($password) {
        return strlen($password) >= 8;
    }

    // name validation
    function validateName($name) {
        return strlen($name) >= 3;
    }
?>