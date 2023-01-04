<?php
    //loads the positions from the json file
    function loadPositions(){
        $positions = json_decode(file_get_contents("JSON/positions.json"), true);
        }
    
?>