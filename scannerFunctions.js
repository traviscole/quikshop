

$(document).ready(function() {

	

	$('form #response').hide();

	

	$('#submit').click(function(e) {

		

		// prevent forms default action until

		// error check has been performed

		e.preventDefault();

				

		// grab form field values

		var valid = '';

		var required = ' is required.';

		var barcode = $('form #barcode').val();
		
		var honeypot = $('form #honeypot').val();

		var humancheck = $('form #humancheck').val();

		

		// perform error checking

		if (barcode = '' || barcode.length <= 6) {

			valid = '<p>Your first name' + required +'</p>';	

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

			alert("the info " + formData);

			submitForm(formData);			

		}			

			

	});

}); 



// make our ajax request to the server

function submitForm(formData) {

	alert("before calling php " + formData);

	$.ajax({	

		type: 'POST',

		url: 'getItem.php',		

		data: formData,

		dataType: 'json',

		cache: false,

		timeout: 7000,

		success: function(data) { 			

			

			$('form #response').removeClass().addClass((data.error === true) ? 'error' : 'success')

						.html(data.msg).fadeIn('fast');	

						

			if ($('form #response').hasClass('success')) {
				

				promptFuntion(data);

				

				setTimeout("$('form #response').fadeOut('fast')", 50);

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

function promptFuntion( data)
{

var info = "Please put the quantity for " + data.name + " \n " + data.desc +  "\n " + data.brand + " \n $" + data.price;


var person=prompt( info);

if (person!=null)
  {
  	alert("thank you" + person);
  }
};

