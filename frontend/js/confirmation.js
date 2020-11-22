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

function registerEventHandlers()
{
    var check_details = document.getElementById("details_check_box");
    if (check_details !==null)
    {
        check_details.addEventListener("click", function(){
        // If true disable inputs
        if (check_details.checked){
            //disable input elements
            disableForm();
        }else{
            enableForm();
    }
        });
    }
    else
    {
        console.log("No images found");
    }   
}

