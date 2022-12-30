<?php 
  session_start();
  if (!isset($_SESSION['css'])) {
      $_SESSION['css'] = 'CSS/style.css';
  }

  require "PHP/logination.php";
  require "PHP/themeswitcher.php";
  require "PHP/loadpositions.php";
  require "PHP/filterpositions.php";
  require "PHP/sortpositions.php";

  
  $filteredPositions = [];

  $uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : NULL;

  //sends to homepage if user is not logged in
  if ($uid) {
      $user = getUserByUid($uid);
  } else {
      header('Location: homepage.php');
  }

  // Load the positions from the JSON file
  $positions = json_decode(file_get_contents('JSON/positions.json'), true);


  //get only the positions which are not set to private or the user is the owner
  foreach ($positions as $position) {
    if ($position['private_public'] != "private" || $position['uid'] == $_SESSION['uid']) {
          //push position to filteredPositions
          array_push($filteredPositions, $position);
      }
  }

  // Set the default page number
  $page = 1;

  // Check if the page form has been submitted
  if (isset($_POST['page'])) {
    // Set the page number and offset from the form submission
    $page = (int) $_POST['page'];
    }


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
    $additionalPositions = array_slice($refilteredPositions, 0,$page * 20);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>All Positions</title>
        <link rel="stylesheet" href="<?= $_SESSION["css"] ?>">
        <link rel="stylesheet" href="CSS/print.css" media="print">
        <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
        <link rel="manifest" href="site.webmanifest">
    </head>
    <body>
        <header class="group">
            <a href="homepage.php">
                <img
                alt="folio_logo"
                src="folio-logo_blue-removebgx250.png"
                />
            </a>
          <div id="navbar">
              <a href="mypositions.php">My positions</a>
              <a href="allpositions.php">All positions</a>
              <a href="PHP/logout.php">Logout</a>
          </div>
        </header>
        <div id="content">
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
        </form>
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
        </form>
            <div id="table">
                <table>
                    <tbody><tr class="thead">
                        <th class="user_head">User</th>
                        <th class="name_head">Name</th>
                        <th class="ticker_head">Ticker</th>
                        <th class="long_short_head">Long/Short</th>
                        <th class="date_head">Date</th>
                        <th class="currency_head">Currency</th>
                        <th class="amount_head">Amount</th>
                        <th class="opening_price_head">Opening price</th>
                        <th class="closing_price_head">Closing price</th>
                        <th class="type_head">Type</th>
                    </tr>
                    <?php
                    foreach ($additionalPositions as $position) {
                          echo "<tr class='tcontent'>";
                          if ($position['private_public'] == 'anonymous') {
                              echo "<td class='user'>anonymous</td>";
                          } else {
                            echo "<td class='user'>" . getUserByUid($position['uid'])["username"] . "</td>";
                          }
                          echo "<td class='name'>" . $position['name'] . "</td>";
                          echo "<td class='ticker'>" . $position['ticker'] . "</td>";
                          echo "<td class='long_short'>" . $position['longShort'] . "</td>";
                          echo "<td class='date'>" . $position['date'] . "</td>";
                          echo "<td class='currency'>" . $position['currency'] . "</td>";
                          echo "<td class='amount'>" . $position['amount'] . "</td>";
                          echo "<td class='opening_price'>" . $position['opening_price'] . "</td>";
                          echo "<td>" . $position['closing_price'] . " (" . $position['profit'] . "%)</td>";
                          echo "<td class='type'>" . $position['type'] . "</td>";
                          echo "</tr>";
                      }
                    ?>
                </tbody>
              </table>
          </div>
          <div id="pagination">
          <form action="" method="POST">
              <!-- Display the "load more" button only if there are additional positions to load -->
              <?php if ($page * 20 < count($refilteredPositions)) { ?>
              <button type="submit" id="load-more-btn">Load more</button>
              <?php } ?>
              <!-- Add a hidden input field to store the current page number -->
              <input type="hidden" name="page" id="page" value="<?= $page + 1 ?>">
              <?php if (isset($type)) { ?>
              <input type="hidden" name="type" id="type" value="<?= $type ?>">
              <?php } ?>
              <?php if (isset($sort)) { ?>
              <input type="hidden" name="sort" id="sort" value="<?= $sort ?>">
              <?php } ?>
          </form>
      </div>
        </div>
        <footer class="footer">
          <div class="copyright">Copyright &copy; 2022</div>
          <form action="" method="POST">
            <div><button type=submit id="namebutton" name="namebutton">J. Hofer</button></div>
          </form>
        </footer>
      </body>

</html>