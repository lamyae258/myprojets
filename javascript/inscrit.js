const loginForm = document.getElementById('login-form');
const registerForm = document.getElementById('register-form');
const resetForm = document.getElementById('reset-form');


const registerLink = document.getElementById('register-link');
const forgotLink = document.getElementById('forgot-link');
const backToLogin = document.getElementById('back-to-login');
const loginLink = document.getElementById('login-link');


function toggleForm(showForm, hideForms) {
    hideForms.forEach(form => form.classList.remove('active'));
    showForm.classList.add('active');
}

registerLink.addEventListener('click', (e) => {
    e.preventDefault();
    toggleForm(registerForm, [loginForm, resetForm]);
});

forgotLink.addEventListener('click', (e) => {
    e.preventDefault();
    toggleForm(resetForm, [loginForm, registerForm]);
});

backToLogin.addEventListener('click', (e) => {
    e.preventDefault();
    toggleForm(loginForm, [registerForm, resetForm]);
});

loginLink.addEventListener('click', (e) => {
    e.preventDefault();
    toggleForm(loginForm, [registerForm, resetForm]);
});

/*register*/
document.addEventListener("DOMContentLoaded", function() {
    document.querySelector('#register-form').addEventListener('submit', function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        fetch('register.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())  
        .then(data => {
            if (data.status === 'success') {
                window.location.href = data.redirect;
            } else {
                document.querySelector('#register-error-message').textContent = data.message;
            }
        })
        .catch(error => console.error('Error:', error));
    });
});
/*login*/
document.addEventListener("DOMContentLoaded", function() {
    document.querySelector('#login-form').addEventListener('submit', function(event) {
        event.preventDefault();

        var email = document.querySelector("input[name='email']").value;
        var password = document.querySelector("input[name='password']").value;

        fetch('login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                email: email,
                password: password
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                window.location.href = data.redirect;  
            } else {
                document.querySelector('#error-message').textContent = data.message;
            }
        })
        .catch(error => {
            document.querySelector('#error-message').textContent = 'An error occurred. Try again.';
        });
    });
});

