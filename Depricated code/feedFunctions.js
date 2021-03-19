// Author: Spencer Bouchard (A00404180)

// This function is used to create the effect of a message being sent on 
// a server. This was used to help with our first demo before we had a fully
// functioning message app.
function send(){
    
    
    // Variable Declaration
    var li = document.createElement("li");
    var message = document.getElementById("msg").value;
    var t = document.createTextNode(message);
    var span = document.createElement("SPAN");
    var txt = document.createTextNode("\u00D7");
    var listElement = document.getElementById("myList");
    
    // Sets chat box to empty after message is sent
    document.getElementById("msg").value = "";
    
    li.appendChild(t);
    
    // If the chat box is not empty add the message to the box
    if(message !== ""){
        
        document.getElementById("myList").appendChild(li);
        linebreak = document.createElement("br");
        document.getElementById("myList").appendChild(linebreak);
        
        listElement.scrollTop = listElement.scrollHeight - listElement.clientHeight;
        
    }
    
    span.className = "close";
    span.appendChild(txt);
    li.appendChild(span);

    for (i = 0; i < close.length; i++) {
    close[i].onclick = function() {
        var div = this.parentElement;
        div.style.display = "none";
        }
    }
    
} // END send function
