@include('nav')

<h1>Registration</h1>

<form action="{{ route('registration_submit') }}" method="post"> @csrf
    <div>Name</div>
    
    <div>
        <input type="text" name="name">
    </div>
    <div>Email Address</div>
    
    <div>
        <input type="text" name="email">
    </div>
    
    <div>Password</div>
    
    <div>
        <input type="password" name="password">
    </div>

    <div>Confirm Password</div>
    
    <div>
        <input type="password" name="confirmpassword">
    </div>
    <br>
    <div>
        <input type="submit" value="Register">
    </div>
</form>
