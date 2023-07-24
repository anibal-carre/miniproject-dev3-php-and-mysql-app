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
$stmt = $connect->prepare("SELECT user_name, bio, phone, email, password_hash, photo FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $bio = $_POST["bio"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    $stmt = $connect->prepare("UPDATE users SET user_name = ?, bio = ?, phone = ?, email = ?, password_hash = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $name, $bio, $phone, $email, $password, $user_id);

    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == UPLOAD_ERR_OK) {
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
        $photo_path = $target_file;

        $stmt = $connect->prepare("UPDATE users SET photo = ? WHERE id = ?");
        $stmt->bind_param("si", $photo_path, $_SESSION["user_id"]);
        $stmt->execute();
    }

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error updating profile.";
    }

    $stmt->close();
    $connect->close();
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
    <link rel="stylesheet" href="css/menu.css" />
    <link rel="stylesheet" href="css/editprofile.css">
    <title>Dashboard | Authentication App | By David Carreño</title>
</head>

<body>
    <div class="container">
        <header>
            <div class="header-image">
                <img src="assets/devchallenges.svg" alt="devchangelles-logo">
            </div>

            <nav class="header-menu">

                <div class="menu-container">
                    <?php if (!empty($user["photo"])) { ?>
                    <a href="#"><img id="menu-img" src="<?php echo $user["photo"]; ?>" alt="user-image" width="32px"
                            height="32px" style="border-radius:8px ;"></a>
                    <?php } else { ?>
                    <a href="#"><img id="menu-img" src="assets/user-image.jpg" alt="user-image" width="32px"
                            height="32px" style="border-radius:8px ;"></a>
                    <?php } ?>

                    <ul class="options-list" id="options-list">
                        <li>
                            <a class="group" href="dashboard.php"><span class="material-symbols-outlined">
                                    account_circle </span>My
                                Profile</a>
                        </li>
                        <li>
                            <span class="material-symbols-outlined"> group </span>Group Chat
                        </li>
                        <div class="divider"></div>
                        <li>
                            <a class="logout" href="logout.php"><span class="material-symbols-outlined">
                                    logout
                                </span>Logout</a>
                        </li>
                    </ul>
                </div>

                <span class="menu-name"><?php echo $user["user_name"]; ?></span>
        </header>



        <div class="container2">
            <div class="back">
                <a href="dashboard.php" style="text-decoration: none;"><button class="back-button">
                        <span class="material-symbols-outlined back-arrow back-arrow ">
                            arrow_back_ios
                        </span>
                        <span class="back-text">Back</span>
                    </button></a>
            </div>
            <div class="profile-and-list-container">


                <section class="profile-section">
                    <h2 class="profile">Change Info</h2>
                    <p class="profile-text">Changes will be reflected to every sevices</p>
                </section>

                <form class="list-information-section" method="post" action="editprofile.php"
                    enctype="multipart/form-data">
                    <div class="list-item list-photo" style="display: flex; flex-direction: row; ">

                        <label for="input-file" class="label-photo" style="position: relative; ">
                            <span class="material-symbols-outlined camera" style="color: #FFFFFF; top: 20px; ">
                                add_a_photo
                            </span>
                            <?php if (!empty($user["photo"])) { ?>
                            <img src="<?php echo $user["photo"]; ?>" alt="user-photo"
                                style="width:72px; height: 72px; border-radius:8px; cursor: pointer; ">
                            <?php } else { ?>
                            <img src="assets/user-image.jpg" alt="user image"
                                style="width:72px; height: 72px; border-radius:8px; cursor: pointer; ">
                            <?php } ?>
                        </label>

                        <input type="file" name="photo" accept="image/*" id="input-file" style="display: none;">
                        <span class="photo-text">CHANGE PHOTO</span>
                    </div>



                    <div class="list-item list-name">
                        <span class="text-list">Name</span>
                        <input type="text" placeholder="Enter your name..." value="<?php echo $user["user_name"]; ?>"
                            name="name">
                    </div>

                    <div class="list-item list-bio">
                        <span class="text-list">Bio</span>
                        <input type="text" placeholder="Enter your bio..." class="textarea" name="bio"
                            value="<?php echo $user["bio"]; ?>">
                    </div>

                    <div class="list-item list-phone">
                        <span class="text-list">Phone</span>
                        <input type="text" placeholder="Enter your phone..." value="<?php echo $user["phone"]; ?>"
                            name="phone">
                    </div>

                    <div class="list-item list-email">
                        <span class="text-list">Email</span>
                        <input type="email" placeholder="Enter your email..." value="<?php echo $user["email"]; ?>"
                            name="email" required>
                    </div>

                    <div class="list-item list-password">
                        <span class="text-list">Password</span>
                        <input type="password" placeholder="Enter your password..." value="" name="password" required>
                    </div>

                    <input type="submit" value="Save" id="submit">
                </form>

            </div>

            <footer>
                <p>created by <span class="name">David Carreño</span></p>
                <p>devchallenges.io</p>
            </footer>

        </div>
    </div>
    <script src="scripts/index.js"></script>
</body>

</html>