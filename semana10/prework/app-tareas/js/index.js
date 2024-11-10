document.addEventListener('DOMContentLoaded', function(){
    const form = document.getElementById('loginForm');
    const loginError = document.getElementById('login-error');

    form.addEventListener('submit', async function(e){
        e.preventDefault();

        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        //Quitar la verificación que tenemos de prueba test@example.com por el llamado al servidor
        // y en su lugar enviar los datos al servidor.
        // if(email === 'test@example.com' && password === 'password123'){
        //     window.location.href ='dashboard.html';
        // }else{
        //     loginError.style.display = 'block';
        // }
        try {
            // Envía la solicitud POST al servidor
            const response = await fetch('backend/login.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    email: email,
                    password: password
                })
            });

            // Maneja la respuesta
            const result = await response.json();

            if (response.ok) {
                // Login exitoso: redirige al dashboard
                window.location.href = 'dashboard.html';
            } else {
                // Muestra el mensaje de error
                loginError.style.display = 'block';
                loginError.textContent = result.error || "Invalid email or password.";
            }
        } catch (error) {
            // Muestra un mensaje de error si hay un problema con la solicitud
            loginError.style.display = 'block';
            loginError.textContent = "There was an error processing your request.";
        }

    });
})