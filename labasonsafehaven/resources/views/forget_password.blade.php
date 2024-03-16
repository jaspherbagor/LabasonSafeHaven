@include('nav')

<h1>Forget Password</h1>

<form action="" method="post">
    <div>Email Address</div>
    
    <div>
        <input type="text" name="email">
    </div>
    
    <br>
    <div>
        <input type="submit" value="Submit">
        <br>
        <a href="{{ route('login') }}">Back to login page</a>
    </div>
</form>
