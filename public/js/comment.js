$(function() {

	$('.comment-form-show').on('click', function(e) {
		e.preventDefault();
		$('.comment-form-create').show();
		return false
	});

});