window.addEventListener('load', function () { //adding new event listener
    "use strict";
 
    const URL = 'getOffers.php';			//linking to php file
	const fetch_data = function(){	
		
    fetch(URL)
    .then(
      function (response) {
		return response.json();
		} 
    )
    .then( 
	function (json) {
		document.getElementById("offers").innerHTML = "<h3>Title: <em>" + json.recordTitle + "</em></h3>";		//wrapping record fields in HTML 
		document.getElementById("offers").innerHTML += "<p>Description: <em>" + json.catDesc + "</em></p>";
		document.getElementById("offers").innerHTML += "<p>Price: <em>" + json.recordPrice + "</em></p>";
		}
    )
    .catch(
	function (err) {	//error handling
		console.log("Something went wrong!", err);
		}
    ); 
    // end of fetch request 
	};
	setInterval(fetch_data, 5000);	//data fetched every 5 seconds
	
});