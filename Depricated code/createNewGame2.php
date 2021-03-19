<?php
/**
   Author :  Kendrick Knowles (A00413277)
   * This is depricated code
*/
session_start();
if(!isset($_SESSION['loggedin'])){
header('location: index.html');
exit();}


$dbservername='127.0.0.1';
$dbusername = 'group1';
$dbpassword = 'onceSLEEP29';
$dbname = 'group1';

$conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);

$username = _SESSION['name'];
$loc = _POST['loc'];
$hour = _POST['hour'];
$minute = _POST['minute'];
$month = _POST['month'];
$day = _POST['day'];
$year = _POST['year'] + 2019;
$noon = _POST['noon'];
$numplayers = 1;


$sql = "INSERT INTO games(PLAYERS, LOCATION, NUM_PLAYERS, HOUR, MINUTE, MONTH, DAY, YEAR, NOON, bringing_cards) "
        . "VALUES('$username', '$loc', $numplayers, '$hour', '$minute', '$month', '$day', '$year', '$noon', " ")";
$result = mysqli_query($conn, $sql) or die("couldn't execute query");

if(isset($_POST['bringingCards']) && $_POST['bringingCards'] == 'Yes'){
    $sql2 =  "INSERT INTO games(BRINGING_CARDS) WHERE ID = (SELECT MAX(ID) FROM 'games')"
        . "VALUES('$username')";
    $result2 = mysqli_query($conn, $sql2);
}
header('location: joinGamesPage.html');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

