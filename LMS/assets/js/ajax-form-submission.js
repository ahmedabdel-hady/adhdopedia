// ajax form plugin calls at each modal loading,
$(document).ready(function() { 
	
	// configuration for ajax form submission
	var options = { 
		beforeSubmit		:	validate,  
		success				:	showResponse,  
		resetForm			:	true 
	}; 
	
	// binding the form for ajax submission
	$('.ajax-submit').submit(function() { 
		$(this).ajaxSubmit(options); 
		
		// prevents normal form submission
		return false; 
	}); 
}); 

// form validation
function validate(formData, jqForm, options) { 
	
	if (!jqForm[0].name.value)
	{
			return false;
	}
	// sends ajax request after passing validation, showing a user-friendly preloader
	$('#preloader-form').html('<img src="assets/images/preloader.gif" style="height:15px;margin-left:20px;" />');
	
	// disables intermediatory form submission
	document.getElementById("submit-button").disabled=true;
}

// ajax success response after form submission, post_refresh_url is sent from modal body
function showResponse(responseText, statusText, xhr, $form)  { 
	
	// hides the preloader
	//$('#preloader-form').html('');
	
	// showing success message 
	toastr.success(post_message, "Success");
	
	// hides modal that holds the form
	$('#modal_ajax').modal('hide');
	
	// reload table data after data update
	reload_data(post_refresh_url);
}



/*-----------------custom functions for ajax post data handling--------------------*/



// custom function for reloading table data
function reload_data(url)
{
	$('div.main_data').block({ message: '<img src="assets/images/preloader.gif" style="height:25px;" />' }); 
	$.ajax({
		url: url,
		success: function(response)
		{
			jQuery('.main_data').html(response);
			$('div.main_data').unblock(); 
		}
	});
}



// custom function for data deletion by ajax and post refreshing call
function delete_data(delete_url , post_refresh_url)
{
	// showing user-friendly pre-loader image
	$('#preloader-delete').html('<img src="assets/images/preloader.gif" style="height:15px;margin-top:-10px;" />');
	
	// disables the delete and cancel button during deletion ajax request
	document.getElementById("delete_link").disabled=true;
	document.getElementById("delete_cancel_link").disabled=true;
	
	$.ajax({
		url: delete_url,
		success: function(response)
		{
			// remove the preloader 
			$('#preloader-delete').html('');
			
			// show deletion success msg.
			toastr.info("Data deleted successfully.", "Success");
			
			// hide the delete dialog box
			$('#modal_delete').modal('hide');
			
			// enables the delete and cancel button after deletion ajax request success
			document.getElementById("delete_link").disabled=false;
			document.getElementById("delete_cancel_link").disabled=false;
	
			// reload the table
			reload_data(post_refresh_url);
		}
	});
}