<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-black" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="{{ route('dashboard.index')}}" target="_blank">
        <img src="{{ asset('assets/img/content/logo.png') }}" class="navbar-brand-img h-100" alt="main_logo">
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
            <a class="nav-link sidedrop" href="#" id="dropdownMenuLink3" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                    <svg width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.3 9.75556L17.328 1.61111L18.9715 2.72222L14.003 12.7778L7.8185 8.61111L3.287 17.7778H19V20H0V0H1.9V16.1556L7.125 5.55556L13.3 9.75556Z" fill="#0C0C0C"/>
                    </svg>
                </div>
                <span class="nav-link-text ms-1">Summary</span>
            </a>
            <ul class="navbar-nav drop-item" aria-labelledby="dropdownMenuLink3">
                <li><a class="dropdown-item nav-link padding-nav-side {{ Route::is('dashboard.index') ? 'active' : '' }}" href="{{ route('dashboard.index') }}">Sales Summary</a></li>
                <li><a class="dropdown-item nav-link padding-nav-side {{ Route::is('sales.index') ? 'active' : '' }}" href="{{ route('sales.index') }}">Sales data</a></li>
                <li><a class="dropdown-item nav-link padding-nav-side" href="#">Receipts</a></li>

            </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link sidedrop" href="#" id="dropdownMenuLink4" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <svg width="23" height="24" viewBox="0 0 23 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19.785 9.10551H3.21623C2.88098 9.10625 2.5502 9.18619 2.24852 9.33937C1.94684 9.49255 1.68201 9.71504 1.47376 9.99027C1.2669 10.2652 1.12232 10.5857 1.05094 10.9276C0.979562 11.2696 0.983239 11.6241 1.0617 11.9643L2.83822 19.5847C3.09497 20.5667 3.65353 21.4327 4.42745 22.0486C5.20163 22.6658 6.14949 23 7.12459 23H15.8744C16.8495 23 17.7974 22.6658 18.5715 22.0486C19.3455 21.4327 19.904 20.5667 20.1608 19.5847L21.9373 11.9655C22.0569 11.4518 22.0044 10.9107 21.7887 10.4328C21.5729 9.95477 21.207 9.56892 20.7522 9.33978C20.45 9.18619 20.1186 9.10611 19.7828 9.10551M7.05875 13.7362V18.3681M11.5006 13.7362V18.3681M15.9425 13.7362V18.3681M19.2742 9.10551C19.2738 8.04006 19.0724 6.98518 18.6817 6.00151C18.2909 5.01784 17.7184 4.12477 16.9971 3.37362C15.5364 1.85249 13.5602 0.999095 11.5006 1C9.44103 0.999095 7.46487 1.85249 6.00419 3.37362C5.28309 4.12487 4.71081 5.01798 4.32022 6.00165C3.92963 6.98531 3.72843 8.04014 3.72819 9.10551" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
            </div>
            <span class="nav-link-text ms-1">Items</span>
          </a>

          <ul class="navbar-nav drop-item" aria-labelledby="dropdownMenuLink4">
            <li><a class="dropdown-item nav-link padding-nav-side {{ Route::is('items.list.index') ? 'active' : ''}} " href="{{ route('items.list.index')}}">Item List</a></li>
            <li><a class="dropdown-item nav-link padding-nav-side {{ Route::is('items.category') ? 'active' : ''}} " href="{{ route('items.category') }}">Category</a></li>
            <li><a class="dropdown-item nav-link padding-nav-side {{ Route::is('coupons.index') ? 'active' : '' }}" href="{{ route('coupons.index') }}">Discount</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link sidedrop" href="#" id="dropdownMenuLink5" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <svg width="23" height="24" viewBox="0 0 23 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.7798 22.9149L10.2071 18.0031L11.117 17.0257L14.7798 20.9601L22.0914 13.1079L23 14.0839L14.7798 22.9149ZM20.5633 10.195H19.2781V4.14288C19.2781 3.93028 19.1958 3.73517 19.0313 3.55755C18.8668 3.37993 18.6851 3.29157 18.4864 3.29249H15.4224V6.37101H5.14081V3.29249H2.07689C1.87897 3.29249 1.69733 3.38085 1.53196 3.55755C1.3666 3.73425 1.28435 3.92936 1.2852 4.14288V21.7705C1.2852 21.9822 1.36746 22.1768 1.53196 22.3544C1.69647 22.5321 1.87768 22.6204 2.0756 22.6195H8.99642V24H2.07689C1.50112 24 1.01103 23.7828 0.606616 23.3484C0.202206 22.914 0 22.388 0 21.7705V4.1415C0 3.52488 0.202206 2.99891 0.606616 2.56359C1.01103 2.12919 1.50112 1.91199 2.07689 1.91199H8.03509C8.15504 1.37268 8.42194 0.919413 8.83577 0.5522C9.24961 0.184067 9.73156 0 10.2816 0C10.842 0 11.3278 0.184067 11.739 0.5522C12.1503 0.918493 12.4159 1.37176 12.5359 1.91199H18.4864C19.0621 1.91199 19.5522 2.12919 19.9566 2.56359C20.361 2.99799 20.5633 3.52442 20.5633 4.14288V10.195ZM10.2816 3.61001C10.5798 3.61001 10.8274 3.50463 11.0245 3.29387C11.2215 3.0822 11.3201 2.81622 11.3201 2.49594C11.3201 2.17567 11.2215 1.90969 11.0245 1.69802C10.8274 1.48634 10.5798 1.3805 10.2816 1.3805C9.98346 1.3805 9.73584 1.48634 9.53878 1.69802C9.34172 1.90969 9.24318 2.17567 9.24318 2.49594C9.24318 2.81622 9.34172 3.0822 9.53878 3.29387C9.73584 3.50555 9.98346 3.61001 10.2816 3.61001Z" fill="black"/>
                    </svg>
            </div>
            <span class="nav-link-text ms-1">Inventory Management</span>
          </a>

          <ul class="navbar-nav drop-item" aria-labelledby="dropdownMenuLink5">
            <li><a class="dropdown-item nav-link padding-nav-side " href="#">Stock</a></li>
            <li><a class="dropdown-item nav-link padding-nav-side " href="#">Inventory Count</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link sidedrop" href="#" id="dropdownMenuLink6" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <svg width="23" height="19" viewBox="0 0 23 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3.35371 5.49885C3.35389 4.55077 3.58918 3.61883 4.03674 2.79348C4.48429 1.96814 5.12891 1.2774 5.90805 0.788319C6.68718 0.299234 7.57436 0.0284054 8.48351 0.00211538C9.39265 -0.0241747 10.2929 0.194966 11.0968 0.638273C11.9008 1.08158 12.5811 1.734 13.0719 2.53221C13.5626 3.33043 13.8471 4.24733 13.8977 5.19395C13.9483 6.14056 13.7634 7.08474 13.3607 7.93486C12.9581 8.78498 12.3515 9.51217 11.5998 10.0459C13.2186 10.6648 14.6227 11.7746 15.6313 13.2324C16.64 14.6902 17.2071 16.4293 17.2596 18.2259C17.2574 18.4196 17.1834 18.6049 17.0532 18.7431C16.923 18.8813 16.7466 18.9617 16.5608 18.9675C16.3751 18.9733 16.1944 18.9041 16.0564 18.7742C15.9185 18.6444 15.834 18.4641 15.8207 18.2709C15.7635 16.3223 14.9808 14.4735 13.6384 13.1163C12.296 11.759 10.4994 11 8.62933 11C6.75924 11 4.96262 11.759 3.62022 13.1163C2.27782 14.4735 1.49512 16.3223 1.438 18.2709C1.42839 18.4667 1.3456 18.6508 1.20735 18.7838C1.06909 18.9167 0.886385 18.988 0.698359 18.9822C0.510334 18.9765 0.331947 18.8942 0.201416 18.753C0.0708841 18.6118 -0.00141007 18.4229 2.08433e-05 18.2269C0.0523515 16.4301 0.619346 14.6908 1.62802 13.2328C2.6367 11.7748 4.04089 10.6649 5.65984 10.0459C4.94908 9.54124 4.36742 8.86317 3.96548 8.07068C3.56355 7.27819 3.35353 6.39529 3.35371 5.49885ZM8.62981 1.49885C7.61213 1.49885 6.63613 1.92028 5.91652 2.67043C5.19691 3.42057 4.79264 4.43799 4.79264 5.49885C4.79264 6.55972 5.19691 7.57714 5.91652 8.32728C6.63613 9.07743 7.61213 9.49885 8.62981 9.49885C9.64749 9.49885 10.6235 9.07743 11.3431 8.32728C12.0627 7.57714 12.467 6.55972 12.467 5.49885C12.467 4.43799 12.0627 3.42057 11.3431 2.67043C10.6235 1.92028 9.64749 1.49885 8.62981 1.49885ZM16.5823 5.49885C16.441 5.49885 16.3022 5.50885 16.166 5.52885C16.0709 5.54661 15.9733 5.54421 15.8791 5.5218C15.7849 5.49939 15.696 5.45744 15.6177 5.39844C15.5394 5.33944 15.4733 5.2646 15.4234 5.17839C15.3734 5.09218 15.3406 4.99637 15.327 4.89666C15.3133 4.79696 15.319 4.6954 15.3438 4.59806C15.3686 4.50072 15.412 4.40958 15.4713 4.33008C15.5307 4.25058 15.6047 4.18436 15.6891 4.13535C15.7736 4.08635 15.8666 4.05557 15.9626 4.04485C16.9167 3.90106 17.8896 4.09205 18.7281 4.58778C19.5667 5.0835 20.2233 5.85582 20.5947 6.78318C20.966 7.71054 21.031 8.7403 20.7795 9.71039C20.5279 10.6805 19.974 11.5358 19.205 12.1419C20.3355 12.6695 21.2953 13.5269 21.9686 14.6105C22.642 15.6941 23.0002 16.9577 23 18.2489C23 18.4478 22.9242 18.6385 22.7893 18.7792C22.6543 18.9198 22.4713 18.9989 22.2805 18.9989C22.0897 18.9989 21.9067 18.9198 21.7718 18.7792C21.6369 18.6385 21.5611 18.4478 21.5611 18.2489C21.5614 17.1329 21.2167 16.0465 20.578 15.1509C19.9393 14.2553 19.0408 13.5981 18.0155 13.2769L17.5033 13.1169V11.4409L17.8966 11.2319C18.4796 10.924 18.9461 10.4203 19.2207 9.8021C19.4953 9.18388 19.5621 8.48723 19.4102 7.82461C19.2583 7.16199 18.8966 6.57207 18.3835 6.15008C17.8704 5.72809 17.2359 5.49867 16.5823 5.49885Z" fill="black"/>
                    </svg>

            </div>
            <span class="nav-link-text ms-1">Users</span>
          </a>

          <ul class="navbar-nav drop-item" aria-labelledby="dropdownMenuLink5">
            <li><a class="dropdown-item nav-link padding-nav-side " href="#">User List</a></li>
            <li><a class="dropdown-item nav-link padding-nav-side " href="#">Access Right</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="{{asset('')}}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.4841 19.5697L12.7622 16.9566C14.5172 15.5772 14.9938 12.8663 14.9938 11.3464V8.18267C14.9938 6.08773 12.2076 3.75453 9.409 3.75453C6.61117 3.75453 3.75109 6.08811 3.75109 8.18267V11.3464C3.75109 12.7284 4.33643 15.5243 6.10943 16.9446L1.26561 19.5696C1.26561 19.5696 0 20.1331 0 20.8355V22.7341C0 23.4328 0.567718 24 1.26561 24H17.4841C18.1827 24 18.7504 23.4328 18.7504 22.7341V20.8355C18.7504 20.0907 17.4841 19.5696 17.4841 19.5696L17.4841 19.5697ZM17.2505 22.5015H1.50002V21.1618C1.60765 21.0836 1.75802 20.9929 1.87652 20.9386C1.91174 20.9224 1.94699 20.9056 1.98037 20.8865L6.82454 18.2618C7.26629 18.0224 7.55916 17.5785 7.60378 17.0787C7.6484 16.579 7.43953 16.0893 7.04804 15.7754C5.79031 14.768 5.25144 12.5367 5.25144 11.3465V8.18274C5.25144 7.10643 7.28241 5.25313 9.40938 5.25313C11.5757 5.25313 13.4942 7.08097 13.4942 8.18274V11.3465C13.4942 12.5202 13.1293 14.7613 11.8352 15.7784C11.6401 15.9318 11.4862 16.1312 11.3871 16.3587C11.288 16.5861 11.2469 16.8345 11.2675 17.0817C11.2884 17.3288 11.3702 17.5668 11.5056 17.7746C11.6411 17.9824 11.826 18.1534 12.0437 18.2723L16.7656 20.8854C16.8073 20.9082 16.8602 20.9329 16.904 20.9521C17.0147 20.9989 17.1508 21.0772 17.2505 21.1461V22.5015ZM22.7333 15.8387L17.9412 13.2256C19.6962 11.8462 20.2433 9.13541 20.2433 7.6155V4.45174C20.2433 2.35681 17.387 0 14.5884 0C12.7697 0 10.9101 0.987902 9.82787 2.25306C10.4451 2.29124 11.1257 2.29202 11.7137 2.47933C12.5038 1.86456 13.5036 1.49892 14.5884 1.49892C16.7548 1.49892 18.7433 3.34995 18.7433 4.45214V7.6159C18.7433 8.7896 18.3083 11.0307 17.0143 12.0478C16.8192 12.2012 16.6652 12.4006 16.5661 12.6281C16.4671 12.8555 16.426 13.1039 16.4465 13.3511C16.4674 13.5982 16.5492 13.8362 16.6847 14.044C16.8201 14.2517 17.005 14.4227 17.2228 14.5417L22.0148 17.1548C22.0565 17.1776 22.1093 17.2023 22.1532 17.2214C22.2638 17.2683 22.3999 17.3466 22.4997 17.4155V18.7481H19.472C19.9291 19.0927 20.0675 19.5857 20.2449 20.2466H22.7337C23.4323 20.2466 24 19.6794 24 18.9807V17.1053C23.9996 16.3598 22.7333 15.8387 22.7333 15.8387L22.7333 15.8387Z" fill="black"/>
                    </svg>

            </div>
            <span class="nav-link-text ms-1">Customers</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
