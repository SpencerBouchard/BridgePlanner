<?php
/**
   Author: Kendrick Knowles (A00413277)
   * This code was intended to add games to the database when ever a user creates games

*/
//We start a session in the database to be able to access the information
session_start();
include_once 'authenticate.php';
// This is where your server information goes
$dbservername="127.0.0.1";
$dbusername = "group1";
$dbpassword = "onceSLEEP29";
$dbname = "group1";

$conn = mysqli_connect('$dbservername', '$dbusername', '$dbpassword', '$dbname');
//Selecting the information straight from the server at the part where 
$query = "SELECT NUM_PLAYERS FROM 'games' WHERE ID = (SELECT MAX(ID) FROM 'games')";
$query2 = "SELECT GAME_FULL FROM 'games' WHERE ID = (SELECT MAX(ID) FROM 'games')";
$query3 = "SELECT PLAYERS FROM 'games' WHERE ID = (SELECT MAX(ID) FROM 'games')";

$result = mysqli_query($conn, $query);

$data = mysqli_fetch_assoc($result);

$result2 = mysqli_query($conn, $query2);

$data2 = mysqli_fetch_assoc($result2);

$result3 = mysqli_query($conn, $query3);

$data3 = mysqli_fetch_assoc($result3);

if($data2 == 1){
    die("This game session is full, please create a new game.");
}
//This statement updates the names of players on this one game session if the 
//ammount of people is less than four. 
if($data < 4){
    $addedperson = _SESSION['name'];
    $players = $data3."".$addedperson;
    $data = $data++;
    $sql = "UPDATE 'games' SET PLAYERS = $players, NUM_PLAYERS = $data WHERE ID = (SELECT MAX(ID) FROM 'games')";
    $finresult = mysqli_query($conn, $sql) or die("couldnt execute query");
}
//If the ammount of persons in the game is less than four then we kill the 
//program and force them to start a new game.
else{
    $sql = "UPDATE 'games' SET GAME_FULL= 1 WHERE ID = (SELECT MAX(ID) FROM 'games')";
    $update = mysqli_query($conn, $sql);
    die("This game is now full, please create a new game.");
   
}
//if the person selects that they are bringing cards their username is added to 
//the table under bringing_cards
if(isset($_POST['bringingCards']) && $_POST['bringingCards'] == 'Yes'){
    $sql2 =  "INSERT INTO games(BRINGING_CARDS) WHERE ID = (SELECT MAX(ID) FROM 'games')"
        . "VALUES('$addedperson')";
    $result2 = mysqli_query($conn, $sql2);
}
