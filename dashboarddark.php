<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,300,1,0" />
    <link rel="icon" href="assets/devchallenges.png">
    <link rel="stylesheet" href="css/dashboarddark.css">
    <title>Dashboard | Authentication App | By David Carreño</title>
</head>

<body>
    <div class="container">
        <header>
            <div class="header-image">
                <img src="assets/devchallenges.svg" alt="devchangelles-logo">
            </div>

            <nav class="header-menu">

                <img src="assets/user-image.jpg" alt="user-image" width="32px" height="32px" style="border-radius:8px ;">
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
                        <button class="profile-button">Edit</button>
                    </div>
                </div>

                <section class="list-information-section">
                    <div class="list-item list-photo">
                        <span class="item-title">PHOTO</span>
                        <img src="assets/user-image.jpg" alt="user-image" width="72px" height="72px" style="border-radius: 8px;">
                    </div>



                    <div class="list-item list-name">
                        <span class="item-title">NAME</span>
                        <span class="item-text">Xanthe Neal</span>
                    </div>

                    <div class="list-item list-bio">
                        <span class="item-title">BIO</span>
                        <span class="item-text">I am a software developer...</span>
                    </div>

                    <div class="list-item list-email">
                        <span class="item-title">EMAIL</span>
                        <span class="item-text">xanthe.neal@gmail.com</span>
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