// cart.js
function addToCart(id, name, price, image) {
    // Log to ensure the function is being called
    console.log("Adding to cart:", { id, name, price, image });

    // Retrieve the cart from local storage or initialize it if it doesn't exist
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Check if the product is already in the cart
    const existingProductIndex = cart.findIndex(item => item.id === id);

    if (existingProductIndex !== -1) {
        // If the product is already in the cart, increase its quantity
        cart[existingProductIndex].quantity += 1;
    } else {
        // If the product is not in the cart, add it
        const product = {
            id: id,
            name: name,
            price: price,
            image: image,
            quantity: 1
        };
        cart.push(product);
    }

    // Save the cart back to local storage
    localStorage.setItem('cart', JSON.stringify(cart));

    // Log the cart to verify the correct state before alert
    console.log("Cart updated:", cart);

    // Display a success popup message
    alert('Product added to cart successfully!');
}

// Call displayCart when the cart page loads
if (window.location.pathname.includes('draft_shoppingCart.php')) {
    displayCart();
}

document.addEventListener('DOMContentLoaded', function() {
    displayCart();
});

function displayCart() {

    console.log("Display  cart debut");


    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    const cartTableBody = document.querySelector('.cart-table tbody');

    cartTableBody.innerHTML = ''; // Clear any existing rows

    let subtotal = 0;

    cart.forEach(product => {
        const row = document.createElement('tr');

        const productTotal = product.price * product.quantity;
        subtotal += productTotal;

        row.innerHTML = `
            <td>
                <img src="${product.image}" alt="${product.name}" class="cart-image" style="width: 50px; height: 50px;"> 
                ${product.name}
            </td>
            <td>€ ${product.price.toFixed(2)}</td>
            <td>${product.quantity}</td>
            <td>€ ${productTotal.toFixed(2)}</td>
        `;

        cartTableBody.appendChild(row);

        console.log("looping product");
    });

    updateCartTotal(subtotal);
}

function updateCartTotal(subtotal) {
    const totalElement = document.querySelector('.order-total p');
    totalElement.textContent = `Total: €${subtotal.toFixed(2)}`;
}
