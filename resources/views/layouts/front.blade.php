<!doctype html>
<html lang="en">

<head>
  @include('includes.landing.meta')

  <title>@yield('title') | SoJo</title>

  @stack('before-style')

  @include('includes.landing.style')

  @stack('after-style')
</head>

<body class="antialiased">
  <div class="relative">
    {{-- top --}}

    @include('includes.landing.header')

    {{-- @include('sweetalert::alert') --}}

    {{-- main content --}}
    @yield('content')

    {{-- bottom --}}
    @include('includes.landing.footer')
    {{-- script js --}}
    @stack('before-script')

    @include('includes.landing.script')

    @stack('after-script')

    {{-- modal --}}

    @include('components.Modal.login')
    @include('components.Modal.register')
    @include('components.Modal.register-success')
  </div>
</body>

</html>
