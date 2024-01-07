<div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo"><a href="{{ url('/')}}" class="simple-text logo-normal">
          PERFUME-SHOP
        </a></div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item {{ Request::is('dashboard') ? 'active':'' }}">
            <a class="nav-link" href="{{ url('dashboard')}}">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-item {{ Request::is('revenue-form') ? 'active':'' }}">
            <a class="nav-link" href="{{ url('revenue-form') }}">
              <i class="material-icons">content_paste</i>
              <p>Tra Cứu Doanh Thu</p>
            </a>
          </li>

          <li class="nav-item {{ Request::is('categories') ? 'active':'' }}">
            <a class="nav-link"S href="{{ url('categories') }}">
              <i class="material-icons">bookmark</i>
              <p>Danh Mục</p>
            </a>
          </li>
          <li class="nav-item {{ Request::is('add-category') ? 'active':'' }}">
            <a class="nav-link"S href="{{ url('add-category') }}">
              <i class="material-icons">add</i>
              <p>Thêm Danh Mục</p>
            </a>
          </li>

          <li class="nav-item {{ Request::is('products') ? 'active':'' }}">
            <a class="nav-link"S href="{{ url('products') }}">
              <i class="material-icons">redeem</i>
              <p>Sản Phẩm</p>
            </a>
          </li>
          <li class="nav-item {{ Request::is('add-products') ? 'active':'' }}">
            <a class="nav-link"S href="{{ url('add-products') }}">
              <i class="material-icons">add</i> 
              <p>Thêm Sản Phẩm</p>
            </a>
          </li>
          <li class="nav-item {{ Request::is('orders') ? 'active':'' }}">
            <a class="nav-link" href="{{ url('orders') }}">
              <i class="material-icons">content_paste</i>
              <p>Đơn Đặt Hàng</p>
            </a>
          </li>
          <li class="nav-item {{ Request::is('users') ? 'active':'' }}">
            <a class="nav-link" href="{{ url('users') }}">
              <i class="material-icons">perm_identity</i>
              <p>User</p>
            </a>
          </li>

        </ul>
      </div>
    </div>