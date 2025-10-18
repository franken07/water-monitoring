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

        if(loginForm){
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
              this.textContent = isHidden ? '🙈' : '👁️';
          });
        }
    });
</script>
