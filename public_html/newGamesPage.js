/**
   Author: Patrick Melanson (A00420577)
   This page is used to echo an alert to the user of what game they've scheduled,
   along with the date, time, location, and card situation.
   Furthermore, it ought to check if the game they entered was "legal", in the sense that
   we don't want anyone scheduling a game on February 31st, for example. This, however, did
   not happen, as other things became a priority.
*/

function checkIfGood() {
	
	
	//Variables
	var day = document.getElementById("day").options[document.getElementById("day").selectedIndex].value;
	var month = document.getElementById("month").options[document.getElementById("month").selectedIndex].value;
	var d = document.getElementById("year").options[document.getElementById("year").selectedIndex].value; //This is a lot to write
	var year = properYear(); //Formats the year properly
    var hour = document.getElementById("hour").options[document.getElementById("hour").selectedIndex].value;
	var minute = document.getElementById("minute").options[document.getElementById("minute").selectedIndex].value;
	var noon = document.getElementById("noon").options[document.getElementById("noon").selectedIndex].value;
    var loc = document.getElementById("location").options[document.getElementById("location").selectedIndex].value;
    var cardStatus = document.getElementById("cardStatus").checked;

	//Makes sure the date is proper, and then echos back the info to the user
	if (properDate()) {
			window.location  = 'joinNewGame.html';
			alert(xmas() + //:)
				"Bridge Game Information\n" +
				"Time of game: " + hour + ":" + minute + " " + noon + "\n" +
				"Date: " + month + " " + day + dateEnd() + " " + year + "\n" + 
				"Location: " + loc + "\n" +
				"You are " + responsibility() + "bringing the cards" + "\n");
				
				//Opens window where the info they added will be stored and viewable
				
				
	}
	//If the date is invalid, doesn't let the user continue
	else {
		alert("Invalid Date");
		location.reload();
		
	}

//Checks to see if the user is going to bring the cards
function responsibility() {
        if (cardStatus) {
            return "";
        } else {
            return "NOT ";
        }
    }

//Puts the proper declaration at the end of the day for the date
function dateEnd(){
	if(day == "1" || day == "21" || day == "31")
		return "st";
	else if(day == "2" || day == "22")
		return "nd";
	else if(day == "3" || day == "23")
		return "rd";
	else
		return "th";
}

//Automatically updates the year (so now you only need to change the HTML)
function properYear(){
	var b = new Date().getFullYear();
	
	//If they choose the current year, adds nothing
	if (d == "1")
		return b;
	
	//If they choose the next year, add 1 to the current year
	else if (d == "2")
		return ++b;

	//If they choose two years from now, add 2 to the current year
	else
		b = b + 2;
		return b;
		
	//As you can see, this is pretty easy to scale, though a little cumbersome
}

//Function that actually checks if the date is legal (ie isn't February 30th)
function properDate(){
	if(((month == "April" || month == "June" || month == "September" || month == "November") && day == "31") 
		|| (month == "February" && (day == "30" || day == "31" || (day == "29" && !(isLeapYear())))))
		return false;
	else
		return true;
}

//Check if the year is a leap year
function isLeapYear(){
	//Get the numerical value of the current year
	var y = parseInt(year);

	//Leap year rules
	if (y%4 != 0)
		return false;
	else if (y%100 != 0)
		return true;
	else if (y%400 != 0)
		return false;
	else
		return true;
}

//Just feeling a little festive, if you delete this, just delete the xmas function from the alert box (line 22 if nothings been changed)
//Only cosmetic, doesn't affect anything
function xmas(){
		if(month == "December" && day == "25")
			return "Merry Christmas!\n";
		else
			return "";
}
}