<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,300,1,0" />
    <link rel="icon" href="assets/devchallenges.png">
    <link rel="stylesheet" href="css/login.css">
    <title>Login | Authentication App | By David Carreño</title>
</head>

<body>
    <div class="container">
        <div class="app-container">
            <div class="logo-container">
                <img src="assets/devchallenges.svg" alt="devchangenges-logo" class="dev-logo">


            </div>
            <div class="title">

                <h2>Login</h2>
            </div>

            <?php
            if (isset($_POST["login"])) {
                $email = $_POST["email"];
                $password = $_POST["password"];

                $host = "localhost";
                $dbUser = "root";
                $dbPassword = "";
                $dbName = "miniproject";

                $connect = mysqli_connect($host, $dbUser, $dbPassword, $dbName);

                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = mysqli_query($connect, $sql);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

                if ($user) {
                    if (password_verify($password, $user["password_hash"])) {
                        $_SESSION["user"] = "yes";
                        header("Location: dashboard.php");
                        exit;
                    } else {
                        echo "<span class='error' >Password does not match</span>";
                    }
                } else {
                    echo "<span class='error' >Eamil does not match</span>";
                }
            }
            ?>

            <form class="index-form" method="post" action="login.php">


                <input type="email" class="email" placeholder="Email" name="email"> <span
                    class="material-symbols-outlined mail" style="color: #828282;">
                    mail
                </span>
                <input type="password" class="password" placeholder="Password" name="password"><span
                    class="material-symbols-outlined lock" style="color: #828282;">
                    lock
                </span>
                <input type="submit" value="Start coding now" class="button" name="login">
            </form>

            <div class="social-media">
                <p class="select-media">or continue with these social profile</p>
                <div class="social-media-icons">
                    <img src="assets/Google.svg" alt="Goolge-logo">
                    <img src="assets/Facebook.svg" alt="Facebook-logo">
                    <img src="assets/Twitter.svg" alt="Twitter-logo">
                    <img src="assets/Gihub.svg" alt="Github-logo">
                </div>
                <p class="member">Don't have an account yet?<a href="index.php"> Register</a></p>
            </div>
        </div>
        <footer>
            <p>created by <span class="name">David Carreño</span></p>
            <p>devchallenges.io</p>
        </footer>
    </div>
</body>

</html>