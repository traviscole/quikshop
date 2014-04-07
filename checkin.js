$(document).ready(function() {

	

	$('form #response').hide();

	

	$('#submit').click(function(e) {

		

		// prevent forms default action until

		// error check has been performed

		e.preventDefault();

				

		// grab form field values

		var valid = '';

		var zipcode = $('form #zipcode').val();

		var honeypot = $('form #honeypot').val();

		var humancheck = $('form #humancheck').val();

		

		// perform error checking

		if (zipcode = '' || zipcode .length != 5) {

			valid = '<p>Please input a valid zipcode </p>';	

		}


		if (honeypot != 'http://') {

			valid += '<p>Spambots are not allowed.</p>';	

		}

		

		if (humancheck != '') {

			valid += '<p>A human user' + required + '</p>';	

		}

		

		// let the user know if there are erros with the form

		if (valid != '') {

			

			$('form #response').removeClass().addClass('error')

				.html('<strong>Please correct the errors below.</strong>' +valid).fadeIn('fast');			

		}

		// let the user know something is happening behind the scenes

		// serialize the form data and send to our ajax function

		else {

			

			$('form #response').removeClass().addClass('processing').html('Processing...').fadeIn('fast');										

			

			var formData = $('form').serialize();

			submitForm(formData);			

		}			

			

	});

}); 


function submitForm(formData) {

	

	$.ajax({	

		type: 'POST',

		url: 'checkout.php',		

		data: formData,

		dataType: 'json',

		cache: false,

		timeout: 7000,

		success: function(data) { 			

			

			$('form #response').removeClass().addClass((data.error === true) ? 'error' : 'success')

						.html(data.msg).fadeIn('fast');	

						

			if ($('form #response').hasClass('success')) {

				

				setTimeout("$('form #response').fadeOut('fast')", 5000);

			}

		

		},

		error: function(XMLHttpRequest, textStatus, errorThrown) {

						

			$('form #response').removeClass().addClass('error')

						.html('<p>There was an<strong> ' + errorThrown +

							  '</strong> error due to a<strong> ' + textStatus +

							  '</strong> condition.</p>').fadeIn('fast');			

		},				

		complete: function(XMLHttpRequest, status) { 			

			

			$('form')[0].reset();

		}

	});	

};
