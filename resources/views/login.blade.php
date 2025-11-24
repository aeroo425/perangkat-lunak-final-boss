<h2>Login</h2>

@if($errors->has('error'))
    <p style="color:red;">{{ $errors->first('error') }}</p>
@endif

<form action="{{ route('login.check') }}" method="POST">
    @csrf
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>

    <button type="submit">Login</button>
</form>
