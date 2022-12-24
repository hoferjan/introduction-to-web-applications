<?php 
    require "PHP/validation.php";
    require "PHP/logination.php";

    session_start();
    $uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : NULL;

    if ($uid) {
        $user = getUserByUid($uid);
    } else {
        header('Location: homepage.php');
    }
    $formIsSent = isset($_POST["add"]);

    $name = '';
    $ticker = '';
    $longShort = '';
    $date = '';
    $currency = '';
    $amount = '';
    $openPrice = '';
    $closPrice = '';
    $privatePublic = '';
    $type = '';


    if ($formIsSent) {
        $name = $_POST["name"];
        $ticker = $_POST["ticker"];
        $longShort = $_POST["long_short"];
        $date = $_POST["date"];
        $currency = $_POST["currency"];
        $amount = $_POST["amount"];
        $openPrice = $_POST["open_price"];
        $closPrice = $_POST["clos_price"];
        $privatePublic = $_POST["private_public"];
        $type = $_POST["type"];


        $nameIsValid = validateName($name);
        $tickerIsValid = validateTicker($ticker);
        $longShortIsValid = validateLongShort($longShort);
        $dateIsValid = validateDate($date);
        $currencyIsValid = validateCurrency($currency);
        $amountIsValid = validateAmount($amount);
        $openPriceIsValid = validatePrice($openPrice);
        $closPriceIsValid = validatePrice($closPrice);
        $privatePublicIsValid = validatePrivatePublic($privatePublic);
        

        if ($nameIsValid && $tickerIsValid && $longShortIsValid && $dateIsValid && $currencyIsValid && $amountIsValid && $openPriceIsValid && $closPriceIsValid && $privatePublicIsValid) {
            //checks if this exact positino has not already been added
            //adds position to database connected to the user
            //adds position to all positions if Public or Anonymous
            //redirect to mypositions.php with the new position added
            header("Location: mypositions.php");
        } else {
            //shows errors under the input fields
        }
    }
?>
<!DOCTYPE html> 
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Positions</title>
        <script src="validation_addpos.js" defer></script> <!-- here goes js to validate inputs-->
        <script src="theme_switcher.js" defer></script>
        <link rel="stylesheet" href="CSS/style.css"> 
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
                </tr>
                <tr class="tcontent">
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
                <tr class="tcontent">
                  <td class="name">Bed Bath & Beyond</td>
                  <td class="ticker">BBBY</td>
                  <td class="long_short">Short</td>
                  <td class="date">12.12.2022</td>
                  <td class="currency">USD</td>
                  <td class="amount">500</td>
                  <td class="opening_price">3.57</td>
                  <td class="closing_price"></td>
                  <td class="type">Stocks</td>
                </tr>
                <tr class="tcontent">
                  <td class="name">Bitcoin</td>
                  <td class="ticker">BTC</td>
                  <td class="long_short">Long</td>
                  <td class="date">12.12.2022</td>
                  <td class="currency">USD</td>
                  <td class="amount">0.132</td>
                  <td class="opening_price">16432</td>
                  <td class="closing_price"></td>
                  <td class="type">Cryptocurrencies</td>
                </tr>
                <tr class="tcontent">
                  <td class="name">U.S 10 Zear Treasury Note</td>
                  <td class="ticker">TMUBMUSD10Y</td>
                  <td class="long_short">Long</td>
                  <td class="date">12.12.2022</td>
                  <td class="currency">USD</td>
                  <td class="amount">150</td>
                  <td class="opening_price">3.8</td>
                  <td class="closing_price">3.9</td>
                  <td class="type">Bond</td>
                </tr>
                <tr class="tcontent">
                  <td class="name">Dogecoin</td>
                  <td class="ticker">DOGEUSD</td>
                  <td class="long_short">Long</td>
                  <td class="date">12.12.2022</td>
                  <td class="currency">USD</td>
                  <td class="amount">42069</td>
                  <td class="opening_price">0.08</td>
                  <td class="closing_price"></td>
                  <td class="type">Cryptocurrencies</td>
                </tr>
                <tr class="tcontent">
                  <td class="name">ČEZ</td>
                  <td class="ticker">EB CEZ TL09</td>
                  <td class="long_short">Long</td>
                  <td class="date">12.12.2022</td>
                  <td class="currency">CZK</td>
                  <td class="amount">820</td>
                  <td class="opening_price">52</td>
                  <td class="closing_price">74</td>
                  <td class="type">Stocks</td>
                </tr>
                <tr class="tcontent">
                  <td class="name">Gold</td>
                  <td class="ticker">GOLD</td>
                  <td class="long_short">Long</td>
                  <td class="date">12.12.2022</td>
                  <td class="currency">USD</td>
                  <td class="amount">3</td>
                  <td class="opening_price">1841</td>
                  <td class="closing_price"></td>
                  <td class="type">Commodities</td>
                </tr>
                <tr class="tcontent">
                  <td class="name">Bank Of America</td>
                  <td class="ticker">BAC</td>
                  <td class="long_short">Short</td>
                  <td class="date">12.12.2022</td>
                  <td class="currency">USD</td>
                  <td class="amount">100000</td>
                  <td class="opening_price">90</td>
                  <td class="closing_price"></td>
                  <td class="type">Stocks</td>
                </tr>
                <tr class="tcontent">
                  <td class="name">Tesla</td>
                  <td class="ticker">TSLA</td>
                  <td class="long_short">Long</td>
                  <td class="date">12.12.2022</td>
                  <td class="currency">USD</td>
                  <td class="amount">303</td>
                  <td class="opening_price">201</td>
                  <td class="closing_price"></td>
                  <td class="type">Stocks</td>
                </tr>

            </tbody></table>
            </div>
            <form action="" method="POST">
                <h2>Add position</h2>
                <fieldset>
                    <legend></legend>

                    <label for="name">Name: </label>
                    <input type="text" id="name" name="name" placeholder="Enter Name" required pattern=".{4,}" value="<?= htmlspecialchars($name); ?>">
                    <?php
                    if (isset($nameIsValid) && $nameIsValid == false)  {
                      echo '<br><span class="invalid-php">Invalid Entry</span><br>';
                      }
                    ?>
                    <div class= "invalid" id="invalid_name">
                      Please enter a valid name
                    </div>

                    <label for="ticker">Ticker: </label>
                    <input type="text" id="ticker" name="ticker" placeholder="Enter Ticker" required pattern=".{2,}" value="<?= htmlspecialchars($ticker); ?>">
                    <?php
                    if (isset($tickerIsValid) && $tickerIsValid == false)  {
                      echo '<br><span class="invalid-php">Invalid Entry</span><br>';
                      }
                    ?>
                    <div class= "invalid" id="invalid_ticker">
                      Please enter a valid ticker
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
                      <option value="gbp">GBP</option>
                      <option value="czk">CZK</option>
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

                    <label for="clos_price">Closing price: </label>
                    <input type="number" id="clos_price" name="clos_price" placeholder="Enter close price" pattern="[0-9]+"value="<?= htmlspecialchars($closPrice); ?>">
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
                        <option value="anynomous">anonymous</option>
                    </select>
                    
                  <label for="type_select">Type: </label>
                  <select name="type" id="type_select">
                    <?php if (isset($type) && $type != '') { ?>
                        <option value="<?= $type ?>"><?= $type ?></option>
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
                  All fields are required
                  </div>
                </fieldset>
                
            </form>
        <footer class="footer">
          <div class="copyright">Copyright &copy; 2022</div>
          <div><button id="namebutton">J. Hofer</button></div>
        </footer>
      </body>

</html>