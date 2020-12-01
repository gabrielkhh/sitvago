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


//Not used but for future implementations
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
        /*
        if (all_inputs[i].id ==="hotel-name")
        {
            document.getElementById(all_inputs[i].id).disabled = true;
        }
          
        */
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
        console.log("No Check Box");
    }   
}



// Create a Stripe client.
var stripe = Stripe('pk_test_51Ao75SEf1nbkr1FVnTkjNmboypkiFHHyuF8DPyEI5dxEKcDX51IiTqCkZ1Z9hweCmabzspjqQOesaJkNYPirVF2l00C6OezOQM');

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the card-element <div>.
card.mount('#card-element');
// Handle real-time validation errors from the card Element.
card.on('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('booking_form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('booking_form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}