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

// Added position validation
        function validateName($name) {
            return strlen($name) >= 3;
        }

        function validateTicker($ticker) {
            return strlen($ticker) >= 2;
        }

        function validateLongShort($longShort) {
            return $longShort != '0' && $longShort != '---------' && $longShort != '' && $longShort != 'not_selected';
        }

        function validateDate($date) {
            return strlen($date) > 0;
        }

        function validateCurrency($currency) {
            return $currency != '0' && $currency != '---------' && $currency != '' && $currency != 'not_selected';
        }

        function validateAmount($amount) {
            return strlen($amount) > 0;
        }

        function validatePrice($price) {
            return strlen($price) > 0;
        }

        function validatePrivatePublic($privatePublic) {
            return $privatePublic != '0' && $privatePublic != '---------' && $privatePublic != '' && $privatePublic != 'not_selected';
        }
        
        function validateType($type) {
            return $type != '0' && $type != '---------' && $type != '' && $type != 'not_selected';
        }
?>