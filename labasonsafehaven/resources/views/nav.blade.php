<a href="{{ route('home') }}">Home</a> -

@if(Auth::guard('web')->user())
@if(Auth::guard('web')->user()->role == 1)
    <a href="{{ route('dashboard_admin') }}">Dashboard -  Admin</a> -
    <a href="{{ route('settings') }}">Settings</a> - 
@else
    <a href="{{ route('dashboard_user') }}">Dashboard User</a> -
@endif
<a href="{{ route('logout') }}">Logout</a>
@endif
@if(!Auth::guard('web')->user())
<a href="{{ route('login') }}">Login</a> -
<a href="{{ route('registration') }}">Register</a> -
@endif