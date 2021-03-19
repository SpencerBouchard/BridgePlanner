<!-- The PHP for this page was done by Aida Sultan (A00432414) -->

<!-- The HTML for this page was done by Celine Ayoub (A00423097)-->

<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit();
}
$DATABASE_HOST = '127.0.0.1';
$DATABASE_USER = 'group1';
$DATABASE_PASS = 'onceSLEEP29';
$DATABASE_NAME = 'group1';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT password, email FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
?>


<!-- This is the HTML for this page-->

<!DOCTYPE html>
<html>
<!-- metadata (data about data) information for this page -->
<head>
     <!-- This specifies the character encoding for the HTML document -->
    <meta charset="utf-8">
     <!-- This is the title of the page that shows up in the tab -->
    <title>Profile Page</title>
    <!-- This is the link for the css page that this HTML page uses -->
    <link href="profilePage.css" rel="stylesheet" type="text/css">
    <!-- This link is used to supply the icons used on this page -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>

<!-- The main content of the HTML document that will be visible on the webpage -->

<body>
    <!-- This button takes the user to the "menuPage" page when clicked on -->
    <button id="homeBtn" onclick="window.location='menuPage.php'"><i class="fas fa-home"></i>Home</button>
    <!-- This is the header of the profile page; telling the user where they are-->
    <h1>Bridge Profile Page</h1>
    <!-- This is sentence tells the user where they can find their username and email information -->
    <p>Your account details are below:</p>
    <!-- This is where the user sees what their username is. PHP is used here to get their information from the database -->
    <span class="label username">Username:  <?=$_SESSION['name']?></span>
    <!-- some break lines for spacing-->
    <br><br><br>
    <!-- This is where the user sees what their email is. PHP is used here to get their information from the database -->
    <span class="label email">Email: <?=$email?></span><br><br>
    <!-- This button logs the user out of the app and takes them to the "logoutPage" page when clicked on -->
    <button id="logoutBtn" onclick="window.location='logoutPage.php'"><i class="fas fa-sign-out-alt"></i>Logout</button>
        

</body>

</html>