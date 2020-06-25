<?php
include("includes/config.php");
include("includes/classes/Account.php");
include("includes/classes/Constants.php");

$account = new Account($con); 
include("includes/handlers/register-handler.php") ;
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
    <title>Muzify</title>
</head>
<body>
    <div id="inputContainer">
        <h1>login to your account</h1>
        <form action="register.php" method="POST" id="loginForm">
            <p>
                <label for="loginUsername">username</label>
                <input id="loginUsername" type="text" name="loginUsername" placeholder="mickael jackson" required>
            </p>

            <p>
                <label for="loginPassword">password</label>
                <input id="loginPassword" type="password" name="loginPassword" required>
            </p>
                <button type="submit" name="loginButton">Login</button>
            <!-- <input type="submit" name="loginButton"> -->
        </form>



        <h1>create a free account</h1>
        <form action="register.php" method="POST" id="registerForm">
        <p>
        <?php echo $account->getError( Constants::$usernameCharacters) ?>

            <label for="username">username</label>
            <input id="username" type="text" <?php getInputValue("username") ?> value="<?php echo $_POST['username'];?>" placeholder="mickael jackson" required>
        </p> 

        <p>
            <?php echo $account->getError(Constants::$firstNameCharacters) ?>
            <label for="firstName">first name</label>
            <input id="firstName" type="text" <?php getInputVAlue("firstName") ?> value="<?php echo $_POST['firstName']?>" placeholder="mickael" required>
        </p> 
              
        <p> 
        <?php echo $account->getError(Constants::$lastNameCharacters) ?>
            <label for="lastName">last name</label>
            <input id="lastName" type="text" <?php getInputVAlue("lastName") ?> value="<?php echo $_POST['lastName']?>" placeholder="mickael jackson" required>
        </p>
        <p>
            <label for="email">email</label>
            <input id="email" type="email" <?php getInputVAlue("email" ) ?> value="<?php echo $_POST['email']?>" placeholder="e.g ahmed@gmail.com" required>
        </p>
        <p>
            <?php echo $account->getError(Constants::$emailsDoNotMatch) ?>
            <?php echo $account->getError(Constants::$emailInvalid) ?>
            <label for="email2">confirm email</label>
            <input id="email2" type="email" <?php getInputVAlue("email2") ?> value="<?php echo $_POST['email2'] ?>" placeholder="e.g ahmed@gmail.com" required>
        </p>

        <p>          
            <?php echo $account->getError(Constants::$passwordsDoNoMatch); ?>
            <?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
            <?php echo $account->getError(Constants::$passwordCharacters); ?>
            <label for="password">password</label>
            <input id="password" name="password" type="text" value="<?php echo $_POST['password']?>" placeholder="your password" required>
        </p>
        <p>
            <label for="password2">Confirm Password</label>
            <input id="Password2" name="password2" type="text"  value="<?php echo $_POST['password2']?>" placeholder="confirm yoy password" required>
        </p>
            <button type="submit" name="registerButton">Login</button>
            <!-- <input type="submit" name="registerButton"> -->
        </form>
    </div>
</body>
</html>