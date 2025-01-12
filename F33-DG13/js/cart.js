document.querySelector('.checkout-button').addEventListener('click', function(e) {
        if (!confirm('Are you sure you want to checkout?')) {
            e.preventDefault();
        } else {
			alert("Checkout successfully!!");
		}
});

function confirmDecrease(formElement, buttonElement) {
	var currentQuantity = parseInt(formElement.querySelector('span').textContent);
	if(currentQuantity <= 1) {
		return confirm('Are you sure you want to remove this item from your cart?');
	}
	return true;
}

function confirmIncrease(formElement, buttonElement) {
    return true; // Always return true since no confirmation is needed to increase quantity
}

window.onload = function() {
    // Check if we have a saved position in sessionStorage
    const savedPosition = sessionStorage.getItem('scrollPosition');
    if (savedPosition) {
        // Use setTimeout to put at end of call stack to ensure layout has stabilized
        setTimeout(() => {
            window.scrollTo(0, parseInt(savedPosition, 10));
            // Clear the saved position from sessionStorage
            sessionStorage.removeItem('scrollPosition');
        }, .1000);
    }

    // Attach event listeners to form submissions to save the scroll position
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(event) {
            // Save the current scroll position before submitting the form
            sessionStorage.setItem('scrollPosition', window.scrollY.toString());
        });
    });
};







