<?php
/**
    Author : Aida Sultan (A00432414) and Caleb Morrison(A00419023)

    * This code is not working in our project because we couldnt have access to php mail in time. 
    * Purpose of this code is to send an activation code to the email provided while registering for the web app. Once the activation link it sent it activates the account and you can use your log in
    * As of now our app is not doing any kind of validation through email to register. 


*/

// This is where your server information goes
$DATABASE_HOST = '127.0.0.1';
$DATABASE_USER = 'group1';
$DATABASE_PASS = 'onceSLEEP29';
$DATABASE_NAME = 'group1';
// The following code trys to connect using the information above
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	// If there is an error with the connection, it stops and desplays the message below
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// This checkes wheather the email and the activation code exists.
if (isset($_GET['email'], $_GET['code'])) {
	if ($stmt = $con->prepare('SELECT * FROM accounts WHERE email = ? AND activation_code = ?')) {
		$stmt->bind_param('ss', $_GET['email'], $_GET['code']);
		$stmt->execute();
		// It it does we store the result so we can check if the account exists in the database.
		$stmt->store_result();
		if ($stmt->num_rows > 0) {
			// If the account exists with the requested email and code.
			if ($stmt = $con->prepare('UPDATE accounts SET activation_code = ? WHERE email = ? AND activation_code = ?')) {
				// This will set the new activation code to 'activated', this is how we can check if the user has activated their account.
				$newcode = 'activated';
				$stmt->bind_param('sss', $newcode, $_GET['email'], $_GET['code']);
				$stmt->execute();
				echo 'Your account is now activated, you can now login!<br><a href="index.html">Login</a>';
			}
		} else {
			//If we already used that email account for another user.
			echo 'The account is already activated or doesn\'t exist!';
		}
	}
}
?>