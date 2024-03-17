@include('nav')

<h1>Reset Password</h1>

<form action="{{ route('reset_password_submit') }}" method="post">
    @csrf

    <input type="hidden" name="token" value={{ $token }}>
    <input type="hidden" name="email" value={{ $email }}>

    <div>New Password</div>
    
    <div>
        <input type="password" name="new_password">
    </div>
    
    <div>Confirm Password</div>
    
    <div>
        <input type="password" name="confirm_password">
    </div>
    <br>
    <div>
        <input type="submit" value="Update">
    </div>
</form>
