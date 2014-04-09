$(document).ready(function() {


    //this is to hide the div for the response
    $('form #response').hide();


    //this is called when the users clicks search
    $('#submit').click(function(e) {



        // prevent forms default action until

        // error check has been performed

        e.preventDefault();



        // grab form field values

        var valid = '';		//if there is an error this is filled out

        var zipcode = $('form #zipcode').val();	//gets the values from the form fields

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


    //this is called when the users clicks on Use current Location
    $('#location').click(function(e) {



        // prevent forms default action until

        // error check has been performed

        e.preventDefault();



        // grab form field values

        var valid = '';

        var honeypot = $('form #honeypot').val();

        var humancheck = $('form #humancheck').val();


        //this is to get the current location which calls ShowPosition
        if (navigator.geolocation)
        {
            var loc = navigator.geolocation.getCurrentPosition(showPosition);

        }
        else {
            valid +="Geolocation is not supported by this browser.";
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


    });



    //this is the function that gets the coordinatees
    function showPosition(position)
    {

        longitude = position.coords.longitude;
        latitude = position.coords.latitude;


        //this is for testing
        alert("Your current location:" + longitude + " , " + latitude);

        //shows the gif
        $('form #response').removeClass().addClass('processing').html('Processing...').fadeIn('fast');

        //changing the values of the forms so we can pass them
        var elem = document.getElementById("long");
        elem.value = longitude;

        var ele = document.getElementById("lat");
        ele.value = latitude;

        //serializing the values
        var formData = $('form').serialize();


        //calling the submit form passing the values
        submitForm(formData);
    }
});

function submitForm(formData) {

    //this is for testing
    alert("Your zipcode:" + formData );

    $.ajax( {

		type: 'POST',

		url: 'checkin.php',

		data: formData,

		dataType: 'json',

		cache: false,

		timeout: 7000,

		success: function(data) {



            $('form #response').removeClass().addClass((data.error === true) ? 'error' : 'success')

            .html(data.msg).fadeIn('fast');



            if ($('form #response').hasClass('success')) {



                setTimeout("$('form #response').fadeOut('fast')", 5000);


                openWin();

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

//this is to call the form containing the stores in that area
function openWin()
{
    var myWindow = window.open("https://quikshop.co","MsgWindow","width=200,height=100");
}



