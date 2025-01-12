// Validation for the Name field
function validateName() {
    let name = document.getElementById("UserName").value;
    let nameError = document.getElementById("nameError");
    let namePattern = /^[a-zA-Z\s]+$/;

    if (!namePattern.test(name)) {
        nameError.innerText = "Name can only contain alphabets and spaces.";
        return false;
    } else {
        nameError.innerText = "";
        return true;
    }
}

// Validation for the Contact field
function validateContact() {
    let contact = document.getElementById("UserContact").value;
    let contactError = document.getElementById("contactError");
    let contactPattern = /^[0-9]+$/;

    if ((!contactPattern.test(contact)) || contact.length > 10 || contact.length < 8) {
        contactError.innerText = "Contact number should have numbers only and be at 8-10 digits.";
        return false;
    } else {
        contactError.innerText = "";
        return true;
    }
}

// Main validation function that will be called on form submission
function validateForm() {
    // Initialize a variable to track if any validation checks fail
    let valid = true;

    // Validate the name
    if (!validateName()) {
        valid = false;
    }

    // Validate the contact
    if (!validateContact()) {
        valid = false;
    }

    // Validate the address (you can add more specific checks if needed)
    if (document.getElementById("UserAddress").value.trim() === "") {
        document.getElementById("addressError").innerText = "Address cannot be empty.";
        valid = false;
    } else {
        document.getElementById("addressError").innerText = ""; // Clear any previous error message
    }

    // Return the final validation status
    return valid;
}

// Add event listeners to validate fields on input events
document.getElementById("UserName").addEventListener("input", validateName);
document.getElementById("UserContact").addEventListener("input", validateContact);
