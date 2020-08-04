$(document).ready(function() {
    $("#form").submit(function(event){
		event.preventDefault();
		var filter = $("#filter").val();
		var period = $("#period").val();  
		var limit = $("#limit").val();
		var order = $("#order").val();
		var orderby = $("#orderby").val();
		$("#ranking-results-books").load("../back-end/ranking_books_show.php", {filter:filter, period:period, limit:limit, order:order, orderby:orderby});
    });
});