var cookieKey = 0;

if (document.cookie && document.cookie != "") {
	var cookies = document.cookie.split(";");
	
	for (var i = 0; i < cookies.length; i++ ) {
		var task = cookies[i].split("=");
		cookieKey = parseInt(task[0]);
		addDiv(task[1]);		
	}
}

function addTodo() {
	var task = prompt("Please enter a task!");
	
	if (task && task.trim() != "") {
		addTask(task.trim());
	}
}

function addTask(task) {
	if (document.cookie) {
		cookieKey++;
	}
	addCookies(task);
	addDiv(task);
}

function addCookies(taskName) {
	document.cookie = cookieKey + "=" + taskName +  ";";
}

function delCookie(key) {
	if (confirm("You sure you want to delete this TODO?")) {
		document.cookie = key + "=; expires= Thu, 01 Jan 1970 00:00:00 UTC;";
		console.log(key);
		delDiv(key);
	}
}

function delDiv(key) {
	var node = document.getElementById(key);
	node.parentNode.removeChild(node);
}

function addDiv(task) {
	var node = document.createElement("DIV");
	var textnode = document.createTextNode(task);

	node.append(textnode);
	node.setAttribute("id", cookieKey);
	node.setAttribute("onClick", "delCookie(" + cookieKey + ")")
	document.getElementById("ft_list").prepend(node);
}
