<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.header')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>

<div class="fluid-container">
          <div class="wk-docs-research-example">
              <!-- Artificial wrapper for auto-hiding functionality, should be removed from final usage -->
              <header class="wk-banner wk-banner-extra-margins" role="banner">
                  <div class="wk-banner-container" style="max-width: 100%">

                    {{-------------------- HOME BUTTON ----------------------------------  --}}
                      <a class="navbar-brand" href="{{ url('/home') }}">
                        <img class="wk-logo wk-logo-medium" src="https://cdn.wolterskluwer.io/wk/fundamentals/2.x.x/logo/assets/large.svg" alt="Wolters Kluwer"/>
                      </a>

                      {{-------------------- HOME BUTTON ----------------------------------  --}}

                        <div class="wk-banner-content">
                            <div class="wk-banner-left-content">
                            </div>

                            <div class="wk-banner-right-content">
                              <div class="wk-nav" role="navigation" aria-label="Header menu">
                                  <div class="">

                                        {{-------------------- AUTHETICACION ----------------------------------  --}}
                                      <!-- Right Side Of Navbar -->
                                      <ul class="wk-nav-list">
                                          <!-- Authentication Links -->
                                          @guest
                                              @if (Route::has('login'))
                                                  <li class="wk-nav-item">
                                                      <a class="wk-nav-link wk-button wk-button-text wk-button-icon-left" style="font-size: 1.6rem; text-decoration: none" href="{{ route('login') }}"><span class="wk-icon-login" style="font-size: 1.8rem; color: #85BC20" aria-hidden="true"></span> {{ __('Login') }}</a>
                                                  </li>
                                              @endif

                                          @else
                                            <li class="wk-nav-item">
                                                <a class="wk-nav-link wk-button wk-button-text wk-button-icon-left" style="font-size: 1.6rem; text-decoration: none" href="#">
                                                    <span class="wk-icon-user" style="font-size: 1.8rem; color: #85BC20" aria-hidden="true"></span>
                                                    {{ Auth::user()->name }}
                                                </a>
                                            </li>
                                            <li class="wk-nav-item">
                                                <a class="wk-nav-link wk-button wk-button-text wk-button-icon-left" style="font-size: 1.6rem; text-decoration: none" href="{{ route('logout') }}"
                                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                                    <span class="wk-icon-logout" style="font-size: 1.8rem; color: #85BC20" aria-hidden="true"></span>
                                                        {{ __('Logout') }}
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </li>

                                          @endguest
                                      </ul>
                                      {{-------------------- /AUTHETICACION ----------------------------------  --}}

                                  </div>
                                </div>
                              </div>
                          </div>
                  </header>
              </div>



              {{-------------------- CONTENT BLOCK----------------------------------  --}}
                <div class="fluid-container">
                    <div class="wk-page-container-fluid" style="padding-left: 0px!important;">
                      <div class="wk-row" style="padding: 100px 50px;">
                          <div class="wk-col-12">
                              @yield('content')
                          </div>
                      </div>
                    </div>
                </div>
                {{-------------------- CONTENT BLOCK----------------------------------  --}}

    </div>
    <!-- ##################################### DYNAMIC BLOCKS START HERE  ############################################## -->

          @include('layouts.footer')

    <!-- ##################################### DYNAMIC BLOCKS END HERE  ############################################## -->
    @yield('javascript')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
