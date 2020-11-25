/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 

//Get element with check in and check out ID
 const checkInDate = document.querySelector('#checkin')
 const checkOutDate = document.querySelector('#checkout')
 
 //Ensure check out must be the next date
 var minCoutDate = new Date();
 minCoutDate.setDate(minCoutDate.getDate() +1);
 
 var checkInValue = checkInDate.value;
 var checkOutValue = checkOutDate.value;

//Make the function available after the document is loaded
$(document).ready(function()
{
    calenderHandler1();
    calenderHandler2();
});

//Disable specific dates that are blocked
function disableDates(date){
    //Testing, need to get dates from DB instead
    return date.getDate();
}


//Create calender object with flatpickr
function calenderHandler1(){
    flatpickr(checkInDate,{ 
        allowInput: true,
        minDate: "today",
        dateFormat: "d-m-Y",
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
        allowInput: true,
        minDate: minCoutDate,
        dateFormat: "d-m-Y",
    });
}


//Do not allow user to enter into the input field for validation by disabling keypress
checkInDate.onkeypress = () => false;
checkOutDate.onkeypress = () => false;

