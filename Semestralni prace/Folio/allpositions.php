<?php 
  session_start();
  if (!isset($_SESSION['css'])) {
      $_SESSION['css'] = 'CSS/style.css';
  }

  require "PHP/logination.php";
  require "PHP/themeswitcher.php";
  require "PHP/loadpositions.php";

  $uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : NULL;

  if ($uid) {
      $user = getUserByUid($uid);
  } else {
      header('Location: homepage.php');
  }

  // Load the positions from the JSON file
  $positions = json_decode(file_get_contents('JSON/positions.json'), true);


  //get only the positions which are not set to private or the user is the owner
  $filteredPositions = [];
  foreach ($positions as $position) {
    if ($position['private_public'] != "private" || $position['uid'] == $_SESSION['uid']) {
          //push position to filteredPositions
          array_push($filteredPositions, $position);
      }
  }

  // Set the default page number
  $page = 1;

  // Check if the form has been submitted
  if (isset($_POST['page'])) {
    // Set the page number and offset from the form submission
    $page = (int) $_POST['page'];
  }

  // Retrieve the additional positions from the array
  $additionalPositions = array_slice($filteredPositions, 0,$page * 20);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>All Positions</title>
        <script src="validation_addpos.js"></script>
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
                    <!-- Example: -->
                    <!-- <tr class="tcontent">
                        <td class="user">Slayerx82</td>
                        <td class="name">Apple</td>
                        <td class="ticker">APPL</td>
                        <td class="long_short">Long</td>
                        <td class="date">12.12.2022</td>
                        <td class="currency">USD</td>
                        <td class="amount">52</td>
                        <td class="opening_price">148.21</td>
                        <td class="closing_price"></td>
                        <td class="type">Stocks</td>
                    </tr>
                    -->
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
                          echo "<td class='closing_price'>" . $position['closing_price'] . "</td>";
                          echo "<td class='type'>" . $position['type'] . "</td>";
                          echo "</tr>";
                      }
                  
                    
                    ?>
                </tbody>
              </table>
          </div>
          <div id="pagination">
          <form action="allpositions.php" method="POST">
              <!-- Display the "load more" button only if there are additional positions to load -->
              <?php if ($page * 20 < count($filteredPositions)) { ?>
              <button type="submit" id="load-more-btn">Load more</button>
              <?php } ?>
              <!-- Add a hidden input field to store the current page number -->
              <input type="hidden" name="page" id="page" value="<?= $page + 1 ?>">
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