var key = 0;

$("document").ready(function() {
	getData();
	$("button").click(addTodo);
	$("#ft_list").on("click", "div", delTodo);
})

function getData() {
	$.ajax({
		url:"select.php",
		type: "GET",
		dataType: "text",
		success: displayFn,
	})
}

function displayFn(result) {
	var toDoList = JSON.parse(result);
	for (var i = 0; i < toDoList.length; i++) {
		var task = toDoList[i].split(";");
		if (task == "")
			continue;
		key = parseInt(task[0]);
		$("#ft_list").prepend("<div id=\"" + key + "\" >" + task[1] + "</div>")
	}
}

function addTodo() {
	var task = prompt("Please enter a task!");

	if (task && task.trim() != "") {
		task = task.trim();
		key++;
		$.ajax({
			url: "insert.php",
			type: "POST",
			data: {
				id: key,
				value: task
			},
			success: function() {
				$("#ft_list").prepend("<div id=\"" + key + "\" >" + task + "</div>")
			},
			error: function() {
				alert("error saving ToDo");
			}
		})
	}
}

function delTodo() {
	if (confirm("You sure you want to delete this TODO?")) {
		key = $(this).attr("id");
		$.ajax({
			url:"delete.php?key=" + key,
			type: "GET"
		})
		$(this).remove();	
	}
}

