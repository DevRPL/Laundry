<div class="kt-grid kt-grid--hor kt-grid--root">
  <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
    <!-- begin:: Aside -->
    <button class="kt-aside-close " id="kt_aside_close_btn">
      <i class="la la-close">
      </i>
    </button>
    <div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">
      <!-- begin:: Aside -->
          @include('component.shared.logo_nav')
      <!-- end:: Aside -->	
      <!-- begin:: Aside Menu -->
      <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="kt-aside-menu" data-ktmenu-vertical="1" data-ktmenu-scroll="1" 
        data-ktmenu-dropdown-timeout="500">		
          <ul class="kt-menu__nav ">
            <li class="kt-menu__item  kt-menu__item--active" aria-haspopup="true" >
              <a href="{{ route('master.dashboard.index') }}" class="kt-menu__link ">
                <i class="kt-menu__link-icon flaticon-dashboard">
                </i>
                <span class="kt-menu__link-text">Dashboard
                </span>
              </a>
            </li>
            <li class="kt-menu__section ">
              <h4 class="kt-menu__section-text">Cabang {{ Auth::user()->branch->name ?? '' }}
              </h4>
              <i class="kt-menu__section-icon flaticon-more-v2">
              </i>
            </li>
            <li class="kt-menu__item " aria-haspopup="true" >
              <a  href="{{ route('master.customers.index') }}" class="kt-menu__link ">
                <i class="kt-menu__link-icon flaticon-customer">
                </i>
                <span class="kt-menu__link-text">Customer
                </span>
              </a>
            </li>
            <li class="kt-menu__item " aria-haspopup="true" >
              <a  href="{{ route('master.cabangs.index') }}" class="kt-menu__link ">
                <i class="kt-menu__link-icon flaticon-placeholder-1">
                </i>
                <span class="kt-menu__link-text">Cabang
                </span>
              </a>
            </li>
            <li class="kt-menu__item " aria-haspopup="true" >
              <a  href="{{ route('master.pakets.index') }}" class="kt-menu__link ">
                <i class="kt-menu__link-icon flaticon-information">
                </i>
                <span class="kt-menu__link-text">Layanan Laundry
                </span>
              </a>
            </li>
            <li class="kt-menu__item " aria-haspopup="true" >
              <a  href="{{ route('master.transaksis.index') }}" class="kt-menu__link ">
                <i class="kt-menu__link-icon flaticon-coins">
                </i>
                <span class="kt-menu__link-text">Transaksi
                </span>
              </a>
            </li>
            </li>
            <li class="kt-menu__item " aria-haspopup="true" >
              <a  href="{{ route('master.reports.getReportDataOrder') }}" class="kt-menu__link ">
                <i class="kt-menu__link-icon flaticon-folder-1">
                </i>
                <span class="kt-menu__link-text">Laporan
                </span>
              </a>
            </li>
            <li class="kt-menu__item " aria-haspopup="true" >
              <a  href="{{ route('master.users.index') }}" class="kt-menu__link ">
                <i class="kt-menu__link-icon flaticon-users">
                </i>
                <span class="kt-menu__link-text">Pengguna
                </span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>