<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link  rounded-circle mr-3">
      <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
      {{-- Home page --}}
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="{{route('home')}}" target="_blank" data-toggle="tooltip" data-placement="bottom" title="home"  role="button">
          <i class="fas fa-home fa-fw"></i>
        </a>
      </li>

      <div class="topbar-divider d-none d-sm-block"></div>

      <!-- Nav Item - User Information -->
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth()->user()->name}}</span>
          @if(Auth()->user()->photo)
            <img class="img-profile rounded-circle" src="{{asset('storage/'.Auth()->user()->photo)}}">
          @else
            <img class="img-profile rounded-circle" src="{{asset('backend/img/avatar.png')}}">
          @endif
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="{{route('user-profile')}}">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            Hồ sơ
          </a>
          <a class="dropdown-item" href="{{route('user.change.password.form')}}">
            <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
              Thay đổi mật khẩu
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{route('user.logout')}}"
                onclick="{{route('user.logout')}}">
                 <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> {{ __('Đăng xuất') }}
            </a>
        </div>
      </li>
    </ul>
  </nav>
