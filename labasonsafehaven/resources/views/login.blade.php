@include('nav')

<h1>Login</h1>

<form action="" method="post">
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
        <br>
        <a href="{{ route('forget_password') }}">Forget password</a>
    </div>
</form>
