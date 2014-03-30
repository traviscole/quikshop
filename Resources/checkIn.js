var label1 = Ti.UI.createLabel({
  color: '#FFF',
  font: { fontSize:48 },
  text: 'Please Check-In',
  textAlign: Ti.UI.TEXT_ALIGNMENT_CENTER,
  top: 30,
  width: Ti.UI.SIZE, height: Ti.UI.SIZE
});

var win = Titanium.UI.currentWindow;
win.add(label1);

var picker = Ti.UI.createPicker();
picker.selectionIndicator = true;

var data = [];
var pos;


var xhr = Ti.Network.createHTTPClient({
    onload: function() {	// handle the response
		var response = JSON.parse(this.responseText);
		Ti.API.info("Response: " + response);
		Ti.API.info("Response: " + response.length);
    	for (teller = 0; teller < response.length; teller++)
        {
            object = response[teller];
            data[teller] = Titanium.UI.createPickerRow({title: object.name});
        }
		picker.add(data);
		win.add(picker);
    }
});

var xhrPost = Ti.Network.createHTTPClient({
    onload: function() {	// handle the response
		var response = JSON.parse(this.responseText);
    	Ti.API.info("Response: " + response.status);
    	if(response.status == 'success'){
    		alert(respnse.storeId);
    	}
    	else {
    		alert(response.reason);
    	}
    }
});

var submitBtn = Ti.UI.createButton({
    title: 'Check In',
    top: 350,
});
 
submitBtn.addEventListener('click',function(){
	var values = {name:picker.getSelectedRow(0).title};
	values = JSON.stringify(values);
	Ti.API.info("Values: " + values);
	xhr.open('POST','http://www.quikshop.co/App/getStoreId.php');
	xhr.send(values);
});

win.add(submitBtn);

xhr.open("GET", 'http://www.quikshop.co/App/getStoreList.php');

xhr.send();
