<?php
// Get the selected type from the request body
function filterPositionsByType($type, $filteredPositions) {
    $refilteredPositions = [];
    if ($type == "all") {
        return $filteredPositions;
    }
    foreach ($filteredPositions as $position) {
        if ($position['type_select'] == $type) {
            array_push($refilteredPositions, $position);
        }
    }
    return $refilteredPositions;
}

