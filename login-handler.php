<?php
if(isset($_POST['loginButton'])) {
    $username = sanitizeFormUsername($_POST['username']);
    echo $username;

}
?>