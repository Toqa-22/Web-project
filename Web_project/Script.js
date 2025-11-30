/* =================================
        funpage JS
   =================================
*/

//Get the canvas by id from the HTML
const canvas = document.getElementById("drawing_canvas");
//Get the canvas the 2D drawing context
const context = canvas.getContext("2d");
//Set variable to check if the user is drawing or not
let painting = false;
//Default drawing color from the color input 
let color = document.getElementById("color").value;
//Default drawing size from the size input
let size = document.getElementById("sizePicker").value;



//Start/Stop drawing
function start_painting() {
    painting = true;
}
function stop_painting() {
    painting = false;
    //new path : stop the current line
    context.beginPath();
}
//if mouse in canvas start drowing
canvas.addEventListener("mousedown", start_painting);
//if mouse up the canvas stop drowing
canvas.addEventListener("mouseup", stop_painting);


//Drawing function
canvas.addEventListener("mousemove", draw);
function draw(e) {
    //if the mouse not pressed then do not drow
    if (!painting){
        return;
    } 

    //Drawing line width
    context.lineWidth = size;
    //Drawing line color
    context.strokeStyle = color;

    //Make line ends are round and smooth
    context.lineCap = "round";

    //Draw a line from the previous point to the current mouse position + Make the line visible
    context.lineTo(e.offsetX, e.offsetY);
    context.stroke();

    //Start a new path from the current mouse position
    context.beginPath();
    context.moveTo(e.offsetX, e.offsetY);
}

// Update drowing color
document.getElementById("color").onchange = function() {
    color = this.value;
};

// Update drowing size
document.getElementById("sizePicker").onchange = function() {
    size = this.value;
};

// Clear the drowing box
function clear_canvas() {
    context.clearRect(0, 0, canvas.width, canvas.height);
}
/* =================================
        for index banner text
   =================================
*/

// 1. Set  Company Name
const _companyName = "SQU Student Campus Housing";

// 2. Function to update the text
function updateBanner() {
  var _now = new Date();

  // Format date and time based on user's locale
  var _currentDate = _now.toLocaleDateString('en-GB');
  var _currentTime =  _now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', second: '2-digit' });

  // Inject into the HTML
  
  document.getElementById('companyName').innerHTML = _companyName;
  document.getElementById('currentDate').innerHTML = _currentDate;
  document.getElementById('currentTime').innerHTML = _currentTime;

}

// 3. Update immediately on load
updateBanner();

// 4. Update every second (1000ms) so the time stays accurate
setInterval(updateBanner, 1000);

/* =================================
        for calculate page
   =================================
*/

function calculateBill() {
  // 1. Retrieve values from the form fields
  var basicCount = parseInt(document.getElementById('basicItems').value); // Number of shirts/pants
  var specialCount = parseInt(document.getElementById('specialItems').value); // Number of dresses/abayas
  var wantDelivary = document.getElementById('wantDelivary').checked; // Is the user want a Delivary

  // Define the service prices (in Omani Riyal - OMR)
  var BASIC_PRICE = 0.500; // 500 Baisa
  var SPECIAL_PRICE = 1.000; // 1.000 OMR
  var DELIVERY_FEE = 1.000; // Delivery fee for non-residents

  
  // Total cost for basic items
  var basicCost = basicCount * BASIC_PRICE;
  // Total cost for special items
  var specialCost = specialCount * SPECIAL_PRICE;
  // The initial total cost 
  let totalInitialCost = basicCost + specialCost;

  // Variable to store the final cost/fee message
  let message = "";
  let finalCost = totalInitialCost;

  

  // Condition : Is the user want a delivary? 
  if (wantDelivary) {
    // User is not a resident, apply the delivery fee
    finalCost = finalCost + DELIVERY_FEE; 
    message += "Delivery fee of 1.000 OMR has been added. ";
  } else {
    // User is a resident, delivery is free
    message += "Delivery service is not added. ";
  }

  

  // 2. Display the final result

  // Use toFixed(3) to ensure the currency is displayed with three decimal places (Rials and Baisa)
  document.getElementById('totalCost').innerHTML = "<strong>Total Final Bill: </strong>" +finalCost.toFixed(3) + "OMR";
  document.getElementById('Message').innerText = message;


  // Show the results area after calculation
  document.getElementById('resultArea').style.display = 'block';
}







/* =================================
       
   =================================
*/
