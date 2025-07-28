<!-- Navbar  -->
<section class="menu menu2 cid-u3GZCsGXbm" once="menu" id="menu-5-u3GZCsGXbm">
  <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
    <div class="container">
      <div class="navbar-brand">
        <span class="navbar-logo">
          <a href="{{ route('index') }}">                            
            <img src="images/pond/sqms.png" style="height: 4.3rem;">
          </a>
        </span>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse"
        data-bs-toggle="collapse" data-target="#navbarSupportedContent"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarNavAltMarkup" aria-expanded="false"
        aria-label="Toggle navigation">
        <div class="hamburger">
          <span></span>
          <span></span>
          <span></span>     
          <span></span>
        </div>
      </button>
      <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link link text-black display-4 {{ Request::is('about*') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link link text-black display-4 {{ Request::is('contact*') ? 'active' : '' }}" href="{{ route('contact') }}">Contacts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link link text-black display-4 {{ Request::is('sensor') ? 'active' : '' }}" href="{{ url('/sensor') }}">Sensors</a>
          </li>
          
        {{-- @if(session('firebase_logged_in') && session('is_admin'))
          <li class="nav-item">
            <a class="nav-link link text-black display-4 {{ Request::is('admin') ? 'active' : '' }}" href="{{ route('admin.index') }}">Admin Panel</a>
          </li>
          @endif --}}
        </ul>
        <div class="navbar-buttons mbr-section-btn align-items-left">
          @if(!session('firebase_logged_in'))
          <a class="btn btn-primary display-4" href="{{ route('login') }}" style="background-color: yellow; color: black;">
            <i class="fas fa-user" style="font-size: 24px; margin-right: 10px;"></i>
            LOGIN
          </a>
          @else
          <form action="{{ route('logout') }}" method="POST" style="display: inline;">
              @csrf
              <button type="submit" class="btn btn-primary display-4" style="background-color: yellow; color: black;">
                  <i class="fas fa-user" style="font-size: 24px; margin-right: 10px;"></i>
                  LOGOUT
              </button>
          </form>
          @endif
        </div>
      </div>
    </div>
  </nav>
</section>
