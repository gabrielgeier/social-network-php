$(document).ready(function() {
    $(".rating").change(function(){
    	$.ajax({
            type: 'POST',
            url: '../back-end/submit_rating.php',
            data: {value: $('.the-value:checked').val()},
            dataType: 'html'
     	});
    });
});