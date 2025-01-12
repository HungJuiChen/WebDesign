// Store the initial values
var initialUserName = document.getElementById('UserName').value;
var initialUserContact = document.getElementById('UserContact').value;
var initialUserAddress = document.getElementById('UserAddress').value;

document.getElementById('editButton').addEventListener('click', function() {
    // Toggle the readonly attribute on input fields
    document.getElementById('UserName').removeAttribute('readonly');
    document.getElementById('UserContact').removeAttribute('readonly');
    document.getElementById('UserAddress').removeAttribute('readonly');

    // Hide the edit button and show the save changes and cancel buttons
    document.getElementById('editButton').style.display = 'none';
    document.getElementById('submitButton').style.display = 'block';
    document.getElementById('cancelButton').style.display = 'block';
	
	// Hide the home and order history buttons using their class names
    document.querySelector('.home-button').style.display = 'none';
    document.querySelector('.order-history-button').style.display = 'none';
});

document.getElementById('cancelButton').addEventListener('click', function() {
    // Reset the fields to their original values using JavaScript variables
    document.getElementById('UserName').value = initialUserName;
    document.getElementById('UserContact').value = initialUserContact;
    document.getElementById('UserAddress').value = initialUserAddress;

    // Set the input fields back to readonly
    document.getElementById('UserName').setAttribute('readonly', true);
    document.getElementById('UserContact').setAttribute('readonly', true);
    document.getElementById('UserAddress').setAttribute('readonly', true);

    // Hide the save changes and cancel buttons and show the edit button
    document.getElementById('editButton').style.display = 'block';
    document.getElementById('submitButton').style.display = 'none';
    document.getElementById('cancelButton').style.display = 'none';
	document.querySelector('.home-button').style.display = 'block';
    document.querySelector('.order-history-button').style.display = 'block';
});
