<!DOCTYPE html>
<html lang="en">
<!-- LogIn-->
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login</title>

<link rel="shortcut icon" href="{{ asset('images/pond/icc.png') }}" type="image/x-icon">

<!-- ✅ Secure Bootstrap (via HTTPS CDN with integrity for extra protection) -->
<link
  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
  rel="stylesheet"
  integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+GY5Ejq9KqvX6MJ0hj9L1zHBt5T0T8JxwQGmQ5T"
  crossorigin="anonymous"
/>

<style>
/* Your custom secure CSS here */
</style>

    body {
        background-image: url('{{ asset('images/pond/PISPAND.jpg') }}');
        background-size: cover;
        background-position: center;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        overflow: hidden;
        font-family: 'Arial', sans-serif;
        color: #fff;
        position: relative;
    }

    body::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 0;
    }

    .login-card {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        backdrop-filter: blur(15px);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        padding: 20px; /* smaller padding */
        max-width: 360px;
        width: 100%;
        display: flex; /* flex layout */
        flex-direction: column;
        align-items: center;
        text-align: center;
        z-index: 1;
        position: relative;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        animation: fadeIn 0.8s ease;
    }

    .logo-container {
        display: flex;
        justify-content: center;
        margin-bottom: 10px;
    }

    .login-logo {
         width: 250px; /* custom width */
         height: 100px; /* custom height */
        
    }

    .btn-primary {
        background: linear-gradient(135deg, #1B3C53, #456882);
        border: none;
        border-radius: 50px;
        color: #fff;
        font-weight: bold;
        width: 100%;
        padding: 12px;
        font-size: 1.2rem;
        box-shadow: 0 4px 15px rgba(108, 99, 255, 0.4);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 15px;
    }
    </style>
</head>

<!-- LogIn Page -->
<body>
    <div class="login-card">
        <div class="logo-container">
            <img src="{{ asset('images/pond/swqms.png') }}" alt="Logo" class="login-logo">
        </div>
        <form id="loginForm">
            <div class="mb-3">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required maxlength="30">
            </div>
            <div class="mb-3 position-relative">
                <div style="display: flex; align-items: center; gap: 8px; position: relative;">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required maxlength="20" style="padding-right: 2.5rem;">
                    <button type="button" id="togglePassword" aria-label="Show password" 
                        style="position: absolute; right: 10px; background: transparent; border: none; cursor: pointer; color: #fff; font-size: 1.1rem;">
                        👁️
                    </button>
                </div>
            </div>
            <p id="attemptCounter" style="color: red;"></p>
            <p id="lockoutTimer" style="color: yellow;"></p>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
            <div class="mb-3">
                <button type="button" class="btn btn-primary" onclick="window.location.href='{{ url('/') }}';">Back</button>
            </div>
        </form>
    </div>

     <!-- LogIN logic -->
    <script type="module">
        import { initializeApp } from 'https://www.gstatic.com/firebasejs/9.17.2/firebase-app.js';
        import { getAuth, signInWithEmailAndPassword } from 'https://www.gstatic.com/firebasejs/9.17.2/firebase-auth.js';

        const firebaseConfig = {
            apiKey: "AIzaSyBjzVI4kfvaoaQdp1zfBOchItQ9RWYrI5g",
            authDomain: "swqms-466f1.firebaseapp.com",
            projectId: "swqms-466f1",
        };

        const app = initializeApp(firebaseConfig);
        const auth = getAuth(app);

        let attemptCounter = 0;
        let lockoutTime = 0;
        let countdownInterval;

        function generateCaptcha() {
            const num1 = Math.floor(Math.random() * 10) + 1;
            const num2 = Math.floor(Math.random() * 10) + 1;
            return { question: `${num1} + ${num2} = ?`, answer: num1 + num2 };
        }

        function startLockout() {
            lockoutTime = Date.now() + 15000;
            document.getElementById('lockoutTimer').textContent = "Locked out for 15 seconds!";
            countdownInterval = setInterval(updateLockoutTimer, 1000);
        }

        function updateLockoutTimer() {
            const remainingTime = Math.ceil((lockoutTime - Date.now()) / 1000);
            if (remainingTime > 0) {
                document.getElementById('lockoutTimer').textContent = `Try again in ${remainingTime} seconds...`;
            } else {
                clearInterval(countdownInterval);
                document.getElementById('lockoutTimer').textContent = "";
                attemptCounter = 0;
            }
        }

        function handleLoginFail(isCaptcha = false) {
            attemptCounter++;
            document.getElementById('attemptCounter').textContent = `Attempts left: ${3 - attemptCounter}`;
            if (attemptCounter >= 3) {
                attemptCounter = 0;
                startLockout();
                alert('Too many failed attempts. Please wait 15 seconds before trying again.');
            } else {
                alert(isCaptcha ? 'Incorrect CAPTCHA. Try again.' : 'Invalid email or password.');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.getElementById('loginForm');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const toggleBtn = document.getElementById('togglePassword');

            loginForm.addEventListener('submit', function(event) {
                event.preventDefault();
                if (lockoutTime > Date.now()) {
                    alert('Too many failed attempts. Try again later.');
                    return;
                }

                const captcha = generateCaptcha();
                const captchaInput = prompt(captcha.question);
                if (parseInt(captchaInput) !== captcha.answer) {
                    handleLoginFail(true);
                    return;
                }

                const email = emailInput.value;
                const password = passwordInput.value;
                signInWithEmailAndPassword(auth, email, password)
                    .then((userCredential) => {
                        userCredential.user.getIdToken().then((token) => {
                            fetch('/firebase-login', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({ token: token })
                            }).then(response => response.json())
                              .then(data => {
                                  if (data.success) {
                                      window.location.href = '/index';
                                  } else {
                                      handleLoginFail();
                                  }
                              }).catch(() => handleLoginFail());
                        });
                    })
                    .catch(() => handleLoginFail());
            });

            toggleBtn.addEventListener('click', function () {
                const isHidden = passwordInput.type === 'password';
                passwordInput.type = isHidden ? 'text' : 'password';
                this.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
                this.textContent = isHidden ? '🙈' : '👁️';
            });

            function validateInput(input) {
                const repeatedPattern = /(.)\1{4,}/;
                if (repeatedPattern.test(input.value)) {
                    alert('Too many repeated characters in input.');
                    input.value = input.value.slice(0, -1);
                }
            }

            emailInput.addEventListener('input', function () { validateInput(emailInput); });
            passwordInput.addEventListener('input', function () { validateInput(passwordInput); });
        });
    </script>

    <script>
        function checkApproval() {
            fetch('/check-approval')
            .then(response => response.json())
            .then(data => {
                if (data.approved) {
                    alert(data.message);
                    window.location.href = '/dashboard';
                } else {
                    setTimeout(checkApproval, 3000);
                }
            }).catch(error => console.error('Error:', error));
        }
        checkApproval();
    </script>
</body>
</html>
