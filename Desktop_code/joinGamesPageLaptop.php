<!-- Authors: Celine Ayoub A00423097 and Rebecca Herritt A00421365 -->

<!DOCTYPE html>
<html>

<head>
    <!This is the title of the page that shows up in the tab>
    <title>Games Page</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <!This is the css link for this HTML page>
    <link href="joinGamesPageLaptop.css" rel="stylesheet" type="text/css">
</head>

<!This is the back button that takes the user back to the previous page>
<button class="button backBtn" id="backBtn" onClick="window.location='gamesOptionsPageLaptop.html'">Back</button>

<!This is the title of the page that shows up on the page>
<h1>Here are the available games</h1><br><br>

<body onload="return randColour()">
    <button id="upBtn" onclick="scrollWin(0, -75)"><i class="fas fa-arrow-up"></i><br>Up</button><br>
    <button id="downBtn" onclick="scrollWin(0, 75)">Down<br><i class="fas fa-arrow-down"></i></button>
            <?php

                //start session and confirm current user is logged in
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

                //get id's from table
                $query = "SELECT id FROM gameTable";
                $result = $conn-> query($query);

                //generate information for each row in game table
                if ($result-> num_rows > 0) {
                    while ($row = $result-> fetch_assoc()) {
                        //get time, location, and date!
                        $sql =  "SELECT location FROM gameTable WHERE id=$row[id]";
                        $sql2 = "SELECT day FROM gameTable WHERE id=$row[id]";
                        $sql3 = "SELECT gameTime FROM gameTable WHERE id=$row[id]";
                        $sql4 = "SELECT cards FROM gameTable WHERE id=$row[id]";
                        $result3 = $conn-> query($sql);
                        $result4 = $conn-> query($sql2);
                        $result5 = $conn-> query($sql3);
                        $result6 = $conn-> query($sql4);

                        //store results into variables
                        $loc = $result3-> fetch_assoc();
                        $date = $result4-> fetch_assoc();
                        $gt = $result5-> fetch_assoc();
                        $cards = $result6-> fetch_assoc();

                        //get names of players from row with the current id
                        $query2 = "SELECT player FROM gameTable WHERE id=$row[id]";
                        $result2 = $conn-> query($query2);

                        if ($result2-> num_rows > 0) {
                            while ($row2 = $result2-> fetch_assoc()) {
                                echo "<div class=\"aGame\">";
                                echo "<form action=\"joinGameLaptop.php\" method=\"post\">";
                                //delete game button
                                echo "<button class=\"button deleteGameBtn\" name=\"delBtn\" value= \"" . $row[id] . "\" onclick=\"return confirm('Want to delete?')\">Delete Game</button>";
                                echo "<span class=\"label gameNum\"><center>Game</center></span>";
                                echo "<span class=\"label gameLocation\">Location: " . $loc['location'] . "</span><br>";
                                echo "<span class=\"label gameDate\">Date: " . $date['day'] . "</span><br>";
                                echo "<span class=\"label gameTime\">Time: " . $gt['gameTime'] .  "</span><br>";
                                echo "<span class=\"label gameTime\">Bringing Cards?: " . $cards['cards'] .  "</span><br><br>";
                                echo "<table>";
                                echo "<tr>";
                                echo "<th>Players Currently in Game</th>";
                                echo " </tr>";

                                //table of players currently in game
                                $players = explode(', ', $row2['player']);
                                echo "<tr><td>" . $players[0] . "</td></tr>";
                                echo "<tr><td>" . $players[1] . "</td></tr>";
                                echo "<tr><td>" . $players[2] . "</td></tr>";
                                echo "<tr><td>" . $players[3] . "</td></tr>";
                                echo "<tr><td>" . $players[4] . "</td></tr>";
                                echo "<tr><td>" . $players[5] . "</td></tr>";
                                echo "<tr><td>" . $players[6] . "</td></tr>";
                                echo "<tr><td>" . $players[7] . "</td></tr>";
                            }
                            echo "</table>";
                        }else{
                            echo "No results";
                        }

                        echo "<br><br><br>";

                        //$btnName;
                        $btnLabel;
                        $yvonneLabel;
                        if(in_array($_SESSION['name'], $players)) {
                            $btnLabel = "Leave Game";
                        }else{
                            $btnLabel = "Join Game";
                        }

                        if(in_array("Yvonne", $players)) {
                            $yvonneLabel = "Remove Yvonne";
                        }else{
                            $yvonneLabel = "Add Yvonne";
                        }
                        //join/leave game button
                        echo "<button class=\"button joinGameBtn\" type=\"submit\" name=\"joinLeave\" value= \"" . $row[id] . "\">" . $btnLabel . "</button>";
                        //Add/remove Yvonne button
                        echo "<button class=\"button addYvonneBtn\" type=\"submit\" name=\"yvonne\" value=\"" . $row[id] . "\">" . $yvonneLabel . "</button>";
                        echo "<br><br><br>";

                        echo "</form>";
                        echo "</div>";
                        echo "<br><br><br>";

                    }
                } else {
                    echo "<span class=\"label gameLocation\">No Games</span><br>";
                } 
                $conn-> close();
            ?>
    <!-- Randomize background colour for each game -->
    <script>
        var colours = ['orange', 'limegreen', '#f3ce28', 'lightskyblue', 'turquoise', 'plum', 'pink', 'lightcoral', 'slateblue'];
        var divs = document.getElementsByClassName("aGame");

        function randColour() {
            var i;
            for (i = 0; i < divs.length; i++) {
                var newColor = Math.floor(Math.random()*colours.length)
                divs[i].style.backgroundColor = colours[newColor];
            }
        }
    </script>
</body>

</html>