<!-- HTML done by Celine Ayoub (A00423097)-->
<!-- Php done by Aida Sultan (A00432414)  -->


<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: indexPageLaptop.html');
	exit();


}


?>

<!DOCTYPE html>
<html>

<!-- metadata (data about data) information for this page -->
<head>
    <!-- This specifies the character encoding for the HTML document -->
    <meta charset="utf-8">
    <!-- This is the title of the page that shows up in the tab -->
    <title>Home Page</title>
    <!-- This link is used to supply the icons used on this page -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <!-- This is the link for the css page that this PHP page uses -->
    <link href="menuPageLaptop.css" rel="stylesheet" type="text/css">
   
</head>

<!-- The main content of the HTML document that will be visible on the webpage -->
<body>
         <!-- This div has the elements that apprear on the top bar of the page -->
        <div class= "top">
            <!-- This is the header of the menu page -->
            <h1>Bridge Messenger</h1>
            <!-- This button takes the user to the "profile" page when clicked on -->
            <a href="profilePageLaptop.php"><button class= "button profileBtn"><i class="fas fa-user-circle"></i>Profile</button></a>
            <!-- This button logs the user out of the app and takes them to the "logoutPage" page when clicked on -->
            <a href="logoutPageLaptop.php"><button class = "button logoutBtn"><i class="fas fa-sign-out-alt"></i>Logout</button></a>
        </div>
     <!-- This div has the elements that apprear after the top bar. It is where the user can choose what they would like to do in the app -->
    <div class="content">
        <!-- This header welcomes the user back by their username -->
        <h2>Welcome back, <?=$_SESSION['name']?>!</h2>
        <!-- This button takes the user to the group chat's feed page -->
        <button class="button button1" id="GC Button" onclick="window.location='feedPageLaptop.php';"> Group Chat </button>
        <!-- This button takes the user to the options page where the user can choose if they want to create a new game or see existing games -->
        <button class="button button2" id="Games Button" onclick="window.location='gamesOptionsPageLaptop.html';"> Games </button>
        <!-- This button takes the user to the notification page so the user and select the type of alerts they want -->
        <!-- <button class="button button3" id="Notif Button" onclick="window.location='notificationPageLaptop.html';"> Notifications</button> -->
    </div>
</body>

</html>

