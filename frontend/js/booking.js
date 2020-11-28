/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Get element with check in and check out ID
 const checkInDate = document.querySelector('#checkin');
 const checkOutDate = document.querySelector('#checkout');
 const errorElement = document.getElementById('error');
 const bookBtn = document.getElementById("book_btn");

 //Make the function available after the document is loaded
$(document).ready(function()
{
    registerEventHandlers();
    calenderHandler1();
    calenderHandler2();
});


 //Ensure check out must be the next date on first launch
 var minCoutDate = new Date();
 minCoutDate.setDate(minCoutDate.getDate() +1);
 let messages =[];
 //var errorFound = false; 
 
 /*
 //Remove error message after 3sec
 function removeErrorMsg(){
    console.log(messages.length);
    var thisTimeout = setTimeout(function(){
        if(messages.length >0){
            messages =[];
            errorElement.remove();
            //removeElement('error'); //Need to remove and append back element for new error messages
            console.log(messages.length);
           }
    },3000)//After 3 seconds clear error message
}
*/



 //Remove error message after 3sec cotinously
var myError = setInterval(removeErrorMsg,3000);
function removeErrorMsg(){    
    //Always checking for error message
    console.log(messages.length);
    if(messages.length >0){
        messages =[];
        removeElement('error');
    }
}



//Validation for submit button
 function registerEventHandlers()
{
    //var bookBtn = document.getElementById("book_btn");
    if (bookBtn !==null)
    {
         //Prevent default submission still trying to get it work
         bookBtn.addEventListener("click",(e) =>{
            var checkInValue = checkInDate.value;
            var checkOutValue = checkOutDate.value;
            //Check if date are filled
            if (checkInValue.length === 0 || checkOutValue.length === 0)
            {
                messages.push("Please fill in all fields");
            }
            
            //If error messages found prevent submission.
            if (messages.length >0){
                console.log(messages.length);
                addElement("book_btn",'span','error',messages[0]);
                e.preventDefault(); 
                //errorElement.innerText =messages.join(', ');            
            }
        });
    }
    else
    {
        console.log("No Button Found");
    }
}



//Disable specific dates that are blocked
function disableDates(date){
    //Testing, need to get dates from DB instead
    return date.getDate();
}

//Create calender object with flatpickr
function calenderHandler1(){
    flatpickr(checkInDate,{
        minDate:"today",
        dateFormat: "d-m-Y",
        //Validation using onChange Event
        onChange: function(selectedDates, dateStr, instance) {
            var checkOutValue = checkOutDate.value;
            var checkInValue = checkInDate.value;
            var checkOutFormatted = checkOutValue.split("-").reverse().join("-");
            var checkInFormatted = checkInValue.split("-").reverse().join("-");
            //Only check if checkIn value is greater than checkout
            if (checkOutValue.length !==0){
                if (checkInFormatted > checkOutFormatted)
                {
                    messages.push("Invalid Date!");
                    //errorElement.innerText =messages.join(', ')
                    instance.clear();
                    addElement("book_btn",'span','error',messages[0]);
                  
                }
            }
            
        }
        /*
        disable:[
        function(date) {
            //Test
            return !(date.getDate() % 8);
        }
        ]
         */
    });
}

function calenderHandler2(){
    flatpickr(checkOutDate,{
        //minDate: minCoutDate,
        dateFormat: "d-m-Y",
        /*
        //Validation using onChange Event
        onChange: function(selectedDates, dateStr, instance) {
            var checkOutValue = checkOutDate.value;
            var checkInValue = checkInDate.value;
            var checkOutFormatted = checkOutValue.split("-").reverse().join("-");
            var checkInFormatted = checkInValue.split("-").reverse().join("-");
            //Only check if checkInValue is not null and greater then checkout
            if (checkInValue.length !==0){
                if (checkInFormatted > checkOutFormatted)
                {
                    instance.clear();
                }
            }
            
        },
         */
        //Set min date always greater then check in date
        onOpen: function(selectedDates, dateStr, instance) {
            var checkInValue = checkInDate.value;
            if(checkInValue.length ===0){
                instance.set('minDate', minCoutDate);
            }
            var checkInFormatted = checkInValue.split("-").reverse().join("-");
            var newMinDate = new Date(checkInFormatted);
            newMinDate.setDate(newMinDate.getDate() + 1);
            console.log(newMinDate);
            if(checkInFormatted.length !==0)
            {
                 instance.set('minDate',newMinDate);
            }   
        }
     });
}

// Adds an element to the document
function addElement(parentId, elementTag, elementId, html) {
    var p = document.getElementById(parentId);
    var newElement = document.createElement(elementTag);
    newElement.setAttribute('id', elementId);
    newElement.innerText = html;
    p.insertAdjacentElement('afterend',newElement);
    //p.appendChild(newElement);
    //document.body.appendChild(p);
}

function removeElement(elementId) {
    // Removes an element from the document
    var element = document.getElementById(elementId);
    element.parentNode.removeChild(element);
}

//Do not allow user to enter into the input field for validation by disabling keypress
//checkInDate.onkeypress = () => false;
//checkOutDate.onkeypress = () => false;


