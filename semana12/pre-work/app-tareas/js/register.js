document.addEventListener('DOMContentLoaded', function () {
    const registerForm = document.getElementById('register-form');
    const registerError = document.getElementById('register-error');

    registerForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm-password').value;
        const errormsg = "Password and confirmation don't match";

        if (password !== confirmPassword) {
            registerError.innerHTML = `<div class="alert alert-danger fade show" role="alert">
            <strong>Error:</strong> ${errormsg}
            </div>`;
            return;
        } else {
            //preparar los datos
            const formData = new URLSearchParams();
            formData.append('email', email);
            formData.append('password', password);
            try {
                //enviar datos al server
                const response = await fetch('backend/register.php', {
                    method: 'POST',
                    headers: {
                        'Content-type': 'application/x-www-form-urlencoded'
                    },
                    body: formData.toString()
                });
                // const result = response.json();

                if (response.ok) {
                    //todo exitoso
                    registerError.innerHTML = `<div class="alert alert-success fade show" role="alert">
                                                <strong>Success:</strong> Email: ${email} successfully registered.
                                            </div>`;
                    setTimeout(function () {
                        registerError.innerHTML = "";
                        window.location.href = "index.html";
                    }, 5000)
                } else {
                    registerError.innerHTML = `<div class="alert alert-danger fade show" role="alert">
                <strong>Error sending data to the server</strong>
                </div>`;
                }

            } catch (error) {
                console.error(error);
                registerError.innerHTML = `<div class="alert alert-danger fade show" role="alert">
                <strong>Error sending data to the server</strong>
                </div>`;
            }




        }



    })

});