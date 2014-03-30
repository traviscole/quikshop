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

var doneBtn = Ti.UI.createButton({
    title: 'Sumbit',
    top: 350,
});
	
	win.add(doneBtn);
 
doneBtn.addEventListener('click',function(){
	alert(picker.getSelectedRow(0).title);
});

xhr.open("GET", 'http://www.quikshop.co/App/getStoreList.php');
 // Send the request.
xhr.send();
