
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>

	<title>Quikshop Mobile</title>   
	<link rel="stylesheet" href="https://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />  
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
  

</head>

<body>

</body>
</html>

<script>
//create a form
var f = document.createElement("form");
f.setAttribute('method',"post");
f.setAttribute('action',"submit.php");

//create input element
var i = document.createElement("input");
i.type = "text";
i.name = "user_name";
i.id = "user_name1";
i.placeholder = "name" ;

//create a checkbox
var c = document.createElement("input");
c.type = "checkbox";
c.id = "checkbox1";
c.name = "check1";

//create a button
var s = document.createElement("input");
s.type = "submit";
s.value = "Submit";

// add all elements to the form
f.appendChild(i);
f.appendChild(c);
f.appendChild(s);

// add the form inside the body
$("body").append(f);   //using jQuery or
document.getElementsByTagName('body')[0].appendChild(f); //pure javascript

</script>
