Ti.UI.backgroundColor = '#336699';

var forms = require('createAcctForms');
var fields = [
	{ title:'First Name', type:'text', id:'fName' },
	{ title:'Last Name', type:'text', id:'lName' },
	{ title:'Email', type:'email', id:'email' },
	{ title:'Address', type:'text', id:'address' },
	{ title:'City', type:'text', id:'city' },
	{ title:'State', type:'text', id:'state' },
	{ title:'Zip Code', type:'number', id:'zip' },
	{ title:'Password', type:'password', id:'password' },
	{ title:'Submit', type:'submit', id:'registerUser' }
];

var win = Titanium.UI.currentWindow;
var form = forms.createForm({
	style: forms.STYLE_LABEL,
	fields: fields
});

form.addEventListener('registerUser', function(e) {
	Ti.API.debug(e);
});
win.add(form);

