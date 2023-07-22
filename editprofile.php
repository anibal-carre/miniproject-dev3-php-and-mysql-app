<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
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

                <a href="logout.php"><img src="assets/user-image.jpg" alt="user-image" width="32px" height="32px"
                        style="border-radius:8px ;"></a>
            </nav>
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

                <form class="list-information-section">
                    <div class="list-item list-photo">
                        <span class="material-symbols-outlined camera" style="color: #FFFFFF;">
                            add_a_photo
                        </span>
                        <img src="assets/user-image.jpg" alt="user-photo"
                            style="width:72px; height: 72px; border-radius:8px;">
                        <span class="photo-text">CHANGE PHOTO</span>
                    </div>



                    <div class="list-item list-name">
                        <span class="text-list">Name</span>
                        <input type="text" placeholder="Enter your name...">
                    </div>

                    <div class="list-item list-bio">
                        <span class="text-list">Bio</span>
                        <textarea type="text" placeholder="Enter your bio..." class="textarea"></textarea>
                    </div>

                    <div class="list-item list-phone">
                        <span class="text-list">Phone</span>
                        <input type="text" placeholder="Enter your phone...">
                    </div>

                    <div class="list-item list-email">
                        <span class="text-list">Email</span>
                        <input type="email" placeholder="Enter your email...">
                    </div>

                    <div class="list-item list-password">
                        <span class="text-list">Password</span>
                        <input type="password" placeholder="Enter your password...">
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
</body>

</html>