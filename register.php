<?php
include("includes/config.php");
include("includes/classes/Account.php");
include("includes/classes/Constants.php");

$account = new Account($pdo);

include("includes/handlers/register-handler.php");
include("includes/handlers/login-handler.php");

function getInputValue($name){
    if(isset($_POST[$name])){
        echo $_POST[$name];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/login.css">
    <title>Muzify - Listen Free and be FREE!</title>
</head>

<body>

    <div class="container">
        <div class="header">
            <img src="assets/images/g481.png" alt="Muzify Logo">
            <div class="header-text">
               <ul>
                   <li>Enjoy The Latest Songs</li>
                   <li>Save Your Favorite Playlists</li>
                   <li>Share Music With Your Friends</li>
                   <li>And More...</li>
               </ul>
            </div>

        </div>
        <div class="panel">
            <div class="labels">
                <button class="active-panel">Sign Up</button>
                <button>Sign In</button>
            </div>
            <!-- ***************************************Register********************************************************* -->
            <div class="forms">
                <div id="sign_up" class="active-form form">

                    <form action="register.php" method="POST" id="registerForm">

                        <div class="input-from">
                            <label>
                                <input type="text" value="<?php getInputValue('username') ?>" name="username" placeholder="Enter a username" required>
                            </label>
                            <span class='errorMessage'><?php echo $account->getError( Constants::$usernameCharacters) ?></span>
                        </div>

                        <div class="input-from">
                            <label>
                                <input type="text" value="<?php getInputValue('firstName') ?>" name="firstName" placeholder="Your first name" required>
                            </label>
                            <span class='errorMessage'><?php echo $account->getError(Constants::$firstNameCharacters) ?></span>          
                        </div>

                        <div class="input-from">
                            <label>
                                <input type="text" value="<?php getInputValue('lastName') ?>" name="lastName" placeholder="Your last name" required>
                            </label>
                            <span class='errorMessage'><?php echo $account->getError(Constants::$lastNameCharacters) ?></span>
                        </div>

                        <div class="input-from">
                            <label>
                                <input type="email" value="<?php getInputValue('email') ?>" name="email"  placeholder="Enter your email" required>
                            </label>
                            <span class='errorMessage'><?php echo $account->getError(Constants::$emailInvalid) ?></span>
                            <span class='errorMessage'><?php echo $account->getError(Constants::$emailTaken)?></span>

                        </div>

                        <div class="input-from">
                            <label>
                                <input type="password" name="password" placeholder="Enter a password" required>
                            </label>
                            <span class='errorMessage'><?php echo $account->getError(Constants::$passwordsDoNoMatch); ?></span>
                            <span class='errorMessage'><?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?></span>
                            <span class='errorMessage'><?php echo $account->getError(Constants::$passwordCharacters); ?></span>
                        </div>

                        <div class="input-from">
                            <label>
                                <input type="password" name="password2" placeholder="Re enter password" required>
                            </label>
                        </div>

                        <button type="submit" class="submit-btn" name="registerButton">Sign Up</button>
                    </form>
                </div>
                <!--*******************************ENd of Regiter****************************************************-->

                <!-- **************************************LOgin***************************************************** -->
                <div id="sign_in" class="form">

                    
                    <form action="register.php" method="POST" id="loginForm">
                        <div class="input-from">
                            <label>
                                <input type="text" name="loginUsername" placeholder="username or email" required>
                            </label>
                            <span class='errorMessage'><?php echo $account->getError(Constants::$loginFailed); ?></span>

                        </div>
                        <div class="input-from">
                            <label>
                                <input type="text" name="loginPassword" placeholder="Your password" required>
                            </label>

                        </div>
                        <button class="submit-btn" type="submit" name="loginButton">Login</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script src="assets/scripts/login.js"></script>
</body>

</html>