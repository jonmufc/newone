$(document).ready(function(){
	
	$("#btn_search").click(function(){
		var key = $("#search").val();
		
		window.location = "index.php?key="+key;
	});
	
	$("#search").keypress(function(e) {
    if(e.which == 13) {
        var key = $(this).val();
		
		window.location = "index.php?key="+key;
    }
	});
	
});