<?Php
/**
    Author : Rebbeca Herritt (A00421365) with the help of Simon

*/
//connection info
$DATABASE_HOST = '127.0.0.1';
$DATABASE_USER = 'group1';
$DATABASE_PASS = 'onceSLEEP29';
$DATABASE_NAME = 'group1';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    // If there is an error with the connection, stop the script and display the error.
    die('Failed to connect to MySQL: ' . mysqli_connect_error());
}
session_start();
$timestamp = date('M, d @ h:ia');
$name = $_SESSION['name'];
if (empty($_POST[msg])) { } else {

    $query = "INSERT INTO messages (name, message, msgDate) VALUES ('$name', '$_POST[msg]', '$timestamp')";
    //if (isset(S_POST['send'])){
    $result = mysqli_query($con, $query)
        or die("Couldn't execute query.");
}
$_POST = array();
header("location: feedPageLaptop.php");

$con->close();
