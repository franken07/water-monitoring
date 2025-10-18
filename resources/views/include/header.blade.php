<!-- Navbar  -->
<section class="menu menu2 cid-u3GZCsGXbm" once="menu" id="menu-5-u3GZCsGXbm">
  <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
    <div class="container">
      <div class="navbar-brand">
        <span class="navbar-logo">
          <a href="{{ route('index') }}">                            
            <img src="images/pond/swqms1.png" style="height: 8.3rem;">
          </a>
        </span>
      </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
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
            <a class="nav-link link text-black display-4 {{ Request::is('contact*') ? 'active' : '' }}" href="{{ route('contact') }}">Contacts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link link text-black display-4 {{ Request::is('about*') ? 'active' : '' }}" href="{{ route('about') }}">FAQs</a>
          </li>
          <li class="nav-item">
            @if(session('firebase_logged_in'))
              <a class="nav-link link text-black display-4 {{ Request::is('sensor*') ? 'active' : '' }}" href="{{ route('sensor.index') }}">Sensors</a>
            @else
              <a class="nav-link link text-black display-4" href="javascript:void(0);" onclick="openLoginModal('/sensor')">Sensors</a>
            @endif
          </li>
        </ul>

        <div class="navbar-buttons mbr-section-btn align-items-left d-flex gap-2">
          {{-- Login/Logout --}}
          @if(!session('firebase_logged_in'))
            <button class="btn btn-primary display-4" data-bs-toggle="modal" data-bs-target="#loginModal" style="background-color: yellow; color: black;">
              <i class="fas fa-user" style="font-size: 24px; margin-right: 10px;"></i>
              LOGIN
            </button>
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

{{-- Admin FAB (Bottom-right corner) --}}
@if(session('firebase_logged_in') && session('is_admin'))
  <a href="{{ route('admin.index') }}" 
     style="
       position: fixed;
       bottom: 20px;
       right: 20px;
       z-index: 9999;
       background-color: #456882 ;
       color: white;
       border-radius: 50%;
       width: 60px;
       height: 60px;
       display: flex;
       align-items: center;
       justify-content: center;
       box-shadow: 0 4px 6px rgba(0,0,0,0.3);
       text-decoration: none;
       transition: transform 0.2s;
     "
     title="Admin Panel"
     onmouseover="this.style.transform='scale(1.1)';" 
     onmouseout="this.style.transform='scale(1)';">
    <i class="fas fa-user-shield" style="font-size: 1.5rem;"></i>
  </a>
@endif

@include('components.login-modal')
