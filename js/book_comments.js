
	$(document).ready(function() {
	    $("#show").click(function(){
	    	$("#reload-div").css("display", "block");
	    	$("#show").css("display", "none");
	    	$("#unshow").css("display", "block");
	    	$("#comments").css("display", "block");
	    	$("#comments").load("../back-end/show_comments.php");
	    });
	});

	$(document).ready(function() {
	    $("#unshow").click(function(){
	    	$("#show").css("display", "block");
	    	$("#unshow").css("display", "none");
	    	$("#reload-div").css("display", "none");
	    	$("#comments").empty();
	    	$("#comments").css("display", "none");
	    	$("#reload-div").css("display", "none");
	    });
	});

	$(document).ready(function() {
	    $("#reload").click(function(){
	    	$("#comments").load("../back-end/show_comments.php");
	    });
	});

	$(document).ready(function() {
	    $("form").submit(function(event){
			event.preventDefault();
			var body = $("#comment").val();  
			$(".form-message").load("../back-end/submit_comment.php", {body:body});
			$("#comments").load("../back-end/show_comments.php");
			$("#show").click();
	    });
	});

	setInterval(function(){
      $("#reload").click();
 	},3000);

 	function deleteComment(value) {
 		if (confirm('Tem certeza que deseja excluir o comentário?')){
 			var id = value;
	        $.ajax({
	            type: 'POST',
	            url: '../back-end/delete_comment.php',
	            data: {id: id},
	            dataType: 'html'
	        });
	        $("#reload").click();	
 		}
    }