<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">Perfume Shop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav ms-auto">
        <a class="nav-link active" aria-current="page" href="{{ url('/home') }}">Home</a>
        <a class="nav-link" href="{{ url('category' )}}">Danh Mục</a>
        

        
        @if (Route::has('login'))
            <!-- <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block"> -->
                @auth
                <a href="{{ route('logout') }}" class="nav-link underline" 
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
              
                @else
                    <a href="{{ route('login') }}" class="nav-link underline" >Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="nav-link underline">Register</a>
                    @endif
                @endauth
            <!-- </div> -->
        @endif

      </div>
    </div>
  </div>
</nav>