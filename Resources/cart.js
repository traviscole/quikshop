// Create variable "win" to refer to current window
var win = Titanium.UI.currentWindow;
var MyID = win.MyID;
//Ti.API.info(MyID);
win.title = 'Select Unit';

// Function loadUnits()
function loadUnits()
{
	// Empty array "rowData" for our tableview
	var rowData = [];
	// Create our HTTP Client and name it "loader"
	var loader = Titanium.Network.createHTTPClient();
	// Sets the HTTP request method, and the URL to get data from
	loader.open("GET","https://s3.amazonaws.com/travistestjson/homes.json");

	//Create an array to hold the communities name
	var units = [];

	// Runs the function when the data is ready for us to process	
	
	loader.onload = function() 
	{
	var rowNumber = 0;
		var props = eval('('+this.responseText+')');
		for (var i = 0; i < props.length; i++)
		{
			if(props[i].community == MyID) {
				units[rowNumber] = props[i].address; // The community name	
				rowNumber++
			}
		}	
		
		units.sort();
		
		for (var w = 0; w < units.length; w++)
		{		
			// Create a row and set its height to auto
			var row = Titanium.UI.createTableViewRow({
//				height:'auto',
				hasChild:true,
				test:'../Resources/homeInfo.js',
				text:units[w],
			});				

			// Create the view that will contain the data
			var post_view = Titanium.UI.createView({
				height:'auto', 
				layout:'vertical',
				top:5,
				right:5,
				bottom:5,
				left:5
			});
			var unitLbl = Titanium.UI.createLabel({
				text:units[w],
				left:5,
				top:0,
				bottom:0,
				height:'auto',
				width:236,
			});

			post_view.add(unitLbl);
			
			// Add the post view to the row
			row.add(post_view);

			// Give each row a class name
			row.className = "item"+i;
			// Add row to the rowData array
			rowData[w] = row;
		}

		// Create the table view and set its data source to "rowData" array
		var tableView = Titanium.UI.createTableView({
			data:rowData,
			style:Titanium.UI.iPhone.TableViewStyle.GROUPED,
		});
		//Add the table view to the window
		win.add(tableView);
		
		//Event Listener for each tab
		tableView.addEventListener('click', function(e)
		{
			if (e.rowData.test)
			{
				var win2 = Titanium.UI.createWindow({
				url:e.rowData.test,
				title:e.rowData.title,
			    MyID: e.rowData.text,
			});
			win2.backButtonTitle='Back';
			Titanium.UI.currentTab.open(win2,{animated:true});
		}
		});
	};
	
	
	// Send the HTTP request
	loader.send();
}
loadUnits();