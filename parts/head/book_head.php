<script>

function calculate_total_price() {
    document.getElementById("total_price").value = 21;
    var ticket_table = document.getElementById("ticket_table");
    var total_price = parseFloat(0.0);
    for (var i = 1; i <= 8; i++) {
        total_price += parseFloat(ticket_table.rows[i].cells[2].getElementsByClassName("price")[0].innerText);
    }
    document.getElementById("total_price").value = 21;
    document.getElementById("total_price").value = "$" + total_price.toFixed(2);
}

function calculate_price() {
    var ticket_table = document.getElementById("ticket_table");
    var quantity = document.getElementsByClassName("ticket_quantity");
    var day = document.getElementById("day_selecter").value;
    var time_selecter = document.getElementById("time_selecter")
    var time = time_selecter.options[time_selecter.selectedIndex].text;
    if (day == "Monday" || day == "Tuesday"
        || (time == "1pm" && (day == "Wednesday" || day == "Thursday" || day == "Friday"))) {
        ticket_table.rows[1].cells[2].getElementsByClassName("price")[0].innerText = (quantity[0].value * 12).toFixed(2);
        ticket_table.rows[2].cells[2].getElementsByClassName("price")[0].innerText = (quantity[1].value * 10).toFixed(2);
        ticket_table.rows[3].cells[2].getElementsByClassName("price")[0].innerText = (quantity[2].value * 8).toFixed(2);
        ticket_table.rows[4].cells[2].getElementsByClassName("price")[0].innerText = (quantity[3].value * 25).toFixed(2);
        ticket_table.rows[5].cells[2].getElementsByClassName("price")[0].innerText = (quantity[4].value * 20).toFixed(2);
        ticket_table.rows[6].cells[2].getElementsByClassName("price")[0].innerText = (quantity[5].value * 20).toFixed(2);
        ticket_table.rows[7].cells[2].getElementsByClassName("price")[0].innerText = (quantity[6].value * 20).toFixed(2);
        ticket_table.rows[8].cells[2].getElementsByClassName("price")[0].innerText = (quantity[7].value * 20).toFixed(2);
    } else {
        ticket_table.rows[1].cells[2].getElementsByClassName("price")[0].innerText = (quantity[0].value * 18).toFixed(2);
        ticket_table.rows[2].cells[2].getElementsByClassName("price")[0].innerText = (quantity[1].value * 15).toFixed(2);
        ticket_table.rows[3].cells[2].getElementsByClassName("price")[0].innerText = (quantity[2].value * 12).toFixed(2);
        ticket_table.rows[4].cells[2].getElementsByClassName("price")[0].innerText = (quantity[3].value * 30).toFixed(2);
        ticket_table.rows[5].cells[2].getElementsByClassName("price")[0].innerText = (quantity[4].value * 25).toFixed(2);
        ticket_table.rows[6].cells[2].getElementsByClassName("price")[0].innerText = (quantity[5].value * 30).toFixed(2);
        ticket_table.rows[7].cells[2].getElementsByClassName("price")[0].innerText = (quantity[6].value * 30).toFixed(2);
        ticket_table.rows[8].cells[2].getElementsByClassName("price")[0].innerText = (quantity[7].value * 30).toFixed(2);
    }
    calculate_total_price();
}


var movies;
function change_time_selecter() {
	var time = movies[document.getElementById("movie_selecter").value].sessions[document.getElementById("day_selecter").value];
	document.getElementById("time_selecter").innerHTML = "<option value=\""+time+"\">"+time+"</option>";
}
function change_day_selecter() {
    var day_selecter = document.getElementById("day_selecter");
    day_selecter.options.length = 0;
    var movie_selecter = document.getElementById("movie_selecter");
	var sessions = movies[movie_selecter.value].sessions;
	for(var element in sessions){
		day_selecter.innerHTML += "<option value=\""+element+"\">"+element+"</option>";
	}
    change_time_selecter();
}
function change_movie_selecter() {
    jQuery.post("http://<?php echo $_SERVER['SERVER_NAME']; ?>/~e54061/wp/movie-service.php",{},
		function(json){
			movies = eval("("+json+")");
			var movie_selecter = document.getElementById("movie_selecter");
			for(var element in movies){
				movie_selecter.innerHTML += "<option value=\""+element+"\">"+movies[element].title+"</option>";
			}
			change_day_selecter();
	})
}/**/
window.onload = function () {
	change_movie_selecter();
}
</script>