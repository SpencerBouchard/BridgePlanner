<?php
/**
    Author : Rebbeca Heritt (A00421365) and Kendrick Knowles (A00413277)
    * This code is specifically linked to Margots desktop version but is not different from the createNewGameLaptop for the mobile version.
*/

//login info
session_start();
if(!isset($_SESSION['loggedin'])){
header('location: index.html');
exit();}

//database info
$servername = "127.0.0.1";
$username = "group1";
$password = "onceSLEEP29";
$dbname = "group1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// $sql = "CREATE TABLE gameTable (
// id INT(11) NOT NULL AUTO_INCREMENT,
// numPlrs INT(11) NOT NULL,
// player VARCHAR(255) NOT NULL,
// day VARCHAR(255) NOT NULL,
// gameTime VARCHAR(255) NOT NULL,
// location VARCHAR(255) NOT NULL,
// cards VARCHAR(255) NOT NULL,
// PRIMARY KEY (id)
// )";


//get information from fields on newGamesPages.html
$name = $_SESSION['name'];
$day = $_POST[day] . " " . $_POST[month] . " " . $_POST[year];
$gt = $_POST[hour] . ":" . $_POST[minute] . " " . $_POST[noon];
$numPlr = 1;
$deck;

if ($_POST[bringingCards] == "on") {
	$deck = "Yes";
} else {
	$deck = "No";
}
//insert information into gameTable on the MySQL database
$query = "INSERT INTO gameTable (numPlrs, player, day, gameTime, location, cards) VALUES ('$numPlr', '$name', '$day', '$gt', '$_POST[location]',
'$deck')";
$result = mysqli_query($conn,$query)
	or die ("Couldn't execute query."); 
header('Location: joinGamesPageLaptop.php');
//close the connection
$conn->close();

?>