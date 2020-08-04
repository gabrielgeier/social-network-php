function deletePost(value){
	if (confirm('Tem certeza que deseja excluir seu post?')){
		var id = value;
	    $.ajax({
	        type: 'POST',
	        url: '../back-end/delete_post.php',
	        data: {id: id},
	        dataType: 'html'
	    });
	    setInterval(function(){
      		var toURL = "index.php?user_feed&".concat(id);
	    	window.location.href = toURL;
 		},500);
	}
}