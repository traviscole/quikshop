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

var xhr = Ti.Network.createHTTPClient({
    onload: function() {	// handle the response
		var response = JSON.parse(this.responseText);
    	
    }
});
