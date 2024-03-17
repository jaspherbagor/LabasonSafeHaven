<a href="{{ route('home') }}">Home</a> -

@if(Auth::guard('web')->user())
<a href="{{ route('dashboard_user') }}">Dashboard User</a> -
<a href="{{ route('dashboard_admin') }}">Dashboard Admin</a> -
<a href="{{ route('logout') }}">Logout</a>
@endif
@if(!Auth::guard('web')->user())
<a href="{{ route('login') }}">Login</a> -
<a href="{{ route('registration') }}">Register</a> -
@endif