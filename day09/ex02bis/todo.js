var cookieKey = 0;

if (document.cookie && document.cookie != "") {
	var cookies = document.cookie.split(";");
	
	for (var i = 0; i < cookies.length; i++ ) {
		var task = cookies[i].split("=");
		cookieKey = parseInt(task[0]);
		$("#ft_list").prepend("<div id=\"" + cookieKey + "\" >" + task[1] + "</div>")
	}
}

$("document").ready(function() {
	$("button").click(addTodo);
	$("#ft_list").on("click", "div", delTodo);
})

function addTodo() {
	var task = prompt("Please enter a task!");

	if (task && task.trim() != "") {
		task = task.trim();
		cookieKey += (document.cookie) ? 1 : 0;
		document.cookie = cookieKey + "=" + task +  ";";
		$("#ft_list").prepend("<div id=\"" + cookieKey + "\" >" + task + "</div>")
	}
}

function delTodo() {
	if (confirm("You sure you want to delete this TODO?")) {
		key = $(this).attr("id");
		document.cookie = key + "=; expires= Thu, 01 Jan 1970 00:00:00 UTC;";
		$(this).remove();
	}
}
