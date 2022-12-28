<?php
    function loadPositions(){
        $positions = json_decode(file_get_contents("JSON/positions.json"), true);
        }
    
?>