var win = Titanium.UI.currentWindow;

var picker = Ti.UI.createPicker();

picker.selectionIndicator = true;

var data = [];
var tableData = [];
var pos;
var tableView = Titanium.UI.createTableView();


var xhr = Ti.Network.createHTTPClient({
    onload: function() {	// handle the response
		var response = JSON.parse(this.responseText);
		Ti.API.info("Response: " + response);
		Ti.API.info("Response: " + response.length);
    	for (teller = 0; teller < response.length; teller++)
        {
        	object = response[teller];
            var tR = Ti.UI.createTableViewRow({
        		text: ("Name: " + object.name + " Qty: " + object.quantity),
        		height: 'auto'
    		});
    		tableData.push(tR);
            
        }
		tableView.setData(tableData);
		win.add(tableView);
    }
});

var values = {cartId:Ti.App.Properties.getString('cartId')};
values = JSON.stringify(values);
Ti.API.info("Values: " + values);
xhr.open("POST", 'http://quikshop.co/App/getCart.php');

xhr.send(values);

