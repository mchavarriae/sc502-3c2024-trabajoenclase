document.addEventListener('DOMContentLoaded', function(){
    const registerForm = document.getElementById('register-form');
    const registerError = document.getElementById('register-error');

    registerForm.addEventListener('submit', async function(e){
        e.preventDefault();

        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm-password').value;
        const errormsg = "Password and confirmation don't match";

        if(password !== confirmPassword){
            registerError.innerHTML = `<div class="alert alert-danger fade show" role="alert">
            <strong>Error:</strong> ${errormsg}
            </div>`;
            return;
        }/*else {
            Cambiar este mensaje de verificacion por el llamado al servidor.
            registerError.innerHTML = `<div class="alert alert-success fade show" role="alert">
            <strong>Success:</strong> Email: ${email} successfully registered.*/
        
        // Datos del formulario para enviar al servidor
        const formData = new URLSearchParams();
        formData.append('email', email);
        formData.append('username', email);
        formData.append('password', password);

        try {
            // Enviar datos a register.php usando fetch
            const response = await fetch('backend/register.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: formData.toString()
            });

            // Manejar la respuesta del servidor
            const result = await response.json();

            if (response.ok) {
                registerError.innerHTML = `<div class="alert alert-success fade show" role="alert">
                <strong>Success:</strong> ${result.message}
                </div>`;
                setTimeout(function() {
                    registerError.innerHTML = "";
                    window.location.href = "index.html";
                }, 5000);
            } else {
                registerError.innerHTML = `<div class="alert alert-danger fade show" role="alert">
                <strong>Error:</strong> ${result.error}
                </div>`;
            }
        } catch (error) {
            registerError.innerHTML = `<div class="alert alert-danger fade show" role="alert">
            <strong>Error:</strong> There was a problem with the registration. Please try again later.
            </div>`;
        }
    })
});