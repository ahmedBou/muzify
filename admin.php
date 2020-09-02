<?php
session_start();
// session_destroy();
  if(!isset($_SESSION['isAdmin'])) {
    header("Location: index.php");
    exit;
  }

    include("includes/config.php");
    if(isset($_POST["id"])){
        $user_id = $_POST["id"];
        $pdo->query("DELETE FROM users WHERE users_id='$user_id'");
    }
    $result = $pdo->query("SELECT * FROM users");
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/admin.css">
    <title>Admin Panel</title>
</head>

<body>
    <div class="main-container">
        <div class="side">
            <div class="side-header">
                <h1 class="logo">Legacy<span>Zik</span></h1>
            </div>
            <div class="side-menu">
                <ul>
                    <li>Manage Users</li> 
                </ul>
            </div>
        </div>
        <div class="content">
            <h1>Users List</h1>
            <table>
                <thead>
                    <tr>
                        <td>Username</td>
                        <td>Full Name</td>
                        <td>Email</td>
                        <td>SignUp date</td>
                        <td>x</td>
                    </tr>
                </thead>
                <tbody>
                    <?php while($user = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td><?php echo $user["username"] ?></td>
                        <td><?php echo ($user["firstName"] . " " . $user["lastName"])?></td>
                        <td><?php echo $user["email"] ?></td>
                        <td><?php echo $user["signUpDate"] ?></td>
                        <td>
                            <form method="POST">
                            <input type="hidden" value="<?php echo $user["users_id"] ?>" name="id">
                            <input type="submit" class="delete-btn" value="Delete">
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>

