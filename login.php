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

            <form class="index-form" method="post" action="login.php">
                <?php

                require_once "database.php";

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $email = $_POST["email"];
                    $password = $_POST["password"];

                    $stmt = $connect->prepare("SELECT id, password_hash FROM users WHERE email = ?");

                    if ($stmt === false) {
                        die("Error en la consulta SQL: " . mysqli_error($connect));
                    }
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $stmt->store_result();

                    if ($stmt->num_rows > 0) {
                        $stmt->bind_result($id, $hashed_password);
                        $stmt->fetch();

                        if (password_verify($password, $hashed_password)) {
                            session_start();
                            $_SESSION["user_id"] = $id;

                            header("Location: dashboard.php");
                            exit();
                        } else {
                            echo "<span class='error' >Incorrect password.</span>";
                        }
                    } else {
                        echo "<span class='error' >User does not exist</span>";
                    }
                }
                ?>


                <input type="email" class="email" placeholder="Email" name="email"> <span
                    class="material-symbols-outlined mail" style="color: #828282;">
                    mail
                </span>
                <input type="password" class="password" placeholder="Password" name="password"><span
                    class="material-symbols-outlined lock" style="color: #828282;">
                    lock
                </span>
                <input type="submit" value="Login" class="button" name="login">
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