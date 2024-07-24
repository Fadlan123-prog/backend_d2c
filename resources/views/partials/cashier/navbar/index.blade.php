
<div class="container">
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <h6 class="font-weight-bolder mb-0">
                    {{ $dateTime->format('Y-m-d') }}
                </h6>
            </ol>
            <h6 class="font-weight-bolder mb-0" id="time">
                {{-- {{ $lifetime }} --}}
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
                        <span class="d-sm-inline d-none">{{ Auth::user()->name }}</span>
                        <span class="d-sm-inline d-none">{{ Auth::user()->email }}</span>
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                        <li>
                            <a class="dropdown-item" href="{{route('index.logout')}}">
                                <svg width="20" height="20" viewBox="0 0 30 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.25878 6.42528C4.75307 8.08228 2.84939 10.4992 1.82958 13.3184C0.809766 16.1375 0.728019 19.2089 1.59644 22.0779C2.46487 24.9469 4.2373 27.461 6.65134 29.248C9.06539 31.0351 11.9927 32 15 32C18.0073 32 20.9346 31.0351 23.3487 29.248C25.7627 27.461 27.5351 24.9469 28.4036 22.0779C29.272 19.2089 29.1902 16.1375 28.1704 13.3184C27.1506 10.4992 25.2469 8.08228 22.7412 6.42528M15.0008 1V13.4006" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span class="d-sm-inline d-none m-2">logout</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{route('pending.transaction.index')}}">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16 14H17.5V16.82L19.94 18.23L19.19 19.53L16 17.69V14ZM17 12C15.6739 12 14.4021 12.5268 13.4645 13.4645C12.5268 14.4021 12 15.6739 12 17C12 18.3261 12.5268 19.5979 13.4645 20.5355C14.4021 21.4732 15.6739 22 17 22C18.3261 22 19.5979 21.4732 20.5355 20.5355C21.4732 19.5979 22 18.3261 22 17C22 15.6739 21.4732 14.4021 20.5355 13.4645C19.5979 12.5268 18.3261 12 17 12ZM17 10C18.8565 10 20.637 10.7375 21.9497 12.0503C23.2625 13.363 24 15.1435 24 17C24 18.8565 23.2625 20.637 21.9497 21.9497C20.637 23.2625 18.8565 24 17 24C14.21 24 11.8 22.36 10.67 20H1V17C1 14.34 6.33 13 9 13C9.6 13 10.34 13.07 11.12 13.2C11.7541 12.2173 12.6247 11.4094 13.652 10.8503C14.6793 10.2913 15.8304 9.99888 17 10ZM10 17C10 16.3 10.1 15.62 10.29 15C9.87 14.93 9.43 14.9 9 14.9C6.03 14.9 2.9 16.36 2.9 17V18.1H10.09C10.0311 17.7363 10.001 17.3685 10 17ZM9 4C10.0609 4 11.0783 4.42143 11.8284 5.17157C12.5786 5.92172 13 6.93913 13 8C13 9.06087 12.5786 10.0783 11.8284 10.8284C11.0783 11.5786 10.0609 12 9 12C7.93913 12 6.92172 11.5786 6.17157 10.8284C5.42143 10.0783 5 9.06087 5 8C5 6.93913 5.42143 5.92172 6.17157 5.17157C6.92172 4.42143 7.93913 4 9 4ZM9 5.9C8.44305 5.9 7.9089 6.12125 7.51508 6.51508C7.12125 6.9089 6.9 7.44305 6.9 8C6.9 8.55695 7.12125 9.0911 7.51508 9.48492C7.9089 9.87875 8.44305 10.1 9 10.1C9.55695 10.1 10.0911 9.87875 10.4849 9.48492C10.8788 9.0911 11.1 8.55695 11.1 8C11.1 7.44305 10.8788 6.9089 10.4849 6.51508C10.0911 6.12125 9.55695 5.9 9 5.9Z" fill="black"/>
                                    </svg>

                                <span class="d-sm-inline d-none m-2">Pending Transaction</span>
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
</div>

  <script type="text/javascript">
     function showTime() {
        var date = new Date();
    var options = {
        timeZone: 'Asia/Jakarta', // Setting timezone to Indonesia (Western Indonesia Time, WIB)
        hour12: false, // 24-hour format
        hour: 'numeric',
        minute: 'numeric',
        second: 'numeric'
    };

    var timeStr = date.toLocaleTimeString('en-US', options);

    document.getElementById('time').innerHTML = timeStr;
  }

  setInterval(showTime, 1000);

  </script>
