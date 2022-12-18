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
              <a href="homepage.php">Logout</a>
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
            <form action="addpos" method="POST">
                <h2>Add position</h2>
                <fieldset>
                    <legend></legend>

                    <label for="name">Name: </label>
                    <input type="text" id="name" name="name" placeholder="Enter Name" required pattern=".{4,}">
                    <div class= "invalid" id="invalid_name">
                      Please enter a valid name
                    </div>

                    <label for="ticker">Ticker: </label>
                    <input type="text" id="ticker" name="ticker" placeholder="Enter Ticker" required pattern=".{2,}">
                    <div class= "invalid" id="invalid_ticker">
                      Please enter a valid ticker
                    </div>

                    <label for="long_short_select">Long/Short: </label>
                    
                    <select name="long_short" id="long_short_select">
                        <option value="long">Long</option>
                        <option value="short">Short</option>
                    </select>
                    
                    <label for="date">Date: </label>
                    <input type="date" id="date" name="date" required>
                    
                    <label for="currency_select">Currency: </label>
                    
                    <select name="currency" id="currency_select">
                        <option value="usd">USD</option>
                        <option value="eur">EUR</option>
                        <option value="eur">EUR</option>
                        <option value="gbp">GBP</option>
                        <option value="czk">CZK</option>
                    </select>

                    <label for="amount">Amount: </label>
                    <input type="number" id="amount" name="amount" placeholder="Enter Amount" required>
                    <div class= "invalid" id="invalid_amount">
                      Please enter a valid amount
                    </div>

                    <label for="open_price">Opening price: </label>
                    <input type="number" id="open_price" name="open_price" placeholder="Enter open price" required>
                    <div class= "invalid" id="invalid_open_price">
                      Please enter a valid price
                    </div>

                    <label for="close_price">Closing price: </label>
                    <input type="number" id="close_price" name="close_price" placeholder="Enter close price">
                    <div class= "invalid" id="invalid_close_price">
                      Please enter a valid price
                    </div>

                    <label for="private_public_select">Private/Public: </label>
                    <select name="private_public" id="private_public_select">
                        <option value="private">Private</option>
                        <option value="public">Public</option>
                        <option value="anynomous">Anonymous</option>
                    </select>
                    
                    <div class="clearfix">
                        <button type="submit" class="addbtn">Add Position</button>
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