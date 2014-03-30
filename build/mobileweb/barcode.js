var win = Titanium.UI.currentWindow;

var checkoutBtn = Ti.UI.createButton({
    title: 'View Cart',
    top: 240,
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