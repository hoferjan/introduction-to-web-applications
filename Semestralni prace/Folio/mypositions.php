<?php 
session_start();
require "PHP/logination.php";
require "PHP/themeswitcher.php";
require "PHP/addposition.php";
require "PHP/filterpositions.php";
require "PHP/sortpositions.php";

$uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : NULL;

//sends to homepage if not logged in
if ($uid) {
    $user = getUserByUid($uid);
} else {
    header('Location: homepage.php');
}

//CSRF token protection
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Validate the CSRF token
  if ($_POST['csrf_token'] != $_SESSION['csrf_token']) {
      die('Invalid CSRF token');
  }
}

$formIsSent = isset($_POST["add"]);
$name = '';
$ticker = '';
$longShort = '';
$date = '';
$currency = '';
$amount = '';
$openPrice = '';
$closePrice = '';
$privatePublic = '';
$type_select = '';

if ($formIsSent){
  $name = $_POST["name"];
  $ticker = $_POST["ticker"];
  $longShort = $_POST["long_short"];
  $date = $_POST["date"];
  $currency = $_POST["currency"];
  $amount = $_POST["amount"];
  $openPrice = $_POST["open_price"];
  $closePrice = $_POST["close_price"];
  $privatePublic = $_POST["private_public"];
  $type_select = $_POST["type_select"];

  $newPosition = new AddPosition($name, $ticker, $longShort, $privatePublic, $date, $currency, $amount, $openPrice, $closePrice, $type_select);
}

// Load the positions from the JSON file
$positions = json_decode(file_get_contents('JSON/positions.json'), true);


//get only the positions which are not set to private or the user is the owner
$filteredPositions = [];
foreach ($positions as $position) {
  if ($position['uid'] == $_SESSION['uid']) {
      //push position to filteredPositions
      array_push($filteredPositions, $position);
    }
}

// Set the default page number
$page = 1;

// Check if the page form has been submitted
if (isset($_POST['page'])) {
  // Set the page number from the form submission
  $page = (int) $_POST['page'];
}


// in case form not submitted, type set to all
$type = "all";  

// Check if the type form has been submitted
if (isset($_POST['type'])) {
  // Get the type selected by the user
  $type = $_POST['type'];

  // Filter the positions by type
  $refilteredPositions = [];
  $refilteredPositions = filterPositionsByType($type, $filteredPositions);
}

// if user did not filter positions, set the filtered positions to the prefiltered positions
if (!isset($refilteredPositions)) {
  $refilteredPositions = $filteredPositions;
}

// Check if the sort form has been submitted
if (isset($_POST['sort'])) {
  // Get the sort selected by the user
  $sort = $_POST['sort'];

  // Sort the positions by the selected sort
  $refilteredPositions = sortPositions($refilteredPositions, $sort);
}

// Retrieve the additional positions from the array
$additionalPositions = array_slice($refilteredPositions, (($page -1)* 20), 20);

//calculate the total number of positions
$totalPositions = count($refilteredPositions);
?>
<!DOCTYPE html> 
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Positions</title>
        <script src="JS/validation_addpos.js" defer></script>
        <script src="JS/theme_switcher.js" defer></script>
        <link rel="stylesheet" href="<?= $_SESSION["css"] ?>"> 
        <link rel="stylesheet" href="CSS/print.css" media="print">
        <link rel="apple-touch-icon" sizes="180x180" href="pics/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="pics/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="pics/favicon-16x16.png">
        <link rel="manifest" href="pics/site.webmanifest">
    </head>
    <body>
        <header class="group">
            <a href="homepage.php">
                <img
                alt="folio_logo"
                src="pics/folio-logo_blue-removebgx250.png"
                />
            </a>
          <div id="navbar">
              <a href="mypositions.php">My positions</a>
              <a href="allpositions.php">All positions</a>
              <a href="PHP/logout.php">Logout</a>
          </div>
        </header>
        <div id="content"> 
          <!-- filtering form -->
        <form method="post" action="">
          <label for="type">Filter by type:</label>
          <select name="type" id="type" onchange="this.form.submit()">
          <?php if (isset($type)) { ?>
            <option value="<?= $type ?>"><?= $type ?></option>
          <?php } ?>
            <option value="all">All</option>
            <option value="stocks">Stocks</option>
            <option value="bonds">Bonds</option>
            <option value="mutual_funds">Mutual Funds</option>
            <option value="real_estate">Real Estate</option>
            <option value="cryptocurrencies">Cryptocurrencies</option>
            <option value="commodities">Commodities</option>
            <option value="other">Other</option>
          </select>
          <?php if (isset($sort)) { ?>
            <input type="hidden" name="sort" id="sort" value="<?= $sort ?>">
          <?php } ?>
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        </form>
        <!-- sorting form -->
        <form method="post" action="">
          <label for="sort">Sort by:</label>
          <select name="sort" id="sort" onchange="this.form.submit()">
          <?php if (isset($sort)) { ?>
            <option value="<?= $sort ?>"><?= $sort ?></option>
          <?php } ?>
            <option value="not_sorted">Not sorted</option>
            <option value="highest_profit">Highest profit</option>
            <option value="highest_price">Highest opening price</option>
            <option value="lowest_price">Lowest opening price</option>
            <option value="newest">Newest</option>
            <option value="oldest">Oldest</option>
          </select>
          <?php if (isset($type)) { ?>
            <input type="hidden" name="type" id="type" value="<?= $type ?>">
          <?php } ?>
          <?php if (!isset($type)) {
            $type = "all"; ?>
            <input type="hidden" name="type" id="type" value="<?= $type ?>">
          <?php } ?>
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        </form>
            <table>
                <tbody><tr class="thead">
                    <th class="name_head">Name</th>
                    <th class="ticker_head">Ticker</th>
                    <th class="long_short_head">Long/Short</th>
                    <th class="date_head">Date</th>
                    <th class="currency_head">Currency</th>
                    <th class="amount_head">Amount</th>
                    <th class="opening_price_head">Opening price</th>
                    <th class="closing_price_head">Closing price</th>
                    <th class="type_head">Type</th>
                    <th class="delete_head">Delete</th>
                </tr>
          <?php
          //displays the table with the positions
          foreach ($additionalPositions as $position) {
            // check if the position's user ID matches the session user ID
            echo "<tr class='tcontent'>";
            echo "<td class='name'>" . $position['name'] . "</td>";
            echo "<td class='ticker'>" . $position['ticker'] . "</td>";
            echo "<td class='long_short'>" . $position['longShort'] . "</td>";
            echo "<td class='date'>" . $position['date'] . "</td>";
            echo "<td class='currency'>" . $position['currency'] . "</td>";
            echo "<td class='amount'>" . $position['amount'] . "</td>";
            echo "<td class='opening_price'>" . $position['opening_price'] . "</td>";
            echo "<td class='closing_price'>" . $position['closing_price'] . " (" . $position['profit'] . "%)</td>";
            echo "<td class='type'>" . $position['type_select'] . "</td>";
            echo "<td class='delete'><a href='PHP/delete.php?id=" . $position['position_id'] . "'class='delete'>X</a></td>";
            echo "</tr>";
          }
          ?>
            </tbody></table>
            </div>
      <div id="pagination">
        <form method="post" action="">
          <?php if ($page != 1) { ?>
          <button type="submit" name="load-prev-btn" value="1">Load Previous</button>
          <?php } ?>
          <!-- Add a hidden input field to store the current page number -->
          <input type="hidden" name="page" id="page" value="<?= $page - 1 ?>">
          <?php if (isset($type)) { ?>
          <input type="hidden" name="type" id="type" value="<?= $type ?>">
          <?php } ?>
          <?php if (isset($sort)) { ?>
          <input type="hidden" name="sort" id="sort" value="<?= $sort ?>">
          <?php } ?>
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        </form>
        <form action="" method="POST">
          <!-- Display the "load more" button only if there are additional positions to load -->
          <?php if ($page * 20 < count($refilteredPositions)) { ?>
          <button type="submit" id="load-more-btn">Load Next</button>
          <?php } ?>
          <!-- Add a hidden input field to store the current page number -->
          <input type="hidden" name="page" id="page" value="<?= $page + 1 ?>">
          <?php if (isset($type)) { ?>
          <input type="hidden" name="type" id="type" value="<?= $type ?>">
          <?php } ?>
          <?php if (isset($sort)) { ?>
          <input type="hidden" name="sort" id="sort" value="<?= $sort ?>">
          <?php } ?>
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        </form>  
      </div>
      <div id="progress">
        <p>Displaying positions <?= ($page - 1) * 20 + 1 ?>-<?= $page * 20 ?> out of <?= $totalPositions ?></p>
      </div>
            <form action="" method="POST">
                <h2>Add position</h2>
                <fieldset>
                    <legend></legend>

                    <label for="name">Name: </label>
                    <input type="text" id="name" name="name" placeholder="Enter Name" required pattern=".{3,15}" value="<?= htmlspecialchars($name); ?>">
                    <div class= "invalid" id="invalid_name">
                      Please enter a valid name, lenght between 3 and 15 characters
                    </div>

                    <label for="ticker">Ticker: </label>
                    <input type="text" id="ticker" name="ticker" placeholder="Enter Ticker" required pattern=".{2,10}" value="<?= htmlspecialchars($ticker); ?>">

                    <div class= "invalid" id="invalid_ticker">
                      Please enter a valid ticker, lenght between 2 and 10 characters
                    </div>

                    <label for="long_short_select">Long/Short: </label>
                    <select name="long_short" id="long_short">
                    <?php if (isset($longShort) && $longShort != '') { ?>
                        <option value="<?= $longShort ?>"><?= $longShort ?></option>
                    <?php } ?>
                        <option value="not_selected"></option>
                        <option value="long">long</option>
                        <option value="short">short</option>
                    </select>
                    <?php
                    if (isset($longShortIsValid) && $longShortIsValid == false)  {
                      echo '<br><span class="invalid-php">Invalid Entry</span><br>';
                      }
                    ?>
                    <label for="date">Date: </label>
                    <input type="date" id="date" name="date" required value="<?= htmlspecialchars($date); ?>">

                    <label for="currency_select">Currency: </label>
                    <select name="currency" id="currency_select" required>
                    <?php if (isset($currency) && $currency != '') { ?>
                        <option value="<?= $currency ?>"><?= $currency ?></option>
                    <?php } ?>
                      <option value="not_selected"></option>
                      <option value="USD">USD</option>
                      <option value="EUR">EUR</option>
                      <option value="GBP">GBP</option>
                      <option value="CZK">CZK</option>
                    </select>

                    <label for="amount">Amount: </label>
                    <input type="number" id="amount" name="amount" placeholder="Enter Amount" required pattern="[0-9]+" value="<?= htmlspecialchars($amount); ?>">
                    <div class= "invalid" id="invalid_amount">
                      Please enter a valid amount
                    </div>

                    <label for="open_price">Opening price: </label>
                    <input type="number" id="open_price" name="open_price" placeholder="Enter open price" required pattern="[0-9]+" value="<?= htmlspecialchars($openPrice); ?>">
                    <div class= "invalid" id="invalid_open_price">
                      Please enter a valid price
                    </div>

                    <label for="close_price">Closing price: </label>
                    <input type="number" id="close_price" name="close_price" placeholder="Enter close price" pattern="[0-9]+"value="<?= htmlspecialchars($closePrice); ?>">
                    <div class= "invalid" id="invalid_close_price">
                      Please enter a valid price
                    </div>

                    <label for="private_public_select">Private/Public: </label>
                    <select name="private_public" id="private_public_select">
                        <?php if (isset($privatePublic) && $privatePublic != '') { ?>
                            <option value="<?= $privatePublic ?>"><?= $privatePublic ?></option>
                        <?php } ?>
                        <option value="private"></option>
                        <option value="private">private</option>
                        <option value="public">public</option>
                        <option value="anonymous">anonymous</option>
                    </select>
                    
                  <label for="type_select">Type: </label>
                  <select name="type_select" id="type_select">
                    <?php if (isset($type_select) && $type_select != '') { ?>
                        <option value="<?= $type_select ?>"><?= $type_select ?></option>
                    <?php } ?>
                    <option value="not_selected"></option>
                    <option value="stocks">Stocks</option>
                    <option value="bonds">Bonds</option>
                    <option value="mutual_funds">Mutual Funds</option>
                    <option value="real_estate">Real Estate</option>
                    <option value="cryptocurrencies">Cryptocurrencies</option>
                    <option value="commodities">Commodities</option>
                    <option value="other">Other</option>
                  </select>
                  <div class="clearfix">
                    <button type="submit" name="add">Add Position</button>
                  </div>
                  <div class= "invalid" id="invalid_required">
                  All fields are required, but closing price is optional
                  </div>
                  <?php
                  if (isset($newPosition -> error)) {
                      echo '<br><span class="invalid-php">' . $newPosition -> error . '</span><br>';
                      }
                  if (isset($newPosition -> success)) {
                      echo '<br><span class="invalid-php">' . $newPosition -> success . '</span><br>';
                      }
                  ?>
                </fieldset>
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            </form>
        <footer class="footer">
          <div class="copyright">Copyright &copy; 2022</div>
          <form action="" method="POST">
            <div><button type=submit id="namebutton" name="namebutton">J. Hofer</button></div>
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
          </form>
        </footer>
      </body>

</html>