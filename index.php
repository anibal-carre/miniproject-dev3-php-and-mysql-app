<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit;
}

if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    $host = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "miniproject";

    try {
        $connect = mysqli_connect($host, $dbUser, $dbPassword, $dbName);
        if (!$connect) {
            throw new Exception("Error al conectar con la base de datos.");
        }

        $sql = "INSERT INTO users (email, password_hash) VALUES (?,?)";
        $stmt = mysqli_stmt_init($connect);
        $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
        if (!$prepareStmt) {
            throw new Exception("Error al preparar la consulta SQL.");
        }

        mysqli_stmt_bind_param($stmt, "ss", $email, $password);
        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Error al ejecutar la consulta SQL.");
        }

        echo "<span class='registered'>Te has registrado correctamente.</span>";
        $_SESSION["user"] = "yes";
        header("Location: dashboard.php");
        exit;
    } catch (Exception $e) {
        echo "<span class='error'>Error: " . $e->getMessage() . "</span>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,300,1,0" />
    <link rel="icon" href="assets/devchallenges.png">
    <link rel="stylesheet" href="css/index.css">
    <title>Authentication App | By David Carreño</title>
</head>

<body>
    <div class="container">
        <div class="app-container">
            <div class="logo-container">
                <img src="assets/devchallenges.svg" alt="devchangenges-logo" class="dev-logo">


            </div>
            <div class="title">

                <h2>Join thousands of learners from around the world</h2>
            </div>
            <div class="content">
                <p>Master web development by making real-life projects. There are multiple paths for you to choose</p>
            </div>
            <form class="index-form" method="post" action="index.php">
                <input type="email" class="email" placeholder="Email" name="email" title="Enter your email" required>
                <span class="material-symbols-outlined mail" style="color: #828282;">
                    mail
                </span>
                <input type="password" class="password" placeholder="Password" name="password" maxlength="8" title="Enter your password" required><span class="material-symbols-outlined lock" style="color: #828282;">
                    lock
                </span>
                <input type="submit" value="Start coding now" class="button" name="submit">
            </form>

            <div class="social-media">
                <p class="select-media">or continue with these social profile</p>
                <div class="social-media-icons">
                    <img src="assets/Google.svg" alt="Goolge-logo">
                    <img src="assets/Facebook.svg" alt="Facebook-logo">
                    <img src="assets/Twitter.svg" alt="Twitter-logo">
                    <img src="assets/Gihub.svg" alt="Github-logo">
                </div>
                <p class="member">Already a member? <a href="login.php">Login</a></p>
            </div>
        </div>
        <footer>
            <p>created by <span class="name">David Carreño</span></p>
            <p>devchallenges.io</p>
        </footer>
    </div>
</body>