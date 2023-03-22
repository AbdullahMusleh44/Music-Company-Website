const OrderForm = document.getElementById('orderForm');


//Terms and conditions 
OrderForm.addEventListener("click", termsAndConditions); //adding event listener

function termsAndConditions() {
	const terms = document.getElementById('termsText'); //getting the termsText paragraph
	var forenameEmpty = document.forms["orderForm"]["forename"].value; //value of forename
	var surnameEmpty = document.forms["orderForm"]["surname"].value;	//value of surname
	
	if (orderForm.termsChkbx.checked == true &&  forenameEmpty !== "" && surnameEmpty !== "")  // if the checkbox is checked, and forename surname not empty
	{
		terms.setAttribute("style", "color: black; font-weight: none"); //Black text no font weight
		document.getElementsByName("submit")[0].disabled = false; //enabling order button
		
	} else {
		terms.style = "color: #FF0000; font-weight: bold"; //red bold text
		document.getElementsByName("submit")[0].disabled = true; //disabling the order button
	}
}


//Calculating price 
let TotalPrice = 0;
let ShippingCost = 0;

orderForm.addEventListener("change", getTotal); //adding event listener

function getTotal() {
	TotalPrice = 0;
	const records = OrderForm.querySelectorAll('span.chosen'); //getting the records
	const numberOfRecords = records.length; //number of records
	
	for (let i=0; i < numberOfRecords; i++) //loop through number of records
	{
		const record = records[i];
		const recordCheckbox = record.querySelector('input[data-price][type=checkbox]'); 
		
			if (recordCheckbox.checked) //if the checkbox has been clicked
			{
				TotalPrice += parseFloat(recordCheckbox.dataset.price); //add price of record to total
			}
		
	}
	
	//Collection
	const collection = document.getElementById('collection');
	ShippingCost = 0;
	const ships = collection.querySelectorAll('p')[1].getElementsByTagName('input'); //gets the elements with the tag input
	const numberOfShipments = ships.length; //number of collection methods
	
	for (let i=0; i < numberOfShipments; i++) //loop through collection methods
	{
		const ship = ships[i];
		if (ship.checked) //if collection method is chosen
		{
			ShippingCost += parseFloat(ship.dataset.price); //add price of the collection method chosen
		}
		
		//Overall price
		let overall = 0;
		overall += parseFloat(TotalPrice) + parseFloat(ShippingCost) ; //price of chosen records + price of collection type
		orderForm.total.value = overall;
	}
}

