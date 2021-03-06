$(function() {

	var formEl = $('#form-image-upload'),
		files;

	// Add events
	formEl.find('input[type=file]').on('change', prepareUpload);

	// Grab the files and set them to our variable
	function prepareUpload(event) {
		//console.log(123)
	  files = event.target.files;
	  //console.log(files)
	}

	formEl.on('submit', uploadFiles);

	// Catch the form submit and upload the files
	function uploadFiles(event) {
		event.stopPropagation(); // Stop stuff happening
	    event.preventDefault(); // Totally stop stuff happening

	    // START A LOADING SPINNER HERE

	    // Create a formdata object and add the files
	    var data = new FormData();
	    $.each(files, function(key, value) {
	        data.append(key, value);
	    });

	    $.ajax({
	        url: '/image/upload/',
	        type: 'POST',
	        data: data,
	        cache: false,
	        dataType: 'json',
	        processData: false, // Don't process the files
	        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
	        success: function(data, textStatus, jqXHR) {
	            if(!data.errors.length) {
	                // Success so call function to process the form
	                //console.log(data)
	                // data.files = files;
	                submitForm(event, data.data);
	            } else {
	                // Handle errors here
	                console.log('ERRORS: ' + data.errors);
	            }
	        },
	        error: function(jqXHR, textStatus, errorThrown) {
	            // Handle errors here
	            console.log('ERRORS: ' + textStatus);
	            // STOP LOADING SPINNER
	        }
	    });

		return false;
	}

	function submitForm(event, data) {
	  // Create a jQuery object from the form
	    $form = $(event.target);

	    // Serialize the form data
	    var formData = $form.serialize();

	    // You should sterilise the file names
	    // console.log(files)
	    // console.log(data.files)
	    
	    $.each(data.files, function(key, value) {
	    	$('.images-preview').append('<img src="/upload/images/'+ value +'" width="150" height="150">')
	        formData = formData + '&files[]=' + value;
	    });

	    $.ajax({
	        url: '/image/store',
	        type: 'POST',
	        data: formData,
	        cache: false,
	        dataType: 'json',
	        success: function(data, textStatus, jqXHR) {
	            if(typeof data.error === 'undefined') {
	                // Success so call function to process the form
	                console.log('SUCCESS: ' + data.success);
	            } else {
	                // Handle errors here
	                console.log('ERRORS: ' + data.error);
	            }
	        },
	        error: function(jqXHR, textStatus, errorThrown) {
	            // Handle errors here
	            console.log('ERRORS: ' + textStatus);
	        },
	        complete: function() {
	            // STOP LOADING SPINNER
	        }
	    });
	}
});