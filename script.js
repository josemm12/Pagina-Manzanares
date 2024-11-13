// Datos de productos
const products = Array.from({ length: 20 }, (_, i) => ({
    id: i + 1,
    name: Producto ${i + 1},
    price: (Math.random() * 100).toFixed(2),
    image: https://via.placeholder.com/150?text=Producto+${i + 1}
}));

const cart = [];

// Inicializar catálogo y eventos
document.addEventListener("DOMContentLoaded", () => {
    renderCatalog();
    document.getElementById("view-cart").addEventListener("click", toggleCart);
});

// Renderizar productos en el catálogo
function renderCatalog() {
    const catalog = document.getElementById("productCatalog");
    catalog.innerHTML = products.map(product => `
        <div class="product">
            <img src="${product.image}" alt="${product.name}">
            <h3>${product.name}</h3>
            <p>Precio: $${product.price}</p>
            <button onclick="addToCart(${product.id})">Añadir al Carrito</button>
        </div>
    `).join("");
}

// Mostrar u ocultar el carrito
function toggleCart() {
    const cartContainer = document.getElementById("cartContainer");
    cartContainer.classList.toggle("active");
}

// Añadir productos al carrito
function addToCart(productId) {
    const product = products.find(p => p.id === productId);
    const cartItem = cart.find(item => item.id === productId);

    if (cartItem) {
        cartItem.quantity += 1;
    } else {
        cart.push({ ...product, quantity: 1 });
    }
    updateCart();
}

// Actualizar el contenido y el total del carrito
function updateCart() {
    const cartItemsContainer = document.getElementById("cartItems");
    cartItemsContainer.innerHTML = cart.map(item => `
        <div class="cart-item">
            <span>${item.name} (x${item.quantity})</span>
            <span>$${(item.price * item.quantity).toFixed(2)}</span>
            <button onclick="increaseQuantity(${item.id})">+</button>
            <button onclick="decreaseQuantity(${item.id})">-</button>
        </div>
    `).join("");

    const totalAmount = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
    document.getElementById("totalAmount").innerText = totalAmount.toFixed(2);
    document.getElementById("cart-count").innerText = cart.length;
}

// Aumentar la cantidad de un producto en el carrito
function increaseQuantity(productId) {
    const item = cart.find(item => item.id === productId);
    item.quantity += 1;
    updateCart();
}

// Disminuir la cantidad de un producto en el carrito
function decreaseQuantity(productId) {
    const item = cart.find(item => item.id === productId);
    if (item.quantity > 1) {
        item.quantity -= 1;
    } else {
        removeFromCart(productId);
    }
    updateCart();
}

// Eliminar un producto del carrito
function removeFromCart(productId) {
    const itemIndex = cart.findIndex(item => item.id === productId);
    cart.splice(itemIndex, 1);
    updateCart();
}