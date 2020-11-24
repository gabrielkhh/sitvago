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
        minTime: "9:00",
        maxTime: "22:30",
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
        minTime: "9:00",
        dateFormat: "d-m-Y",
        maxTime: "22:30"
    });
}


//Do not allow user to enter into the input field for validation by disabling keypress
checkInDate.onkeypress = () => false;
checkOutDate.onkeypress = () => false;


