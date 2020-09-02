<!-- <?php
// if(isset($_POST['loginButton'])) {
//     $username = $_POST['loginUsername'];
//     $password = $_POST['loginPassword'];
//     echo $passowrd;

//     $result = $account->login($username, $password);
//     if($result){
//         // crete a session variable and give him the value of username
//         $_SESSION['userLoggedIn'] = $username;
//         header("Location: index.php");
//     }  
// }

?> -->

<?php
if(isset($_POST['loginButton'])) {
    $username = $_POST['loginUsername'];
    $password = $_POST['loginPassword'];
    echo $passowrd;

    $result = $account->login($username, $password)[0];
    if($result){
        // crete a session variable and give him the value of username
        $_SESSION['userLoggedIn'] = $username;

        if($account->login($username, $password)[1]){
            $_SESSION['isAdmin'] = $username;
        }
        header("Location: index.php");
    }  
}

?>