let carrito = [];
let total = 0;

function agregarAlCarrito(nombre, precio) {
    carrito.push({ nombre, precio });
    total += precio;
    mostrarCarrito();
}

function mostrarCarrito() {
    const listaCarrito = document.getElementById('lista-carrito');
    listaCarrito.innerHTML = ''; // Limpiar la lista antes de mostrarla

    carrito.forEach((item, index) => {
        const li = document.createElement('li');
        li.textContent = `${item.nombre} - $${item.precio.toFixed(2)}`;
        li.appendChild(createRemoveButton(index));
        listaCarrito.appendChild(li);
    });

    document.getElementById('total').textContent = `Total: $${total.toFixed(2)}`;
}

function createRemoveButton(index) {
    const button = document.createElement('button');
    button.textContent = 'Eliminar';
    button.onclick = () => eliminarDelCarrito(index);
    return button;
}

function eliminarDelCarrito(index) {
    total -= carrito[index].precio; // Restar el precio del total
    carrito.splice(index, 1); // Eliminar del carrito
    mostrarCarrito();
}
