<?php 
    require "PHP/validation.php";
    $formIsSent = isset($_POST["log"]);

    $email = '';
    $password = '';

    if ($formIsSent) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $emailIsValid = validateEmail($email);
        $passwordIsValid = validatePassword($password);

        if ($emailIsValid && $passwordIsValid) {
            // checks if email and password are correct
            //redirect to mypositions.php and logs in user
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
        <title>Log in</title>
        <link rel="stylesheet" href="CSS/style.css"> 
        <link rel="stylesheet" href="CSS/print.css" media="print">
        <script src="validation_login.js" defer></script>
        <script src="theme_switcher.js" defer></script>
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
        <div id="content">
                <form action="" method="POST">
                    <h2>Log in</h2>
                    <fieldset class="container">
                        <legend></legend>
                        <label for="email">Email: </label>
                        
                        <input type="email" id="email" name="email" placeholder="Enter Email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?= htmlspecialchars($email); ?>">
                        <div class= "invalid" id="invalid_email">
                            Please enter a valid email
                        </div>
                        <?php
                        if (isset($emailIsValid) && $emailIsValid == false) {
                            echo '<br><span class="invalid-php">Invalid Entry</span><br>';
                            }
                        ?>
                    
                        <label for="password">Password: </label>
                        
                        <input type="password" id="password" name="password" placeholder="Enter Password" required pattern=".{8,}">
                        <div class= "invalid" id="invalid_password">
                            Please enter a valid password
                        </div>
                        <?php
                        if (isset($passwordIsValid) && $passwordIsValid == false) {
                            echo '<br><span class="invalid-php">Invalid Entry</span><br>';
                            }
                        ?>
                        <div class="clearfix">
                            <button type="submit" name="log" class="signupbtn">Log in</button>
                        </div>
                    </fieldset>
                </form>
        </div>
        <footer class="footer">
            <div class="copyright">Copyright &copy; 2022</div>
        <div><button id="namebutton">J. Hofer</button></div>
        </footer>
    </body>

</html>