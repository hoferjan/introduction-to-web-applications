<?php 
    session_start();
    if (!isset($_SESSION['css'])) {
        $_SESSION['css'] = 'CSS/style.css';
    }
    require "PHP/registration.php";
    require "PHP/themeswitcher.php";
    
    $formIsSent = isset($_POST["reg"]);
    $email = '';
    $password = '';
    $repeat_password = '';
    $nickname = '';
    $favorite_type = '';

    if ($formIsSent) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $repeat_password = $_POST["repeat_password"];
        $nickname = $_POST["nickname"];
        $favorite_type = $_POST["favorite_type"];

        //checks if email and password are not yet in the database, redirect to mypositions.php and logs in user with session start
        $user =new RegisterUser($nickname, $password, $repeat_password, $email, $favorite_type);
            
        }
          
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Signup</title>
        <script src="validation_signup.js" defer></script> 
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
                <a href="login.php">Log in</a>
                <a href="signup.php">Sign up</a>
            </div>
          </header>
        <form action="" method="POST">
            <h2>Sign up:</h2>
            <fieldset>
                <legend></legend>

                <label for="email">Email: </label>
                
                <input type="email" id="email" name="email" placeholder="Enter Email*" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?= htmlspecialchars($email); ?>">
                <div class= "invalid" id="invalid_email">
                    Please enter a valid email
                </div>
                <?php
                if (isset($emailIsValid) && $emailIsValid == false) {
                    echo '<br><span class="invalid-php">Invalid Entry</span><br>';
                    }
                ?>

                <label for="nickname">Nickname: </label>
                
                <input type="text" id="nickname" name="nickname" placeholder="Enter Nickname*" required pattern=".{5,}" value="<?= htmlspecialchars($nickname); ?>">
                <div class= "invalid" id="invalid_length_nickname">
                    Nickname must be at least 5 characters long
                </div>
                <div class= "invalid" id="invalid_exists_nickname">
                    Nickname already exists
                </div>
                <?php
                if (isset($nicknameIsValid) && $nicknameIsValid == false) {
                    echo '<br><span class="invalid-php">Invalid Entry</span><br>';
                    }
                ?>
                

                <label for="password">Password: </label>
                
                <input type="password" id="password" name="password" placeholder="Enter Password*" required pattern=".{8,}">
                

                <label for="repeat_password">Repeat password: </label>
                
                <input type="password" id="repeat_password" name="repeat_password" placeholder="Repeat Password*" required pattern=".{8,}">
                <?php
                if ((isset($passwordIsValid ) && $passwordIsValid == false) || (isset($repeatPasswordIsValid) && $repeatPasswordIsValid == false)) {
                    echo '<br><span class="invalid-php">Invalid Entry</span><br>';
                    }
                ?>
                <div class= "invalid" id="invalid_match_password">
                    Passwords do not match
                </div>
                <div class= "invalid" id="invalid_length_password">
                    Password has to be at least 8 characters long
                </div>
                
                <!-- not mandatory  field--> 
                <label for="favorite_type">Favorite type of investment: </label>
                <select name="favorite_type" id="favorite_type" >
                    <?php if (isset($favorite_type)) { ?>
                        <option value="<?= $favorite_type ?>"><?= $favorite_type ?></option>
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
                <div class= "invalid" id="invalid_select">
                    Please select an option
                </div>
            
                <button type="submit" name="reg">Sign up</button>
                <div class= "invalid" id="invalid_form">
                    The form has not been filled out correctly
                </div>
                <div class= "invalid" id="invalid_required">
                    The fields marked by * are required
                </div>
                <?php
                if (isset($user -> error)) {
                    echo '<br><span class="invalid-php">' . $user -> error . '</span><br>';
                    }
                if (isset($user -> success)) {
                    echo '<br><span class="invalid-php">' . $user -> success . '</span><br>';
                    }
                ?>
            </fieldset>
        </form>
        <footer class="footer">
            <div class="copyright">Copyright &copy; 2022</div>
            <form action="" method="POST">
            <div><button type=submit id="namebutton" name="namebutton">J. Hofer</button></div>
            </form>
        </footer>
    </body>

</html>