document.getElementById("taskID").onclick=addTask();
function addTask() {
    input = document.getElementById("myInput").value;
    var ul = document.getElementById("myUL");
    var toAdd = document.createElement("li");
    toAdd.appendChild(document.createTextNode(input));
    ul.appendChild(toAdd);
    
    var span = document.createElement("span");
    var txt = document.createTextNode("\u00D7");
    span.className = "close";
    span.appendChild(txt);
    toAdd.appendChild(span);

    span.onclick = function() {
        this.parentElement.remove();
    }
};

function deleteTask() {
    var goodbye = this.parentElement;
    goodbye.remove();
}