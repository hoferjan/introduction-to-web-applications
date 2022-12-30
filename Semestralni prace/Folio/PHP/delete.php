<?php
session_start();

// Check if the "id" parameter is set in the query string
if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    
    // Read the contents of the "positions.json" file into a string
    $storage = file_get_contents('../JSON/positions.json');
    
    // Convert the JSON string into a PHP array
    $positions = json_decode($storage, true);
    
    // Find the position with the matching id
    foreach ($positions as $index => $position) {
        if ($position['position_id'] == $id && $position['uid'] == $_SESSION['uid']) {
            // Remove the position from the array
            unset($positions[$index]);
            break;
        }
    }
    
    // Encode the array back into a JSON string
    $storage = json_encode($positions);
    
    // Write the JSON string back to the "positions.json" file
    file_put_contents('../JSON/positions.json', $storage);
    
    // Redirect the user back to his positions
    header('Location: ../mypositions.php');
    exit;
} else {
    // If the "id" parameter is not set, display an error message
    echo "Error: No position id specified.";
}

?>
