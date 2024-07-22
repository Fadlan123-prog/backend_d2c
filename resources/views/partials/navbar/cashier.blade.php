<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">
            @yield('page' , 'Cashier')
        </li>
        </ol>
        <h6 class="font-weight-bolder mb-0">
            @yield('title', 'Cashier')
        </h6>
      </nav>
      <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">

        </div>
        <ul class="navbar-nav justify-content-end">
            <div class="dropdown">
                <li class="nav-item d-flex align-items-center">
                  <a href="javascript:;" class="nav-link text-body font-weight-bold px-0 dropdown-toggle" data-bs-toggle="dropdown" id="navbarDropdownMenuLink2" aria-expanded="false">
                    <i class="fa fa-user me-sm-1"></i>
                    <span class="d-sm-inline d-none">{{ Auth::user()->username }}</span>
                    <span class="d-sm-inline d-none">{{ Auth::user()->email }}</span>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                    <li>
                        <a class="dropdown-item" href="javascript:;">
                            <svg width="20" height="20" viewBox="0 0 30 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.25878 6.42528C4.75307 8.08228 2.84939 10.4992 1.82958 13.3184C0.809766 16.1375 0.728019 19.2089 1.59644 22.0779C2.46487 24.9469 4.2373 27.461 6.65134 29.248C9.06539 31.0351 11.9927 32 15 32C18.0073 32 20.9346 31.0351 23.3487 29.248C25.7627 27.461 27.5351 24.9469 28.4036 22.0779C29.272 19.2089 29.1902 16.1375 28.1704 13.3184C27.1506 10.4992 25.2469 8.08228 22.7412 6.42528M15.0008 1V13.4006" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="d-sm-inline d-none m-2">logout</span>
                        </a>
                    </li>
                </ul>
                </li>
            </div>
          <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
              <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
              </div>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
