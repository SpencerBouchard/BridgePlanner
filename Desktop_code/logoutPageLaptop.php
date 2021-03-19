<!-- This page was done by Celine Ayoub (A00423097) and Aida Sultan (A00432414)-->

<?php
session_start();
session_destroy();
// Redirect to the login page:
//header('Location: indexPageLaptop.html');
?>

<!DOCTYPE html>
<html>

<!-- metadata (data about data) information for this page -->
<head>
    <!-- This specifies the character encoding for the HTML document -->
    <meta charset="utf-8">
    <!--This is the title of the page that shows up in the tab-->
    <title>Logout Page</title>
    <!-- This is the link for the css page that this HTML page uses -->
    <link href="logoutPageLaptop.css" rel="stylesheet" type="text/css">

</head>

<!-- The main content of the HTML document that will be visible on the webpage -->

<body>
     <!-- This header indicates to the user that they have been logged out of the app -->
    <h1>You have been logged out</h1>
    <!-- Some break lines to add spacing in the page -->
    <br><br>
    <!-- If the user wants to log back in, this button will take them back to index.html so they can do so  -->
    <button class="button login" onclick="window.location='indexPageLaptop.html';">Click me to log back in!</button>
</body>

</html>