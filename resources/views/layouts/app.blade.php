@include('layouts.header')
  @guest
    @yield('content')
  @else
    @include('layouts.menu')
    @yield('style')
    @yield('content')
  @endguest
@include('layouts.footer')
@yield('script')
