@include('admin.nav')

<h1>Login</h1>

<form action="{{ route('admin_login_submit') }}" method="post">
    @csrf
    <div>Email Address</div>
    
    <div>
        <input type="text" name="email">
    </div>
    
    <div>Password</div>
    
    <div>
        <input type="password" name="password">
    </div>
    <br>
    <div>
        <input type="submit" value="Login">
    </div>
</form>
