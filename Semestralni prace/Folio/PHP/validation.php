<?php
//Login and registration validation
    //email validation
    function validateEmail($email) {
        return strpos($email, '@') &&  strlen($email) >= 8 && strpos($email, '.') ? true : false;
    }

    //password validation
    function validatePassword($password) {
        return strlen($password) >= 8;
    }

    //nickname validation
    function validateNickname($nickname) {
        return strlen($nickname) >= 5;
    }

    //repeated password validation
    function validateRepeatPassword($password, $password2) {
        return $password == $password2;
    }

    //favorite type validation not required, ready if needed
    // function validateFavoriteType($favoriteType) {
    //     return $favoriteType != '0' && $favoriteType != '---------' && $favoriteType != '' && $favoriteType != 'not_selected';
    // }
?>