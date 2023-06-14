<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white border-bottom-0">
    <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <form id="logoutForm" method="POST">
                @csrf
            </form>
            <li class="nav-item">
                <a class="nav-link text-dark" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <div class="d-flex align-items-center" style="gap: 4px;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                    <div class="image">
                        <img src="{{ Auth::user()->profile_photo_url }}" class="img-circle shadow-sm"
                            style="width: 40px; height: 40px; object-fit: cover;" alt="User Image" />
                    </div>
                    <div class="dropdown">
                        <a class="user-nama">
                            <p class="text-dark">
                                {{ Str::substr(Auth::user()->name, 0, 18) }}
                            </p>
                        </a>
                        <div class="dropdown-menu bg-dark border-0 shadow-lg" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ url('/user/profile') }}"><i
                                    class="fa fa-user text-primary pr-1"></i> Profil</a>
                            @can('ubahpassword')
                                <a class="dropdown-item" href="#"><i class="fa fa-lock text-success pr-1"></i> Ubah
                                    Password</a>
                            @endcan
                            <div class="dropdown-divider"></div>
                            <a role="button" class="dropdown-item logout" data-nama=""><i
                                    class="fa fa-sign-out-alt text-danger pr-1"></i> Keluar</a>

                            <form id="logoutForm" method="POST">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
              </li>
        </ul>
  </nav>
  <!-- /.navbar -->
