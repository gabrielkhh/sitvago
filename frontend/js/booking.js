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
 const roomType = document.getElementById("TypeOfRooms");

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
 

//Checking for error message
function removeErrorMsg(){    
    if(messages.length >0){
        messages =[];
        removeElement('error');
    }
}

//Clear the interval
function destroyTimer(errorTimer){
    clearInterval(errorTimer);
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
           var roomTypeValue = roomType.value;
           //Check if date are filled, roomTypeValue.length is cause it's disabled means it's empty value
           if (checkInValue.length === 0 || checkOutValue.length === 0 || roomTypeValue.length === 8)
           {
               messages.push(" Please fill in all fields");
           }
           
           //If error messages found prevent submission. 
           if (messages.length >0){
               e.target.disabled = true;
               //Remove error message if found, interval should also start after error is found and stop when there's no error
               var myError = setInterval(removeErrorMsg,4000);
               e.preventDefault();
               addElement("book_btn",'span','error',messages[0]);             
               setTimeout(()=> {
                   e.target.disabled = false;
                   destroyTimer(myError);
               },4000)
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
        maxDate: new Date().fp_incr(365), //1 year from now
        dateFormat: "d-m-Y",
        //Validation using onChange Event
        onChange: function(selectedDates, dateStr, instance) {
            var checkOutValue = checkOutDate.value;
            var checkInValue = checkInDate.value;
            var checkOutFormatted = checkOutValue.split("-").reverse().join("-");
            var checkInFormatted = checkInValue.split("-").reverse().join("-");
            //Only check if checkIn value is greater than checkout
            if (checkOutValue.length !==0){
                /*  If error message is generated when calender is closed produce error message
                /   If dates are greater then checkout  */
                if (checkInFormatted > checkOutFormatted || checkOutFormatted === checkInFormatted)
                {
                    messages.push(" Invalid Date!");
                    instance.clear();
                    addElement("book_btn",'span','error',messages[0]);
                    //If error messages found disable submit button. 
                    if (messages.length >0){
                            console.log(bookBtn);
                            bookBtn.disabled = true;
                            //Remove error message if found, interval should also start after error is found and stop when there's no error
                            var myError = setInterval(removeErrorMsg,4000);
                            setTimeout(()=> {
                            bookBtn.disabled = false;
                            destroyTimer(myError);
                        },4000)
                    }

                }
            }

        }      
        /* For future implementation
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
        dateFormat: "d-m-Y",
        maxDate:new Date().fp_incr(365),//1 year from now
        //Set min date always greater then check in date
        onOpen: function(selectedDates, dateStr, instance) {
            var checkInValue = checkInDate.value;
            if(checkInValue.length ===0){
                instance.set('minDate', minCoutDate);
            }
            //Setting date to next date based on check in date
            var checkInFormatted = checkInValue.split("-").reverse().join("-");
            var newMinDate = new Date(checkInFormatted);
            newMinDate.setDate(newMinDate.getDate() + 1);
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
}

// Removes an element of child from the document
function removeElement(elementId) {
    var element = document.getElementById(elementId);
    element.parentNode.removeChild(element);
}



