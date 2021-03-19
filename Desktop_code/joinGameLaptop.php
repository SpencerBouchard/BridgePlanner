<!-- Author: Rebecca Herritt A00421365 -->

<?php
//login info
session_start();
if(!isset($_SESSION['loggedin'])){
header('location: indexPageLaptop.html');
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

//delete game (remove row from table)
if(isset($_POST[delBtn])){
	$query = "DELETE FROM gameTable WHERE id=$_POST[delBtn]";
	$result = mysqli_query($conn,$query)
		or die ("Couldn't execute query.");
	header('Location: joinGamesPageLaptop.php');
}

//allow user to join game if they're not already listed or leave game if they're already in the game.
if(isset($_POST[joinLeave])){
	$query = "SELECT player FROM gameTable WHERE id=$_POST[joinLeave]";
	$result = mysqli_query($conn,$query)
		or die ("Couldn't execute query.");
	if($result-> num_rows > 0){
		while ($row = $result-> fetch_assoc()) {
			$players = explode(', ', $row['player']);
			//if currently logged in user is in the table, remove them
			if(in_array($_SESSION['name'], $players)){
				$key = array_search($_SESSION['name'], $players);
				unset($players[$key]);
				$plrNames = implode(", ", $players);
				$sql = "UPDATE gameTable SET player='$plrNames', numPlrs=numPlrs-1 WHERE id=$_POST[joinLeave]";
				$result2 = mysqli_query($conn,$sql)
					or die ("Couldn't execute query.");
				header('Location: joinGamesPageLaptop.php');
			}else{ //if currently logged in user is not in the table, add them
				$name = $_SESSION['name'];
				$query2 = "UPDATE gameTable SET player=concat(player, ', ', '$name'), numPlrs=numPlrs+1 WHERE id=$_POST[joinLeave]";
				$result2 = mysqli_query($conn,$query2)
					or die ("Couldn't execute query.");
			    header('Location: joinGamesPageLaptop.php');
			}
		}
	}
}

//allow other players to add or remove Yvonne.
if(isset($_POST[yvonne])){
	$query = "SELECT player FROM gameTable WHERE id=$_POST[yvonne]";
	$result = mysqli_query($conn,$query)
		or die ("Couldn't execute query.");
	if($result-> num_rows > 0){
		while ($row = $result-> fetch_assoc()) {
			$players = explode(', ', $row['player']);
			//if Yvonne is in the table, remove her
			if(in_array("Yvonne", $players)){
				$key = array_search("Yvonne", $players);
				unset($players[$key]);
				$plrNames = implode(", ", $players);
				$sql = "UPDATE gameTable SET player='$plrNames', numPlrs=numPlrs-1 WHERE id=$_POST[yvonne]";
				$result2 = mysqli_query($conn,$sql)
					or die ("Couldn't execute query.");
				header('Location: joinGamesPageLaptop.php');
			}else{ //if Yvonne is not in the table, add her
				$name = "Yvonne";
				$query2 = "UPDATE gameTable SET player=concat(player, ', ', '$name'), numPlrs=numPlrs+1 WHERE id=$_POST[yvonne]";
				$result2 = mysqli_query($conn,$query2)
					or die ("Couldn't execute query.");
			    header('Location: joinGamesPageLaptop.php');
			}
		}
	}
}

?>