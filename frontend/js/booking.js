/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Get element with check in and check out ID
 const checkInDate = document.querySelector('#checkin');
 const checkOutDate = document.querySelector('#checkout');
 const errorElement = document.getElementById('error');

 //Make the function available after the document is loaded
$(document).ready(function()
{
    registerEventHandlers();
    calenderHandler1();
    calenderHandler2();
});


 //Ensure check out must be the next date
 var minCoutDate = new Date();
 minCoutDate.setDate(minCoutDate.getDate() +1);
 let messages =[];

//Validation for submit button
 function registerEventHandlers()
{
    var bookBtn = document.getElementById("book_btn");
    if (bookBtn !==null)
    {
            //Prevent default submission still trying to get it work
            bookBtn.addEventListener('submit',(e) =>{
 
            messages.push("No Button Found");
            
            var checkInValue = checkInDate.value;
            var checkOutValue = checkOutDate.value;
            if (checkInValue.length === 0 || checkOutValue.length === 0)
            {
                messages.push("Date Must be Filled");
            }
            
            //If error messages found prevent submission.
            if (messages.length >0){
                e.preventDefault();
                errorElement.innerText =messages.join(', ')
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
                    messages.push("Date must not be greater then checkout date!");
                    errorElement.innerText =messages.join(', ')
                    instance.clear();
                  
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



//Do not allow user to enter into the input field for validation by disabling keypress
//checkInDate.onkeypress = () => false;
//checkOutDate.onkeypress = () => false;


