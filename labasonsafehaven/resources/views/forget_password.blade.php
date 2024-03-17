@include('nav')

<h1>Forget Password</h1>

<form action="{{ route('forget_password_submit') }}" method="post">
    @csrf

    <div>Email Address</div>
    
    <div>
        <input type="email" name="email">
    </div>
    
    <br>
    <div>
        <input type="submit" value="Submit">
        <br>
        <a href="{{ route('login') }}">Back to login page</a>
    </div>
</form>
