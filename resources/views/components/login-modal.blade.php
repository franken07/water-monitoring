<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 bg-transparent d-flex justify-content-center align-items-center">

      <div class="login-card">
        <div class="logo-container">
          <img src="{{ asset('images/pond/swqms.png') }}" alt="Logo" class="login-logo">
        </div>

        <form id="loginForm" style="width: 100%;">
          <div class="mb-3">
            <input type="email" class="form-control" name="email" id="email" placeholder="Email" required maxlength="30">
          </div>
          <div class="mb-3 position-relative">
            <div style="display: flex; align-items: center; gap: 8px; position: relative;">
              <input type="password" class="form-control" name="password" id="password" placeholder="Password" required maxlength="20" style="padding-right: 2.5rem;">
              <button type="button" id="togglePassword" aria-label="Show password" 
                  style="position: absolute; right: 10px; background: transparent; border: none; cursor: pointer; font-size: 1.1rem;">
                👁️
              </button>
            </div>
          </div>

          <p id="attemptCounter" style="color: red;"></p>
          <p id="lockoutTimer" style="color: yellow;"></p>

          <div class="mb-3">
            <button type="submit" class="btn btn-primary w-100">Login</button>
          </div>
          <div class="mb-3">
            <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Back</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>


<style>
.login-card {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    backdrop-filter: blur(15px);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    padding: 30px 25px;
    width: 3600px;   /* fixed width */
    max-width: 90%; /* responsive for small screens */
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    animation: fadeIn 0.8s ease;
}

.logo-container {
    display: flex;
    justify-content: center;
    margin-bottom: 15px;
}

.login-logo {
    width: 200px;
    height: auto;
    object-fit: contain;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-15px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<!-- Firebase Auth Script -->
@include('components.login-script')
<script>
function openLoginModal() {
    var modal = new bootstrap.Modal(document.getElementById('loginModal'));
    modal.show();
}
</script>
<script>
  // store where to go after successful login
  window.intendedPath = null;

  function openLoginModal(path = '/index') {
    window.intendedPath = path;
    const modalEl = document.getElementById('loginModal');
    const modal = new bootstrap.Modal(modalEl);
    modal.show();
  }
</script>