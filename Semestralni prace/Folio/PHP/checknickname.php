<?php
  // Read the contents of the users.json file into a string
  $json = file_get_contents('../JSON/users.json');
  
  // Decode the JSON string into an array
  $users = json_decode($json, true);
  
  // Get the nickname from the POST data
  $nickname = $_POST['nickname'];
  
  //create a new array to store the nicknames
  $nicknames = array();
  foreach ($users as $user) {
    // push the username of the user to the array
    array_push($nicknames, $user['username']); 
  }
  
  // Check if the nickname exists in the array
  if (in_array($nickname, $nicknames)) {
    // If the nickname exists, return "exists"
    echo "exists";
  } else {
    // If the nickname does not exist, return "does not exist"
    echo "does not exist";
  }
?>
