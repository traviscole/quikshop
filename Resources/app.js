var main = Titanium.UI.createWindow({
    backgroundColor:'#336699',
    title:'QuikShop'
});
var loginForms = require('loginForms');
var fields = [
	{ title:'Username', type:'text', id:'username' },
	{ title:'Password', type:'password', id:'password' },
	{ title:'Login', type:'submit', id:'login' }
];

var loginForm = loginForms.createForm({
	style: loginForms.STYLE_LABEL,
	fields: fields
});

loginForm.addEventListener('login', function(e) {
	Ti.API.debug(e);
});
main.add(loginForm);

var b3 = Titanium.UI.createButton({
    title:'Create an Account',
    width:230,
    height:40,
    top:210
});
main.add(b3);
 
var b4 = Titanium.UI.createButton({
    title:'Add to Database',
    width:2800,
    height:40,
    top:210
});
main.add(b4);

b3.addEventListener('click', function()
{
    var w = Titanium.UI.createWindow({
        backgroundColor:'#336699',
        title:'Create an Account',
        barColor:'black',
        url:'createAcct.js'
    });
 
    w.open({modal:true});
});

b4.addEventListener('click', function()
{
    var w = Titanium.UI.createWindow({
        backgroundColor:'#336699',
        title:'Add to Database',
        barColor:'black',
        url:'addToDB.js'
    });
 
    w.open({modal:true});
});
 
main.open();