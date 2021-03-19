<!--
    This page was done by: Caleb Morrison (A00419023), 
    Contributor: Spencer Bouchard (A00404180).
      ** This code is specifically linked to Margots desktop version but is not different from the feedPage for the mobile version.
      * There might be some diffrences in the html and css file but both have same functionality
-->

<!DOCTYPE html>
<html>

<!-- metadata (data about data) information for this page -->
<head>
    <!-- This specifies the character encoding for the HTML document -->
    <meta charset="UTF-8">
    <!-- This is the link for the css page that this HTML page uses -->
    <link href="feedPage.css" rel="stylesheet" type="text/css">
    <!-- This is the link to the JQurery file that refreshes the page -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- This sets the width of the viewport to the width of the device.-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- This is the title of the page that shows up in the tab -->
    <title>Bridge Messenger</title>
</head>

<body class="loggedin">
    <!-- This div has the elements that apprear on the top bar of the page -->
    <nav class="navtop">
        <div>
            <a href="menuPage.php" id="homeBtn">Home</a>
            <h1 id="chatHeader">Bridge Chat</h1>
        </div>
    </nav>

    <!-- Defines chat windows titles and functions -->
    <div class="chat-window" id="myChat">
        <!-- This form is used to clear the input stream before another message is sent by using the PHP sendMessage.php -->
        <form action="sendMessage.php" method="post">
            <!-- This script is used to refresh the page every minute to display any new messages that may have been sent to the feed by another user-->
            <script>
                $(document).ready(function() {
                    setInterval(function() {
                        $("#chat").load("feed.php #chat", scroll() );
                    }, 60000);
                });
            </script>

            <div id="chat" class="chat" style="overflow-y: scroll;">

                <?Php
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

                // We need to use sessions, so you should always start sessions using the below code.
                session_start();
                // If the user is not logged in redirect to the login page...
                if (!isset($_SESSION['loggedin'])) {
                    header('Location: indexPageLaptop.html');
                    exit();
                }
                $r = mysqli_query($con, "SELECT * FROM messages ORDER BY id DESC");
                while ($row = mysqli_fetch_array($r)) {
                    if ($row['message'] != "") {
                        ?>
                        <div class="chatHeader">
                            <?Php
                                    echo $row['name'];
                                    echo " : ";
                                    echo $row['msgDate'];
                                    echo " ";
                                    echo "<br>";
                                    ?>
                        </div>
                        <div class="chatMessage">
                            <?Php
                                    echo $row['message'];
                                    ?>
                        </div>
                <?Php
                        echo "<br>";
                        echo "<br>";
                    }
                }

                $con->close();
                ?>
                
            </div>
            
            <!-- This is the send button. It sends the user's message to the feed when the user clicks it -->
            <input type="submit" value="Send" name="send">
            <!-- This is the text box and some of its properties-->
            <textarea placeholder="Write a message.." id="msg" name="msg" required maxlength=255></textarea>
        </form>
        
    </div>
   

</body>

</html>