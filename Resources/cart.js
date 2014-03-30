var win = Titanium.UI.currentWindow;
var picker = Ti.UI.createPicker();
picker.selectionIndicator = true;

var data = [];
var pos;

var tableView = Ti.UI.createTableView({  
    backgroundColor: 'transparent',
    separatorStyle: Ti.UI.iPhone.TableViewSeparatorStyle.NONE,
    style: Ti.UI.iPhone.TableViewStyle.UNGROUPED
});

var xhr = Ti.Network.createHTTPClient({
    onload: function() {	// handle the response
		var response = JSON.parse(this.responseText);
		Ti.API.info("Response: " + response);
            for (var i=0; i<response.rows; i++){
                var row = Ti.UI.createTableViewRow({
                    height:30,
                    title:response[i].name
                });
 
            // apply rows to data array
            data.push(row);
 
            };
 
    // set data into tableView
    tableView.setData(data);
    }
});

xhr.open("POST", 'http://quikshop.co/App/getCart.php');

var values = {};
values['cartId'] = Ti.App.Properties.getString('cartId');
values = JSON.stringify(values);

xhr.send(values);