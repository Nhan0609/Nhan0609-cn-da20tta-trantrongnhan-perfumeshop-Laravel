<!-- Topbar Start -->
<div class="container-fluid border-bottom d-none d-lg-block">
  <div class="row gx-0">
      <div class="col-lg-4 text-center py-2">
          <div class="d-inline-flex align-items-center">
              <i class="bi bi-geo-alt fs-1 text-primary me-3"></i>
              <div class="text-start">
                  <h6 class="text-uppercase mb-1">Trụ sở</h6>
                  <span>123 Nguyễn Thiện Thành, P5, Trà Vinh</span>
              </div>
          </div>
      </div>
      <div class="col-lg-4 text-center border-start border-end py-2">
          <div class="d-inline-flex align-items-center">
              <i class="bi bi-envelope-open fs-1 text-primary me-3"></i>
              <div class="text-start">
                  <h6 class="text-uppercase mb-1">Liên hệ</h6>
                  <span>perfumeshoptv@gmail.com</span>
              </div>
          </div>
      </div>
      <div class="col-lg-4 text-center py-2">
          <div class="d-inline-flex align-items-center">
              <i class="bi bi-phone-vibrate fs-1 text-primary me-3"></i>
              <div class="text-start">
                  <h6 class="text-uppercase mb-1">Gọi cho chúng tôi</h6>
                  <span>03429 03416</span>
              </div>
          </div>
      </div>
  </div>
</div>
{{-- End Topbar --}}

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/categories') }}">Perfume Shop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav ms-auto">
        
        <form action="{{url('timkiem')}}" method="POST">
          @csrf
          <div class="nav-link active">
            <input type="text" name="keywords_submit" id="" placeholder="Tìm Kiếm" value="{{ $keywords ?? '' }}" required>
            <input type="submit" name="search_items" id="" class="btn btn-primary btn-sm" value="Tìm Kiếm">
          </div>
        </form>
        

        <a class="nav-link active" aria-current="page" href="{{ url('/home') }}">Trang Chủ</a>

        <a class="nav-link" href="{{ url('category')}}">Danh Mục</a>
        {{-- <ul class="navbar-nav">
          <li> --}}
              {{-- <a class="nav-link" href="{{ url('category')}}">Danh Mục</a> --}}
              {{-- <ul>
                  <li><a href="#">Link 1</a></li>
                  <li><a href="#">Link 2</a></li>
                  <li><a href="#">Link 3</a></li>
              </ul>
          </li>
      </ul> --}}
      
      

        <a class="nav-link" href="{{ url('my-orders' )}}">Đơn Hàng</a>

        <a class="nav-link" href="{{ url('cart' )}}">
          <i style="font-size: 30px;" class="fa fa-shopping-cart"></i>
          <span class="badge badge-pill bg-primary cart-count">0</span>
        </a>

        <a class="nav-link" href="{{ url('wishlist' )}}">
          <i style="font-size: 30px;" class="fa fa-heart"></i>
          <span class="badge badge-pill bg-success wishlist-count">0</span>
        </a>

        {{-- @guest
            @if (Route::has('login'))
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}"> {{__('Đăng Nhập')}} </a>
                </li>
            @endif

            @if (Route::has('register'))
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('register') }}"> {{__('Đăng Ký')}} </a>
                </li>
            @endif

            @else
                <li>
                  
                </li>

        @endguest --}}

        @if (Route::has('login'))
            <!-- <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block"> -->
                @auth
                <a href="#" class="nav-link active">Xin Chào, {{ Auth::user()->name }}</a>
                <a href="{{ route('logout') }}" class="nav-link underline" 
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Đăng Xuất') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
              
                @else
                    <a href="{{ route('login') }}" class="nav-link underline" >Đăng Nhập</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="nav-link underline">Đăng Ký</a>
                    @endif
                @endauth
            <!-- </div> -->
        @endif

      </div>
    </div>
  </div>
</nav>