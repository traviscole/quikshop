var win = Titanium.UI.currentWindow;

var checkoutBtn = Ti.UI.createButton({
    title: 'View Cart',
    top: 250,
    "width":200,
    "height":40
});

var scanForms = require('scanForms');
var fields = [
	{ title:'Barcode', type:'text', id:'barcode' },
	{ title:'Quantity', type:'text', id:'quantity' },
	{ title:'Add to Cart', type:'submit', id:'scan' },
];

var scanForm = scanForms.createForm({
	style: scanForms.STYLE_LABEL,
	fields: fields
});

scanForm.addEventListener('scan', function(e) {
	Ti.API.debug(e);
});
win.add(scanForm);
 
checkoutBtn.addEventListener('click',function(){
	var w = Titanium.UI.createWindow({
        backgroundColor:'#336699',
        title:'Current Cart',
       	barColor:'black',
        url:'cart.js'
    });
    w.open({modal:true});
});

win.add(checkoutBtn);




// load the Scandit SDK module
var scanditsdk = require("com.mirasense.scanditsdk");
// disable the status bar for the camera view on the iphone and ipad
if(Ti.Platform.osname == 'iphone' || Ti.Platform.osname == 'ipad'){
        Titanium.UI.iPhone.statusBarHidden = true;
    }
var picker;
// Create a window to add the picker to and display it. 
var window = Titanium.UI.createWindow({  
        title:'Scandit SDK',
        navBarHidden:true
});
// Sets up the scanner and starts it in a new window.
var openScanner = function() {
    // Instantiate the Scandit SDK Barcode Picker view
    picker = scanditsdk.createView({
        width:"100%",
        height:"100%"
    });
    // Initialize the barcode picker, remember to paste your own app key here.
    picker.init("/4RAtLjAEeOJM4a9p0mp1ardS9kLcAer/xg3MtI+QrY", 0);
    picker.showSearchBar(true);
    // add a tool bar at the bottom of the scan view with a cancel button (iphone/ipad only)
    picker.showToolBar(true);
    // Set callback functions for when scanning succeedes and for when the 
    // scanning is canceled.
    picker.setSuccessCallback(function(e) {
//        alert("success (" + e.symbology + "): " + e.barcode);
		var values = {};
		values['cartId'] = Ti.App.Properties.getString('cartId');
		values['storeId'] = Ti.App.Properties.getString('storeId');
		values['barcode'] = e.barcode;
		values['quantity'] = "1";
										Ti.API.info(values);
		values = JSON.stringify(values);
										Ti.API.info(values);
			
		var xhr = Ti.Network.createHTTPClient({
    		onload: function() {	// handle the response
//    				var response = JSON.parse(this.responseText);
				var response = JSON.parse(this.responseText);
    									Ti.API.info("Response: " + response.status);
    									Ti.API.info("Response Reason: " + response.reason);
    									Ti.API.info("Item Name: " + response.itemName);
    			if(response.status == 'success'){
    				alert('Successfully Added: ' + response.itemName + ' Quantity Now: ' + response.quantityReturned);
    			}
    			else {
    				alert(response.reason);
    			}
    		}
		});
		Ti.API.info("Values: " + values);
		xhr.open('POST','http://www.quikshop.co/App/addToCart.php');
		xhr.send(values);

    });
    picker.setCancelCallback(function(e) {
        closeScanner();
    });
    window.add(picker);
    window.addEventListener('open', function(e) {
        // Adjust to the current orientation.
        // since window.orientation returns 'undefined' on ios devices 
        // we are using Ti.UI.orientation (which is deprecated and no longer 
        // working on Android devices.)
        if(Ti.Platform.osname == 'iphone' || Ti.Platform.osname == 'ipad'){
            picker.setOrientation(Ti.UI.orientation);
        }   
        else {
            picker.setOrientation(window.orientation);
        }
        
        picker.setSize(Ti.Platform.displayCaps.platformWidth, 
                       Ti.Platform.displayCaps.platformHeight);
        picker.startScanning();     // startScanning() has to be called after the window is opened. 
    });
    window.open();
};
// Stops the scanner, removes it from the window and closes the latter.
var closeScanner = function() {
    if (picker != null) {
        picker.stopScanning();
        window.remove(picker);
    }
    window.close();
};
// Changes the picker dimensions and the video feed orientation when the
// orientation of the device changes.
Ti.Gesture.addEventListener('orientationchange', function(e) {
    window.orientationModes = [Titanium.UI.PORTRAIT, Titanium.UI.UPSIDE_PORTRAIT, 
                   Titanium.UI.LANDSCAPE_LEFT, Titanium.UI.LANDSCAPE_RIGHT];
    if (picker != null) {
        picker.setOrientation(e.orientation);
        picker.setSize(Ti.Platform.displayCaps.platformWidth, 
                Ti.Platform.displayCaps.platformHeight);
        // You can also adjust the interface here if landscape should look
        // different than portrait.
    }
});
// create start scanner button
var button = Titanium.UI.createButton({
    "width":200,
    "height":40,
    top: 210,
    "title": "Start Scanner"
});
button.addEventListener('click', function() {
    openScanner();
});
win.add(button);
