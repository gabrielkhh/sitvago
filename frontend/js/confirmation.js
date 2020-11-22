/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
const all_inputs = document.getElementsByClassName("confirm_input");

//Make the function available after the document is loaded
$(document).ready(function()
{
    registerEventHandlers();
});


function registerEventHandlers()
{
    var check_details = document.getElementById("details_check_box");
    if (check_details !==null)
    {
        check_details.addEventListener('change', checkDetails());
    }
    else
    {
        console.log("No images found");
    }   
}

function disableForm() {
    for (var i=0; i<all_inputs.length; i++)
    {
        document.getElementById(all_inputs[i].id).disabled = true;
    }
}

function enableForm() {
    for (var i=0; i<all_inputs.length; i++)
    {
        document.getElementById(all_inputs[i].id).disabled = false;
    }
}


function checkDetails(){
    // If true disable inputs
    if (check_details.checked){
        //disable input elements
        disableForm();
    }else{
        enableForm();
    }
}

