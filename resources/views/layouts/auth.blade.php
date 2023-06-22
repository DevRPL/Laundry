<!DOCTYPE html>
<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<head>
    @include('component.shared.meta')
    
    @include('component.shared.title')
    
    @include('component.shared.css')
    
    @include('component.shared.font')

    @stack('css')

    @include('component.shared.font')
    
</head>
<body class="kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
    <div class="kt-grid kt-grid--ver kt-grid--root">
      <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url({{ asset('component/default/custom/user/assets/media/bg/bg-3.jpg') }});">
          <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
            <div class="kt-login__container">
              <div class="kt-login__logo">
                <a href="#">
                  <img src="{{ asset('admin/default/custom/user/assets/media/logos/logo-5.png') }}">  	
                </a>
              </div>
              @yield('content')
            </div>	
          </div>
        </div>
      </div>	
    </div>
  
    @include('component.shared.js')
     
    {{--  <script src="{{ asset('component/default/custom/user/assets/app/custom/login/login-general.js') }}" type="text/javascript"></script>  --}}

    @stack('js')
</body>
</html>