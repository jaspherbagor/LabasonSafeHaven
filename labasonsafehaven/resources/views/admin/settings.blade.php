@include('admin.nav')
<h1>Settings</h1>
<h3>Hi {{ Auth::guard('admin')->user()->name }}, you are an admin and you can see this page.</h3>