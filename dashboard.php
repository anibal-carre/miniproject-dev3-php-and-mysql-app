<?php
session_start();


if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$host = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "miniproject3";
$connect = mysqli_connect($host, $dbUser, $dbPassword, $dbName);


if ($connect->connect_error) {
    die("Failed connection: " . $connect->connect_error);
}

$user_id = $_SESSION["user_id"];
$stmt = $connect->prepare("SELECT user_name, bio, email, photo, phone FROM users WHERE id= ?");
if (!$stmt) {
    die("Error en la consulta SQL: " . $conn->error);
}
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,300,1,0" />
    <link rel="icon" href="assets/devchallenges.png">
    <link rel="stylesheet" href="css/dashboard.css">
    <title>Dashboard | Authentication App | By David Carreño</title>
</head>

<body>
    <div class="container">
        <header>
            <div class="header-image">
                <img src="assets/devchallenges.svg" alt="devchangelles-logo">
            </div>

            <nav class="header-menu">

                <?php if (!empty($user["photo"])) { ?>
                    <a href="logout.php"><img src="<?php echo $user["photo"]; ?>" alt="user-image" width="32px" height="32px" style="border-radius:8px ;"></a>
                <?php } else { ?>
                    <a href="logout.php"><img src="assets/user-image.jpg" alt="user-image" width="32px" height="32px" style="border-radius:8px ;"></a>
                <?php } ?>
            </nav>
        </header>

        <div class="personal-info">
            <h2 class="info-title">Personal info</h2>
            <p class="info-content">Basic info, like your name and photo</p>
        </div>

        <div class="container2">
            <div class="profile-and-list-container">
                <div class="profile-container">
                    <div class="profile-text">
                        <h2 class="profile-title">Profile</h2>
                        <p class="profile-content">Some info may be visible to other people</p>
                    </div>

                    <div class="button-container">
                        <a href="editprofile.php"><button class="profile-button" style="cursor: pointer;">Edit</button></a>
                    </div>
                </div>

                <section class="list-information-section">
                    <div class="list-item list-photo">
                        <span class="item-title">PHOTO</span>
                        <?php if (!empty($user["photo"])) { ?>
                            <img src="<?php echo $user["photo"]; ?>" alt="user-image" width="72px" height="72px" style="border-radius: 8px;">
                        <?php } else { ?>
                            <img src="assets/user-image.jpg" alt="user image" width="72px" height="72px" style="border-radius: 8px;" />
                        <?php } ?>
                    </div>



                    <div class=" list-item list-name">
                        <span class="item-title">NAME</span>
                        <span class="item-text"><?php echo $user["user_name"]; ?></span>
                    </div>

                    <div class="list-item list-bio">
                        <span class="item-title">BIO</span>
                        <span class="item-text"><?php echo $user["bio"]; ?></span>
                    </div>

                    <div class="list-item list-phone">
                        <span class="item-title">Phone</span>
                        <span class="item-text"><?php echo $user["phone"]; ?></span>
                    </div>

                    <div class="list-item list-email">
                        <span class="item-title">EMAIL</span>
                        <span class="item-text"><?php echo $user["email"]; ?></span>
                    </div>

                    <div class="list-item list-password">
                        <span class="item-title">PASSWORD</span>
                        <span class="item-text">*********</span>
                    </div>
                </section>

            </div>

            <footer>
                <p>created by <span class="name">David Carreño</span></p>
                <p>devchallenges.io</p>
            </footer>

        </div>
    </div>
</body>

</html>