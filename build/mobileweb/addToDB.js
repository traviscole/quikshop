Ti.UI.backgroundColor = '#336699';

var forms = require('addToDbForms');
var fields = [
	{ title:'Brand', type:'text', id:'brand' },
	{ title:'Name', type:'text', id:'name' },
	{ title:'Description', type:'email', id:'description' },
	{ title:'Add to Database', type:'submit', id:'submitItem' }
];

var win = Titanium.UI.currentWindow;
var form = forms.createForm({
	style: forms.STYLE_LABEL,
	fields: fields
});

form.addEventListener('submitItem', function(e) {
	Ti.API.debug(e);
});
win.add(form);

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







//SCANNER STUFF
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
		alert("Success, Please Post");
		Ti.App.Properties.setString('barcode', e.barcode);

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

