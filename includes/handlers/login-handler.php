<?php
if(isset($_POST['loginButton'])) {
    $username = $_POST['loginUsername'];
    $password = $_POST['loginPassword'];
    echo $passowrd;

    $result = $account->login($username, $password);
    if($result){
        // crete a session variable and give him the value of username
        $_SESSION['userLoggedIn'] = $username;
        header("Location: index.php");
    }  
}

?>