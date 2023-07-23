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
            <form class="index-form" method="post" action="">
                <?php

                require_once "database.php";

                if ($connect->connect_error) {
                    die("Failed connection:" . $connect->connect_error);
                }

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $email = $_POST["email"];
                    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

                    $stmt = $connect->prepare("SELECT id FROM users WHERE email = ?");
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $stmt->store_result();

                    if ($stmt->num_rows > 0) {
                        echo "<span class='error' >email already exists</span>";
                    } else {
                        $stmt = $connect->prepare("INSERT INTO users (email, password_hash) VALUES (?, ?)");
                        $stmt->bind_param("ss", $email, $password);

                        if ($stmt->execute()) {
                            header("Location: editprofile.php");
                            exit();
                        } else {
                            echo "Failed to register";
                        }
                    }
                }
                ?>
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