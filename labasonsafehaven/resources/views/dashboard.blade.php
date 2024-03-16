@include('nav')
<h1>Dashboard</h1>
<h3>Hi {{ Auth::guard('web')->user()->name }}, welcome to the dashboard page</h3>