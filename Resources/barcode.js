var win = Titanium.UI.currentWindow;

var checkoutBtn = Ti.UI.createButton({
    title: 'View Cart',
    top: 300,
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

});

win.add(checkoutBtn);