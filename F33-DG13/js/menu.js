// Get the modal
var modal = document.getElementById("myModal");

// Get the close button
var closeBtn = document.querySelector(".close");

var cart = [];

// Function to open modal
function openModal(menuItemName, description, price, imgSrc) {
    modal.querySelector('h2').textContent = menuItemName;
    modal.querySelector('p:nth-of-type(1)').textContent = description;
    modal.querySelector('p:nth-of-type(2)').textContent = 'Price: $' + price;
	modal.querySelector('#modal-image').setAttribute('src', imgSrc);
    modal.style.display = "block";
}

// When the user clicks on the close button, close the modal
closeBtn.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target === modal) {  // Ensure the target is specifically the modal
        modal.style.display = "none";
    }
}



// Add event listeners to all menu items
var menuItems = document.querySelectorAll(".menu-item .menu-image");
menuItems.forEach(function(item) {
    item.addEventListener('click', function() {
        var parent = this.parentElement;
        var itemName = parent.getAttribute('data-name');
        var itemDescription = parent.getAttribute('data-description');
        var itemPrice = parent.getAttribute('data-price');
        var itemImageSrc = this.getAttribute('src');
		
        document.getElementById('item-quantity').value = "1";
        openModal(itemName, itemDescription, itemPrice, itemImageSrc);
    });
});

document.querySelector('.add-to-cart').addEventListener('click', function() {
    var quantity = document.getElementById('item-quantity').value;
	
	if (quantity == 0) {
        modal.style.display = "none"; // close the modal
        return; // exit without adding to cart
    }
	
    var itemName = modal.querySelector('h2').textContent;
	var itemDesc = modal.querySelector('p:nth-of-type(1)').textContent;
    var itemPrice = parseFloat(modal.querySelector('p:nth-of-type(2)').textContent.split('$')[1]);
	var itemImageSrc = modal.querySelector('#modal-image').getAttribute('src');

    var item = {
        name: itemName,
		desc: itemDesc,
        price: itemPrice,
        quantity: parseInt(quantity),
        total: itemPrice * parseInt(quantity),
		imgSrc: itemImageSrc
    };

    fetch('add_to_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `name=${encodeURIComponent(item.name)}&desc=${encodeURIComponent(item.desc)}&price=${item.price}&quantity=${item.quantity}&imgSrc=${encodeURIComponent(item.imgSrc)}`
    })
    .then(response => response.text())
    .then(data => {
		if (data === "Please log in to add items to the cart.") {
			alert(data);  // Show the alert to the user
		} else if (data === "Item Added!!") {
			let toast = document.getElementById("toast");
			toast.className = "toast show";
			setTimeout(() => { toast.className = "toast"; }, 3000);
  // Show the alert message of item added.
		} else {
			console.log(data);  // Process the response or do other actions as needed
		}
	})
    .catch(error => console.error('Error:', error));

    
    modal.style.display = "none"; // close the modal
});





