<?php
    //defines css variables
    $css = 'CSS/style.css';
    $css2 = 'CSS/style2.css';
    
    //checks if namebutton is clicked
    $themeIsChanged = isset($_POST["namebutton"]);

    //function that chnges the style sheet

    if ($themeIsChanged) {
        if ($_SESSION["css"] == $css) {
            $_SESSION["css"] = $css2;
        } else {
            $_SESSION["css"] = $css;
        }
    }

?>