document.addEventListener('DOMContentLoaded', () => {
    const cartIcon = document.getElementById('cart-icon');
    const cart = document.getElementById('carrito');
    const cartProducts = document.getElementById('cart-products');
    const cartCount = document.getElementById('contador-productos');
    const totalSpan = document.querySelector('.total-pagar');
    const searchInput = document.getElementById('search-input');
    const itemsContainer = document.getElementById('product-list');

    let cartItems = [];

    // Event listener for adding items to the cart
    itemsContainer.addEventListener('click', (event) => {
        if (event.target.tagName === 'BUTTON') {
            const name = event.target.getAttribute('data-name');
            const price = parseFloat(event.target.getAttribute('data-price'));
            addToCart(name, price);
        }
    });

    // Event listener for showing the cart
    cartIcon.addEventListener('click', () => {
        cart.classList.toggle('hidden-cart');
    });

    // Function to add items to the cart
    function addToCart(name, price) {
        cartItems.push({ name, price });
        updateCart();
    }

    // Function to update the cart display
    function updateCart() {
        cartProducts.innerHTML = '';
        let total = 0;

        cartItems.forEach(item => {
            const productDiv = document.createElement('div');
            productDiv.classList.add('cart-item');
            productDiv.innerHTML = <p>${item.name}</p><p>${item.price}</p>;
            cartProducts.appendChild(productDiv);
            total += item.price;
        });

        cartCount.textContent = cartItems.length;
        totalSpan.textContent = $${total.toFixed(2)};
    }

    // Event listener for the search input
    searchInput.addEventListener('input', () => {
        const query = searchInput.value.toLowerCase();
        const items = itemsContainer.querySelectorAll('.item');

        items.forEach(item => {
            const name = item.querySelector('h2').textContent.toLowerCase();
            if (name.includes(query)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    });
});