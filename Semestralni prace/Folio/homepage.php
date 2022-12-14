<?php
session_start();
require "PHP/themeswitcher.php";

if (!isset($_SESSION['css'])) {
  $_SESSION['css'] = 'CSS/style.css';
}

if (!isset($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Folio</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="<?= $_SESSION["css"] ?>">
    <link rel="stylesheet" href="CSS/print.css" media="print">
    <link rel="apple-touch-icon" sizes="180x180" href="pics/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="pics/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="pics/favicon-16x16.png">
    <link rel="manifest" href="../pics/site.webmanifest">
  </head>
  <body id="homepage">
    <div id="page">
      <header class="group">
        <a href="mypositions.php">
            <img
            alt="folio_logo"
            src="pics/folio-logo_blue-removebgx250.png"
            />
        </a>
        <div id="navbar">
            <a href="login.php">Log in</a>
            <a href="signup.php">Sign up</a>
        </div>
      </header>
      <div id="content">
          <div id="punchline"><h1>You wanna track your portfolio? Try out Folio!</h1></div>
          <!-- example table for the homepage -->
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
                <tr class="tcontent">
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
                <tr class="tcontent">
                  <td class="user">Shadowtrader</td>
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
                  <td class="user">FTXloser</td>
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
                  <td class="user">AverJoe</td>
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
                  <td class="user">Anonymous</td>
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
                  <td class="user">Sandalealltheway</td>
                  <td class="name">??EZ</td>
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
                  <td class="user">Goldbug</td>
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
                  <td class="user">michaelburry</td>
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
                  <td class="user">Anonymous</td>
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
        <br>
        <h2><spa id="signhmpg"><a href="signup.php">Sign up now!</a></spa></h2>
          
          
      </div>
    </div>
      <footer class="footer">
        <div class="copyright">Copyright &copy; 2022 </div>
        <form action="" method="POST">
            <div><button type=submit id="namebutton" name="namebutton">J. Hofer</button></div>
        </form>
      </footer>
  </body>
</html>