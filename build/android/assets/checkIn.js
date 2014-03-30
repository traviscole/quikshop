var xhr = Ti.Network.createHTTPClient({
    onload: function() {	// handle the response
		var response = JSON.parse(this.responseText);
    	Ti.API.info("Response: " + response.status);
    	Ti.API.info("Response Reason: " + response.reason);
    	if(response.status == 'success'){
    		alert('Data was inserted successfully!');
    	}
    	else {
    		alert(response.reason);
    	}
    }
});