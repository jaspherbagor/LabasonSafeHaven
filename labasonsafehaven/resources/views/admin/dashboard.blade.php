@include('nav')
<h1>Dashboard - Admin</h1>
<h3>Hi {{ Auth::guard('admin')->user()->name }}, welcome to the dashboard page</h3>