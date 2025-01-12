document.addEventListener('DOMContentLoaded', function() {

    // Real-time validation for the name field
    document.getElementById('name').addEventListener('input', validateName);
    
    // Real-time validation for the email field
    document.getElementById('email').addEventListener('input', validateEmail);
    
    // Real-time validation for the password field
    document.getElementById('password').addEventListener('input', validatePassword);
    
    // Real-time validation for the confirm password field
    document.getElementById('confirm_password').addEventListener('input', validateConfirmPassword);
    
    // Real-time validation for the contact field
    document.getElementById('contact').addEventListener('input', validateContact);
    
    // Real-time validation for the address field
    document.getElementById('address').addEventListener('input', validateAddress);

});

function validateName() {
    var name = document.getElementById('name').value;
    var namePattern = /^[A-Za-z\s]{3,}$/;
    if(!namePattern.test(name)) {
        document.getElementById('nameError').textContent = 'Invalid name. Only alphabets are allowed and minimun 3 letters.';
    } else {
        document.getElementById('nameError').textContent = '';
    }
}

function validateEmail() {
    var email = document.getElementById('email').value;
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if(!emailPattern.test(email)) {
        document.getElementById('emailError').textContent = 'Invalid email format.';
    } else {
        document.getElementById('emailError').textContent = '';
    }
}

function validatePassword() {
    var password = document.getElementById('password').value;
    if(password.length < 6) {
        document.getElementById('passwordError').textContent = 'Password should be at least 6 characters long.';
    } else {
        document.getElementById('passwordError').textContent = '';
        // Trigger confirmation password validation as the password might have changed
        validateConfirmPassword();
    }
}

function validateConfirmPassword() {
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirm_password').value;
    if(password !== confirmPassword) {
        document.getElementById('confirmPasswordError').textContent = 'Passwords do not match.';
    } else {
        document.getElementById('confirmPasswordError').textContent = '';
    }
}

function validateContact() {
    var contact = document.getElementById('contact').value;
    var contactPattern = /^\d{8,10}$/;
    if(!contactPattern.test(contact)) {
        document.getElementById('contactError').textContent = 'Invalid contact number. It should be 8 to 10 digits long.';
    } else {
        document.getElementById('contactError').textContent = '';
    }
}

function validateAddress() {
    var address = document.getElementById('address').value;
    if(address.trim() === "") {
        document.getElementById('addressError').textContent = 'Address cannot be empty.';
    } else {
        document.getElementById('addressError').textContent = '';
    }
}
