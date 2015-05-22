<script>
function show_movie_details(button) {
    var hidden_info = button.parentElement.getElementsByClassName("more_detail");
	if (hidden_info[0].style.display == "none")
    {
		button.innerText = "hide_details";
        for(var i=0;i<hidden_info.length;i++)
        {
            hidden_info[i].style.display = "";
        }
	} else {
		button.innerText = "...show_more_details";
        for(var i=0;i<hidden_info.length;i++)
        {
            hidden_info[i].style.display = "none";
        }
	}
}
function change_content_div_height() {
	var content = document.getElementsByClassName("content")[0];
	var height = 0;
	for(var i = 0;i < content.children.length;i++)
	{
		var last_flow_div = content.children[i];
		if(height< (last_flow_div.offsetTop	+ last_flow_div.offsetHeight - content.offsetTop))
		{
			height = last_flow_div.offsetTop	+ last_flow_div.offsetHeight - content.offsetTop;
		}
	}
	content.style.height = height + "px";
}
function add_movie_block_tags(movie_block){
	movie_block.innerHTML += "<img class=\"poster\" onload=\"change_content_div_height()\" /> ";
	movie_block.innerHTML += "<br><h3 class=\"title\"></h3>";
	movie_block.innerHTML += "<img class=\"rating\" onload=\"change_content_div_height()\" />";
	movie_block.innerHTML += "<br><span class=\"summary\"></span>";
	movie_block.innerHTML += "<span class=\"more_detail\">";
	movie_block.innerHTML += "</span>";
	movie_block.innerHTML += "<br><a onclick=\"show_movie_details(this);change_content_div_height()\" class=\"show_movie_details\"></a>";
}
function fill_movie_block(movie_block,movie) {
	add_movie_block_tags(movie_block);
    movie_block.getElementsByClassName("poster")[0].src = movie.poster;
	movie_block.getElementsByClassName("title")[0].innerText = movie.title;
	movie_block.getElementsByClassName("rating")[0].src = movie.rating;
	movie_block.getElementsByClassName("summary")[0].innerText = movie.summary;
	for(var i=0;i<movie.description.length;i++)
	{
		movie_block.getElementsByClassName("more_detail")[0].innerHTML += "<p class=\"more_detail description\">" + movie.description[i] + "</p>";
	}
	var sessions = JSON.stringify(movie.sessions);
	sessions = sessions.replace(/{/g,'');
	sessions = sessions.replace(/}/g,'');
	sessions = sessions.replace(/"/g,'');
	sessions = sessions.replace(/,/g,"<br>");
	sessions = sessions.replace(/:/g,", ");
	movie_block.getElementsByClassName("more_detail")[0].innerHTML += "<span class=\"more_detail sessions\">" + sessions + "</span>";
}
function add_movie_block(movie){
    var movie_div = document.getElementsByClassName("content")[0];
    movie_div.innerHTML += "<div class=\"movie_block\" onresize=\"change_content_div_height()\"></div>";
    var movie_blocks = movie_div.getElementsByClassName("movie_block");
    fill_movie_block(movie_blocks[movie_blocks.length - 1],movie);
}
window.onload = function () {
	jQuery.post("http://<?php echo $_SERVER['SERVER_NAME']; ?>/~e54061/wp/movie-service.php",{},
	function(json){
		var movies = eval("("+json+")");
		for(var element in movies){
			add_movie_block(movies[element]);
		}
		var content = document.getElementsByClassName("content")[0];
		for (var i = 0; i < content.getElementsByClassName("movie_block").length;i++)
		{
			show_movie_details(content.getElementsByClassName("movie_block")[i].getElementsByClassName("show_movie_details")[0]);
		}
	})
}
window.onresize = function () {
	change_content_div_height();
}
</script>





























