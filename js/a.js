document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const fixedUsername = 'admin';
    const fixedPassword = 'password123';
    
    const usernameInput = document.getElementById('username').value;
    const passwordInput = document.getElementById('password').value;
    const messageElement = document.getElementById('message');

    if (usernameInput === fixedUsername && passwordInput === fixedPassword) {
        messageElement.textContent = 'Inicio de sesión exitoso';
        messageElement.style.color = 'green';
    } else {
        messageElement.textContent = 'Clave o nombre de usuario incorrecto';
        messageElement.style.color = 'red';
    }
});